<?php require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $vector = array();
        $grado = $_GET['id'];
        $api = new Api();
        $vector = $api->getAlumnoChat($grado);
        $json = json_encode($vector);
        echo $json;
    }else{
        $vector = array();
        $api = new Api();
        $vector = $api->getAlumno();
        $json = json_encode($vector);
        echo $json;
    }
   
}

if($method=="POST"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data['nombre'];
    $identificacion = $data['identificacion'];
    $grado = $data['grado'];
    $correo = $data['correo'];
    $clave = $data['clave'];
    $api = new Api();
    $json = $api->addAlumno($nombre, $identificacion,$grado, $correo, $clave );
    echo $json;
}

?>