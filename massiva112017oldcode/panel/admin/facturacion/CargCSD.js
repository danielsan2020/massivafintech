


function CSD_fileSelected(Obj) {

    CSD_RestVal();

    // get selected file element
    var oFile = Obj.files[0];

//     little test for filesize
    if (oFile.size > iMaxFilesize) {
        LimpiarDatsArch();
        alert("No se permite subir archivos mayores de 2 Mega Bytes.");
        return false;
    }
    
    var Arch1 = document.getElementById("CSD_Archivo1").value.toUpperCase();
    var Ext1 = Arch1.substr(Arch1.length-4, 4);
    
    var Arch2 = document.getElementById("CSD_Archivo2").value.toUpperCase();
    var Ext2 = Arch2.substr(Arch2.length-4, 4);
    
    if (Ext1.length>0){
        if (Ext1!==".KEY"){
            alert("El primer archivo no es válido");
            document.getElementById("CSD_Archivo1").value = "";
            return false;
        }
    }
    
    if (Ext2.length>0){
        if (Ext2!==".CER"){
            alert("El segundo archivo no es válido");
            document.getElementById("CSD_Archivo2").value = "";
            return false;
        }
    }
    
    document.getElementById("CSD_ClaveSellos").focus();

}


function CSD_RestVal(){

    document.getElementById('CSD_upload_response').innerHTML = "";
    document.getElementById('CSD_upload_response').style.color = "";
    document.getElementById('CSD_progress_percent').innerHTML = "";
    document.getElementById('CSD_b_transfered').innerHTML = "";    
    document.getElementById("CSD_progress_info").style.display = "none";
}


function CSD_startUploading() {
    
    document.getElementById("CSD_ClaveSellos").style.backgroundColor = "";
    
    var ClaveSellos = document.getElementById("CSD_ClaveSellos").value;
    
    if (ClaveSellos.length===0){
        document.getElementById("CSD_ClaveSellos").style.backgroundColor = "#FF9";
        document.getElementById("CSD_ClaveSellos").focus();
        alert("Escriba la contraseña");
        return false;
    }
    
    CSD_RestVal();
    
    document.getElementById("CSD_progress_info").style.display = "block";

    if (document.getElementById("CSD_Archivo1").value.length === 0){
        alert("¡Seleccione el archivo .key a subir!");
        return false;
    }
    
    if (document.getElementById("CSD_Archivo2").value.length === 0){
        alert("¡Seleccione el archivo .cer a subir!");
        return false;
    }

    // cleanup all temp states
    iPreviousBytesLoaded = 0;

    var oProgress = document.getElementById('CSD_progress');
    oProgress.style.display = 'block';
    oProgress.style.width = '0px';
    document.getElementById("CSD_progressBar").style.display = "";

    // get form data for POSTing
    var vFD = new FormData(document.getElementById('CSD_upload_form'));

    // create XMLHttpRequest object, adding few event listeners, and POSTing our data
    var oXHR = new XMLHttpRequest();
    oXHR.upload.addEventListener('progress', CSD_uploadProgress, false);
    oXHR.addEventListener('load',  CSD_uploadFinish, false);
    oXHR.addEventListener('error', CSD_uploadError, false);
    oXHR.addEventListener('abort', CSD_uploadAbort, false);
    oXHR.open('POST', 'UpLoad_KeyCer.php');
    oXHR.send(vFD);
}


function CSD_uploadProgress(e) { // upload process in progress
    
    if (e.lengthComputable) {
        iBytesUploaded = e.loaded;
        iBytesTotal = e.total;

        var iPercentComplete = Math.round(e.loaded * 100 / e.total);
        var iBytesTransfered = bytesToSize(iBytesUploaded);
        document.getElementById('CSD_progress_percent').innerHTML = iPercentComplete.toString() + '%';
        document.getElementById("CSD_progressBar").value = iPercentComplete;
        document.getElementById('CSD_b_transfered').innerHTML = iBytesTransfered;
        if (iPercentComplete === 100) {
            var oUploadResponse = document.getElementById('CSD_upload_response');
            oUploadResponse.innerHTML = 'Espere, procesando...';
            oUploadResponse.style.display = 'block';
        }
    } else {
        document.getElementById('CSD_progress').innerHTML = 'unable to compute';
    }
}


function CSD_uploadError(e) { // upload error
    alert(e);
    document.getElementById('CSD_error2').style.display = 'block';
//    clearInterval(oTimer);
}

function CSD_uploadAbort(e) { // upload abort
    alert(e);
    document.getElementById('CSD_abort').style.display = 'block';
//    clearInterval(oTimer);
}

var CSD_CadBase = "";

function CSD_uploadFinish(e) { // upload successfully finished
    
    document.getElementById('CSD_progress_percent').innerHTML = '100%';
    document.getElementById('CSD_progress').style.width = '400px';

    CSD_VerifArchsKeyCer();
}


