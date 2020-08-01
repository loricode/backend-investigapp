<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];


if($method=="POST"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $bandera = $data['bandera'];
    $correo = $data['correo'];
    $clave = $data['clave'];
    $api = new Api();
    $json = $api->login($correo, $clave, $bandera);
    echo $json;
   
         
    
    
}

?>