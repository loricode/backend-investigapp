<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];


if($method=="GET"){
    $vector = array();
    $grado = $_GET['grado'];
    $api = new Api();
    $vector = $api->getTaller($grado);
    $json = json_encode($vector);
    echo $json;
       
}
if($method=="POST"){
    $json = null;
    $archivo = (file_get_contents($_FILES['archivo']['tmp_name']));
    $descripcion = $_POST['descripcion'];
    $materia = $_POST['materia'];
    $grado = $_POST['grado'];
    $identificacion = $_POST['identificacion'];
    $fecha = date("Y-m-d"); 
    $api = new Api();
    $json = $api->addArchivo($descripcion,$materia,$grado,$fecha,$archivo, $identificacion);
    echo $json;
}



?>