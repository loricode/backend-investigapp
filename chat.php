<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if($method=="POST"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true); 
    $mensaje = $data['mensaje'];
    $idenvio = $data['identificacion'];
    $nombre = $data['nombre'];
    $idrecibe = $data['idrecibe'];
    $fecha = date("Y-m-d");
    $api = new Api();
    $json = $api->addMensaje($mensaje, $fecha,$idenvio,$nombre, $idrecibe);
    echo $json;
}

if($method=="GET"){
    $vector = array();
    $id = $_GET['id'];
    $ids = $_GET['ids'];
    $api = new Api();
    $vector = $api->getMensajes($id, $ids);
    $json = json_encode($vector);
    echo $json;
    //echo '{"msg":"'.$ids.'"}';
}

if($method =="DELETE"){
    $json = null;
    $id = $_GET['id'];
    $api = new Api();
    $string = $api->deleteMensajes($id);
    $json = json_encode($string);
    echo $json;

}

?>