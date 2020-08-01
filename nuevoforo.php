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
    $descripcion = $data['descripcion'];
    $materia = $data['materia'];
    $fecha = $data['fecha']; 
    $api = new Api();
    $json = $api->addForoNuevo($materia, $descripcion, $fecha );
    echo $json;
}

?>