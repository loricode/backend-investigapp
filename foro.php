<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];


if($method=="GET"){
    $vector = array();
    $api = new Api();
    $vector = $api->getForo();
    $json = json_encode($vector);
    echo $json;
}

if($method=="POST"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $materia = $data['materia'];
    $respuesta = $data['respuesta'];
    $fecha = $data['fecha'];
    $fechaEnvio = date("Y-m-d"); 
    $api = new Api();
    $json = $api->addForo($materia, $respuesta, $fechaEnvio, $fecha );
    echo $json;
}

?>