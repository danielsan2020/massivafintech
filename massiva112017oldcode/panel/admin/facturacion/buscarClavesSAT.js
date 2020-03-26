
var CFD33_Array_CadBus = new Array(); 
var CFDI33_Array_CadBusUniMed = new Array();

var Array_CFDI33_CatProdServ_Descrip   = new Array();
var Array_CFDI33_CatProdServ_ClaveSAT  = new Array();
var Array_CFDI33_CatProdServ_RefSubCat = new Array();
var Array_CFDI33_CatProdServ_Grupo     = new Array();

var Array_CFDI33_UniMedSAT_Clave   = new Array();
var Array_CFDI33_UniMedSAT_Nombre  = new Array();
var Array_CFDI33_UniMedSAT_Descrip = new Array();

var ClaSAT_TipBus = "";
var UltInd_CatUniMedSAT = -1;
var UltInd_CatProdServ = -1;


var xmlHttp;

function CreateXmlHttp() {
    if (window.XMLHttpRequest) {
            xmlHttp =  new XMLHttpRequest();
    } else if (window.ActiveXObject) {
            xmlHttp =  new ActiveXObject("Microsoft.XMLHTTP");
    }
}


function NumAleat(){
    Num =  Math.floor((Math.random()*10000000000)+1);
    return Num;
}   


function LimpiarCadenaObj(Objeto){

      Cadena = "";
      Cad2 = "";
      Espacio = 0;
      Letr = "";

      Cadena = allTrim(Objeto.value);
      Cadena = Cadena.replace(/[*\&\|\’\'\\]/gi, "");

      ArrayLetras = Cadena.split("");

      NoElement = ArrayLetras.length;
      A = 0;

      while (NoElement>0){

         if (ArrayLetras[A] == " "){
              if (Espacio == 0){
                Cad2 = Cad2 + ArrayLetras[A];
                Espacio = 1;
              }
         }else{
             Letr = ArrayLetras[A];
             
             Cad2 = Cad2 + Letr;
             Espacio = 0;
         }

         A = A + 1;
         NoElement = NoElement - 1;
      }

      Objeto.value = Cad2;
}


function lTrim(sStr){
  while (sStr.charAt(0) == " ")
   sStr = sStr.substr(1, sStr.length - 1);
  return sStr;
}


function rTrim(sStr){
  while (sStr.charAt(sStr.length - 1) == " ")
    sStr = sStr.substr(0, sStr.length - 1);
  return sStr;
}


function allTrim(sStr){
  return rTrim(lTrim(sStr));
}


function resaltarTexto(str, cad){
    var res = str.replace(cad, '<span style="color: #088A29; font-weight: bold;">'+cad+'</span>');
    return res;
}    


function ClaSAT_BusArtSerDetectTecl(e){

    var tecla = (document.all) ? e.keyCode : e.which;

    if (tecla===13){
        
        var CadBus = document.getElementById("ClaSAT_CadBus").value;
        
        
        if (document.getElementsByName("ClaSAT_OpcsBus")[0].checked===true){
            ClaSAT_TipBus = "PRODSERV";
        }else{
            ClaSAT_TipBus = "UNIMED";
        }
        
        if (CadBus.length<3){
            
            alert("El texto a bucar debe ser igual o mayor a 3 letras");
            document.getElementById("ClaSAT_CadBus").focus();
            return false;
        }

        if (CadBus.length>0){
            
            document.getElementById("ClaSAT_Tabla").innerHTML   = '<img src="images/progress_bar.gif" width="32" height="32" style="margin-left: 15px; margin-top: 15px;" alt="progress_bar"/>';
            document.getElementById("ClaSAT_Descrip").innerHTML = "";
            document.getElementById("ClaSAT_Clave").innerHTML   = "";
            
            CreateXmlHttp();
            var ajaxRequest = "ScriptPHP_CFDI33_BuscarClavesSAT.php?CadBus="+CadBus+"&TipBus="+ClaSAT_TipBus;
            xmlHttp.onreadystatechange = Resp_BuscarClavesSAT;
            xmlHttp.open("GET", ajaxRequest, true);
            xmlHttp.send("");
            
            document.getElementById("ClaSAT_CadBus").value = "";
            document.getElementById("ClaSAT_CadBus").focus();
        }
    }    
}


function Resp_BuscarClavesSAT(){
    
    if(xmlHttp.readyState===4 && xmlHttp.status===200){
        
//        alert(xmlHttp.responseText);
        
        var DocXML = xmlHttp.responseXML;
        
        if (ClaSAT_TipBus==="PRODSERV"){
        
            CFD33_Array_CadBus = [];
            Array_CFDI33_CatProdServ_Descrip = [];
            Array_CFDI33_CatProdServ_ClaveSAT = [];
            Array_CFDI33_CatProdServ_RefSubCat = [];
            Array_CFDI33_CatProdServ_Grupo = [];
            
            var CantRegs  = DocXML.getElementsByTagName("rst").length;
            var CadBus = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("CadBus");

            CFD33_Array_CadBus = CadBus.split(" ");   

            for(var i=0;i<CantRegs;i++){

                Array_CFDI33_CatProdServ_Descrip.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("Descrip"));
                Array_CFDI33_CatProdServ_ClaveSAT.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("ClaveSAT"));
                Array_CFDI33_CatProdServ_RefSubCat.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("RefSubCat"));
                Array_CFDI33_CatProdServ_Grupo.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("Grupo"));
            }    

            CFDI33_CrearTabla_ProdServSAT();
        }
        
        if (ClaSAT_TipBus==="UNIMED"){
        
            Array_CFDI33_UniMedSAT_Clave = new Array();
            Array_CFDI33_UniMedSAT_Nombre = new Array();
            Array_CFDI33_UniMedSAT_Descrip = new Array();      

            CFDI33_Array_CadBusUniMed = [];

            var DocXML = xmlHttp.responseXML;

            var CadBus = DocXML.firstChild.getElementsByTagName("param")[0].getAttribute("CadBus");
            CFDI33_Array_CadBusUniMed = CadBus.split(" ");

            var CantRegs  = DocXML.getElementsByTagName("rst").length;

            for(var i=0;i<CantRegs;i++){

                Array_CFDI33_UniMedSAT_Clave.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("Clave"));
                Array_CFDI33_UniMedSAT_Nombre.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("Nombre"));
                Array_CFDI33_UniMedSAT_Descrip.push(DocXML.firstChild.getElementsByTagName("rst")[i].getAttribute("Descrip"));
            }    

            CFDI33_CrearTabla_CatUniMedSAT();   
        }        
    }     
}


