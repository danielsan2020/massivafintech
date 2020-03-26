<?php
header("Content-Type: application/xml");
include ("Conexion.php");

$CadBus = strtoupper($_GET["CadBus"]);
$TipBus = $_GET["TipBus"];

$CodXML   = "";
$Cad      = "";
$CadSQL   = "";
$Cond     = "";
$SQL      = "";
$Param    = "";
$Grupo    = "";
$ClaveSAT = "";
$GpoEnPro = "";



if ($TipBus=="PRODSERV"){
    
    $ArrayDats = explode(" ", $CadBus);
    $SQL = "select Descrip, ClaveSAT, RefSubCat, Grupo from cfdi33_cat_prodserv where ";

    for ($i=0; $i<count($ArrayDats); $i++){

        if (strlen($Cond)>0){
            $Cond .= " and";
        }

        $Cond .= " Descrip like '%".$ArrayDats[$i]."%'";
    }

    $CadSQL = $SQL.$Cond."  and RefSubCat<>'00' order by ClaveSAT asc";
    $RstProdServ = mysqli_query($conexion, $CadSQL);


    $CodXML .= "<rst Descrip='NO EXISTE EN EL CATALOGO' ClaveSAT='01010101' RefSubCat='' Grupo='' />\n";

    while ($RowProdServ = mysqli_fetch_array($RstProdServ)){

        $ClaveSAT = $RowProdServ["ClaveSAT"];
        $Grupo    = $RowProdServ["Grupo"];

        if ($GpoEnPro != $Grupo){

            $RstClaSat  = mysqli_query($conexion, "select Descrip, ClaveSAT, RefSubCat, Grupo from cfdi33_cat_prodserv where ClaveSAT='$Grupo' limit 1");
            $RowClaSat  = mysqli_fetch_array($RstClaSat);
            $GpoEnPro = $Grupo;

            $CodXML .= "<rst Descrip='".$RowClaSat["Descrip"]."' ClaveSAT='".$RowClaSat["ClaveSAT"]."' RefSubCat='".$RowClaSat["RefSubCat"]."' Grupo='".$RowClaSat["Grupo"]."' />\n";
        }

        $CodXML .= "<rst Descrip='".$RowProdServ["Descrip"]."' ClaveSAT='".$RowProdServ["ClaveSAT"]."' RefSubCat='".$RowProdServ["RefSubCat"]."' Grupo='".$RowProdServ["Grupo"]."' />\n";    
    }

    $Param = "<param CadBus='$CadBus' />\n";

    echo "<datos>\n".$Param.$CodXML."</datos>";
}


if ($TipBus=="UNIMED"){

    $ArrayDats = explode(" ", $CadBus);
    $SQL = "select Clave, Nombre, Descrip from cfdi33_cat_unimed where ";

    for ($i=0; $i<count($ArrayDats); $i++){

        if (strlen($Cond)>0){
            $Cond .= " and";
        }

        $Cond .= " Nombre like '%".$ArrayDats[$i]."%'";
    }

    $CadSQL = $SQL.$Cond." order by Clave";
    $RstCatUniMed = mysqli_query($conexion, $CadSQL);


    while ($RowCatUniMed = mysqli_fetch_array($RstCatUniMed)){

        $CodXML .= "<rst Clave='".$RowCatUniMed["Clave"]."' Nombre='".$RowCatUniMed["Nombre"]."' Descrip='".$RowCatUniMed["Descrip"]."' />\n";
    }

    $Param = "<param CadBus='$CadBus' />\n";

    echo "<datos>\n".$Param.$CodXML."</datos>";

}