function CSD_VerifArchsKeyCer(){
    
    var ClaveSellos = document.getElementById("CSD_ClaveSellos").value;

    CreateXmlHttp();
    var ajaxRequest = "ScriptPHP_VerifArchsKeyCer.php?ClaveSellos="+ClaveSellos;
    xmlHttp.onreadystatechange = Resp_VerifArchsKeyCer;
    xmlHttp.open("GET", ajaxRequest, true);
    xmlHttp.send("");    
}


function Resp_VerifArchsKeyCer(){

    if(xmlHttp.readyState === 4 && xmlHttp.status === 200){
        
//        alert(xmlHttp.responseText);

        var DocXML = xmlHttp.responseXML;
        CodHTML = '';
        
        var StatusArchKEY = parseInt(DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('StatusArchKEY'));
        var StatusArchCER = parseInt(DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('StatusArchCER'));
        var ValidModulus  = parseInt(DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('ValidModulus'));
        var RFC    = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('RFC');
        var RazSoc = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('RazSoc');
        var NoCert = DocXML.firstChild.getElementsByTagName('param')[0].getAttribute('NoCert');
        
        
        if (StatusArchKEY===1 || StatusArchCER===1 || RFC.length===0){

            CSD_LimpiarDatsArch();
            
            if (ValidModulus===1){
                
                CSD_LimpiarDatsArch();
                
                if (ValidModulus===1){
                    document.getElementById("CSD_ClaveSellos").focus();
                    alert('Error de contraseña o "Sellos digitales" no válidos');
                }
                
                if (RFC.length===1){
                    alert('Error, no se pudieron obtener datos.');
                }
                
                return false;
                
            }else{
                
                Mod_DatsEmi = 0;
                
                CSD_LimpiarDatsArch();
                
                document.getElementById("CSD_ClaveSellos").focus();
                
                CodHTML += '<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">';

                    CodHTML += '<tr>';

                        CodHTML += '<td align="center" valign="top" style="width: 25%;">';
                            CodHTML += '<img src="images/bien_120x120.png" width="120" height="120" alt="bien_120x120"/>';
                        CodHTML += '</td>';

                        CodHTML += '<td align="center" valign="top" style="width: 75%; padding-top: 4px;">';

                            CodHTML += '<table border="0" cellpadding="1" cellspacing="0" style="width: 100%" >';
                                CodHTML += '<tr>';
                                    CodHTML += '<td align="left" valign="top" style="color: #006B1B; font-size: 17pt; padding-bottom: 10px;" colspan="2" >';
                                        CodHTML += 'Datos correctamente cargados.';
                                    CodHTML += '</td>';
                                CodHTML += '</tr>';
                                CodHTML += '<tr>';
                                    CodHTML += '<td align="left" valign="top" style="width: 23%; font-size: 13pt;">';
                                        CodHTML += 'RFC:';
                                    CodHTML += '</td>';
                                    CodHTML += '<td align="left" valign="top" style="width: 77%; font-size: 13pt; color: #000099;">';
                                        CodHTML += RFC;
                                    CodHTML += '</td>';
                                CodHTML += '</tr>';
                                CodHTML += '<tr>';
                                    CodHTML += '<td align="left" valign="top" style="font-size: 13pt;">';
                                        CodHTML += 'Nombre:';
                                    CodHTML += '</td>';
                                    CodHTML += '<td align="left" valign="top" style="font-size: 13pt; color: #000000;">';
                                        CodHTML += RazSoc;
                                    CodHTML += '</td>';
                                CodHTML += '</tr>';
                                CodHTML += '<tr>';
                                    CodHTML += '<td align="left" valign="top" style="font-size: 13pt;">';
                                        CodHTML += 'Certificado:';
                                    CodHTML += '</td>';
                                    CodHTML += '<td align="left" valign="top" style="font-size: 13pt; color: #A70202;">';
                                        CodHTML += NoCert;
                                    CodHTML += '</td>';
                                CodHTML += '</tr>';
                            CodHTML += '</table>';

                        CodHTML += '</td>';
                    CodHTML += '</tr>';

                CodHTML += '</table>';

                document.getElementById("CargCSD_Resp").innerHTML = CodHTML;
                
            }
            
        }else{
            CSD_VerifArchsKeyCer();
        }
    }
}
 
 
function CSD_LimpiarDatsArch(){
    
    document.getElementById("CSD_Archivo1").value = "";
    document.getElementById("CSD_Archivo2").value = "";
    document.getElementById('CSD_progressBar').value = "0";
    document.getElementById('CSD_progressBar').style.display = "none";
    document.getElementById("CSD_progress_info").style.display = "none";
    document.getElementById("CSD_ClaveSellos").value = "";
}

//=====================================================================================================