// Construcción de la tabla HTML correspondiente a "Claves de Productos y Servicios del SAT" =================================

function CFDI33_CrearTabla_ProdServSAT(){
    
    var CodHTML = '';
    var CodHTML2 = '';
    var RefSubCat = '';
    var Descrip = '';
    var str = '';
    var CodHTML2 = '';
    
    UltInd_CatProdServ = -1;

    CodHTML += '<table border="1" cellpadding="4" cellspacing="0" style="width: 530px;" class="EstiloBordeFino">';

        for (var i=0; i<Array_CFDI33_CatProdServ_Descrip.length; i++){
            
            RefSubCat = Array_CFDI33_CatProdServ_RefSubCat[i];
            Descrip   = Array_CFDI33_CatProdServ_Descrip[i];

            CodHTML += '<tr id="TR_CatProdServ'+i+'" onclick="CatProdServ_ProcesTR('+i+')" style="cursor: pointer;">';
            
                if (RefSubCat==="00"){
            
                    CodHTML += '<td align="left" valign="middle" style="width: 84%; font-weight: bold; color: #000000;">';
                        CodHTML += Descrip;
                    CodHTML += '</td>';
                    CodHTML += '<td align="center" valign="middle" style="width: 16%; font-weight: bold; color: #045FB4;">';
                        CodHTML += Array_CFDI33_CatProdServ_ClaveSAT[i];
                    CodHTML += '</td>';
                    
                }else{
                    
                    CodHTML += '<td align="left" valign="middle" style="width: 84%">';

                        if (RefSubCat==="00"){
                            CodHTML += Descrip;
                            
                        } else{
                    
                            str = Descrip;
                            CodHTML2 = '';

                            for (var j=0; j<CFD33_Array_CadBus.length; j++){
                                CodHTML2 = resaltarTexto(str, CFD33_Array_CadBus[j]);
                                str = CodHTML2;
                            }                    
                    
                            CodHTML += CodHTML2;
                        }    
            
                    CodHTML += '</td>';
                    CodHTML += '<td align="center" valign="middle" style="width: 16%; color: #045FB4;">';
                        CodHTML += Array_CFDI33_CatProdServ_ClaveSAT[i];
                    CodHTML += '</td>';
                }
                
            CodHTML += '</tr>';
        }

    CodHTML += '</table>';

    document.getElementById("ClaSAT_Tabla").innerHTML = CodHTML;
}


