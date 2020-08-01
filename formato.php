<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    $vector = array();
    $api = new Api();
    $vector = $api->getFormato();
    $json = json_encode($vector);
    echo $json;
}


if($method=="POST"){
    $json = null;
    $semillero = $_POST['semillero'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $identificacion = $_POST['identificacion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $categoria = $_POST['categoria'];
    $area = $_POST['area'];
    $archivo = (file_get_contents($_FILES['archivo']['tmp_name']));
    $api = new Api();
    $json = $api->addFormato($semillero, $titulo,$autor, $identificacion, $email,$telefono,$categoria,$area,$archivo);
    echo $json;
}

?>