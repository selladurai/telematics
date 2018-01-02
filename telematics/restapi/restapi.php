<?php
include_once $_SERVER["DOCUMENT_ROOT"]."restapi/restapifunctions.php";
include_once $_SERVER["DOCUMENT_ROOT"]."restapi/commonfunctions.php";
$_data_decrypt=new commonfunctions();
$_data_dcrypt=$_data_decrypt->my_simple_crypt($_GET["params"],"d");
$_get_params=json_decode(htmlspecialchars_decode($_data_dcrypt),true);
$_call_rest=new restAPI($_get_params["resquest"],$_get_params["server"]);
$_rest_response=$_call_rest->getdevice();
echo json_encode($_rest_response);
?>