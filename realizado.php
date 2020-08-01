<?php 
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];


if($method=="GET"){
    $vector = array();
    $idprofesor = $_GET['id'];
    $api = new Api();
    $vector = $api->getTallerProfesor($idprofesor);
    $json = json_encode($vector);
    echo $json;
       
}

if($method=="POST"){
    $json = null;
    $archivo = (file_get_contents($_FILES['archivo']['tmp_name']));  
    $materia =$_POST['materia'];
    $grado = $_POST['grado'];
    $idprofesor = $_POST['idprofesor'];
    $fecha = date("Y-m-d"); 
    $api = new Api();
    $json = $api->addArchivoRealizado($materia,$grado,$archivo,$fecha, $idprofesor);
    echo $json;
}
 //  echo '{"msg":"'.$hora.'"}'; 



?>