function CatProdServ_ProcesTR(Ind){

    var Descrip = Array_CFDI33_CatProdServ_Descrip[Ind];
    var Clave   = Array_CFDI33_CatProdServ_ClaveSAT[Ind];
    
    document.getElementById("ClaSAT_Descrip").innerHTML = Descrip;
    document.getElementById("ClaSAT_Clave").innerHTML   = Clave;
    
    
    if (UltInd_CatProdServ>-1){
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.backgroundColor = "";
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.color = "";
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.borderColor = "";
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.borderColor = "";
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.borderStyle = "";
        document.getElementById("TR_CatProdServ"+UltInd_CatProdServ).style.borderWidth = "";
    }
    
    document.getElementById("TR_CatProdServ"+Ind).style.backgroundColor = "#FF9";
    document.getElementById("TR_CatProdServ"+Ind).style.color = "#000000";
    document.getElementById("TR_CatProdServ"+Ind).style.borderColor = "#1309D0";
    document.getElementById("TR_CatProdServ"+Ind).style.borderStyle = "solid";
    document.getElementById("TR_CatProdServ"+Ind).style.borderWidth = "1px";
    
    UltInd_CatProdServ = Ind;
}


// Construcción de la tabla HTML correspondiente a las "Claves de Unidades de Medida del SAT" ================================

function CFDI33_CrearTabla_CatUniMedSAT() {
    
    var CodHTML = '';
    var Descrip = '';
    UltInd_CatUniMedSAT = -1;
    CFDI33_ClaveUnidad = "";
    var NomUniMed = "";
                
    CodHTML += '<table border="1" cellpadding="4" cellspacing="0" style="width: 530px;" class="EstiloBordeFino">';

        for (var i=0; i<Array_CFDI33_UniMedSAT_Clave.length; i++){
        
            NomUniMed = Array_CFDI33_UniMedSAT_Nombre[i];
            Descrip   = Array_CFDI33_UniMedSAT_Descrip[i];

            CodHTML += '<tr id="TR_CatUniMedSAT'+i+'" onclick="CatUniMedSAT_ProcesTR('+i+')" style="cursor: pointer;">';
                CodHTML += '<td align="left" valign="middle" style="width: 84%; color: #414141;">';
                
                        str = NomUniMed;
                        CodHTML2 = '';

                        for (var j=0; j<CFDI33_Array_CadBusUniMed.length; j++){
                            CodHTML2 = resaltarTexto(str, CFDI33_Array_CadBusUniMed[j]);
                            str = CodHTML2;
                        }                    

                        CodHTML += CodHTML2;                
                    
                    if (Descrip!=='SIN DESCRIPCION'){
                        CodHTML += '<br><span style="font-size: 8pt; color: #21677F;">('+Descrip+')</span>';    
                    }
                CodHTML += '</td>';
                CodHTML += '<td align="left" valign="top" style="width: 16%; color: #045FB4;">';
                    CodHTML += '<div id="CFDI33_TD_ClaveUnidad'+i+'">';
                    CodHTML += Array_CFDI33_UniMedSAT_Clave[i];
                    CodHTML += '</div>';
                CodHTML += '</td>';
            CodHTML += '</tr>';

        }

    CodHTML += '</table>';

    document.getElementById("ClaSAT_Tabla").innerHTML = CodHTML;
}


function CatUniMedSAT_ProcesTR(Ind){
    
    var Descrip = Array_CFDI33_UniMedSAT_Descrip[Ind];
    var Clave   = Array_CFDI33_UniMedSAT_Clave[Ind];
    
    document.getElementById("ClaSAT_Descrip").innerHTML = Descrip;
    document.getElementById("ClaSAT_Clave").innerHTML   = Clave;    
    
    if (UltInd_CatUniMedSAT>-1){
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.backgroundColor = "";
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.color = "";
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.borderColor = "";
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.borderColor = "";
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.borderStyle = "";
        document.getElementById("TR_CatUniMedSAT"+UltInd_CatUniMedSAT).style.borderWidth = "";
    }
    
    document.getElementById("TR_CatUniMedSAT"+Ind).style.backgroundColor = "#FF9";
    document.getElementById("TR_CatUniMedSAT"+Ind).style.color = "#000000";
    document.getElementById("TR_CatUniMedSAT"+Ind).style.borderColor = "#1309D0";
    document.getElementById("TR_CatUniMedSAT"+Ind).style.borderStyle = "solid";
    document.getElementById("TR_CatUniMedSAT"+Ind).style.borderWidth = "1px";
    
    UltInd_CatUniMedSAT = Ind;
    
    CFDI33_ClaveUnidad = Array_CFDI33_UniMedSAT_Clave[Ind];
}






