<?php

class Api{

public function login($correo, $clave, $bandera){
   $conexion = new conexion();
   $db = $conexion->getConexion();

     if($bandera=="alumno"){
      $sql = "SELECT * FROM alumno WHERE correo=:correo  AND clave=:clave ";
      $consulta = $db->prepare($sql);
      $consulta->bindParam(':correo', $correo);
      $consulta->bindParam(':clave', $clave);
      $consulta->execute();
      
      if($fila = $consulta->fetch()){
        $id = $fila['identificacion'];
        $grado = $fila['grado']; 
        $clave = $fila['clave'];
        $nombre = $fila['nombre'];
        return '{"id": "'.$id.'","clave":"'.$clave.'","grado":"'.$grado.'","bandera":"'.$bandera.'","nombre":"'.$nombre.'"}';

   }
     }
     if($bandera=="profesor"){
      $vacio="";
      $sql = "SELECT * FROM profesor WHERE correo=:correo  AND clave=:clave ";
      $consulta = $db->prepare($sql);
      $consulta->bindParam(':correo', $correo);
      $consulta->bindParam(':clave', $clave);
      $consulta->execute();
  
      if($fila = $consulta->fetch()){
        $id = $fila['identificacion']; 
        $clave = $fila['clave'];
        $nombre = $fila['nombre'];
        return '{"id": "'.$id.'","clave":"'.$clave.'","bandera":"'.$bandera.'","nombre":"'.$nombre.'","grado":"'.$vacio.'"}';

   }  }
        return '{"msg":"problema"}';   
 }

public function addForo($materia,$respuesta, $fechaEnvio,$fecha ){
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO foro (descripcion, materia,fecha,fechaenvio) VALUES (:descripcion,:materia,:fecha,:fechaenvio)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':descripcion', $respuesta);
  $consulta->bindParam(':materia', $materia);
  $consulta->bindParam(':fecha', $fecha);
  $consulta->bindParam(':fechaenvio', $fechaEnvio);
  $consulta->execute();
  return '{"msg":"exito"}';
}

public function addForoNuevo($materia,$descripcion,$fecha ){
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO foro (descripcion, materia,fecha) VALUES (:descripcion,:materia,:fecha)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':descripcion', $descripcion);
  $consulta->bindParam(':materia', $materia);
  $consulta->bindParam(':fecha', $fecha);
  $consulta->execute();
  return '{"msg":"exito"}';
}

public function addFormato($semillero, $titulo,$autor, $identificacion, $email,$telefono,$categoria,$area,$archivo ){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO formato (semillero, titulo,autor,identificacion,email,telefono,categoria,area,archivo) VALUES (:semillero,:titulo,:autor,:identificacion,:email,:telefono,:categoria,:area,:archivo)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':semillero', $semillero);
  $consulta->bindParam(':titulo', $titulo);
  $consulta->bindParam(':autor', $autor);
  $consulta->bindParam(':identificacion', $identificacion);
  $consulta->bindParam(':email', $email);
  $consulta->bindParam(':telefono', $telefono);
  $consulta->bindParam(':categoria', $categoria);
  $consulta->bindParam(':area', $area);
  $consulta->bindParam(':archivo', $archivo);
  $consulta->execute();
  return '{"msg":"guardado"}';
 

}



public function getProfesores(){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM profesor";
   $consulta = $db->prepare($sql);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "nombre" => $fila['nombre'],
         "identificacion" => $fila['identificacion'],
         "telefono" => $fila['telefono'],
         "correo" =>  $fila['correo']);
         }//fin del ciclo while 

   return $vector;
}

 public function getForo(){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM foro";
   $consulta = $db->prepare($sql);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "descripcion" => $fila['descripcion'],
         "materia" => $fila['materia'],
         "fecha" =>  $fila['fecha'],
         "fechaenvio" =>  $fila['fechaenvio']);
         }//fin del ciclo while 

   return $vector;
}
public function getTaller($grado){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM taller WHERE grado=:grado";
   $consulta = $db->prepare($sql);
   $consulta->bindParam(':grado', $grado);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "descripcion" => $fila['descripcion'],
         "materia" => $fila['materia'],
         "fecha" =>  $fila['fecha'],
         "archivo" =>  base64_encode($fila['archivo']),
         "idprofesor"=>$fila['idprofesor']);
         }//fin del ciclo while 

   return $vector;
}

public function getTallerProfesor($idprofesor){
 
   $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM tallerhecho WHERE idprofesor=:idprofesor";
   $consulta = $db->prepare($sql);
   $consulta->bindParam(':idprofesor', $idprofesor);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "materia" => $fila['materia'],
         "grado" => $fila['grado'],
         "archivo" =>  base64_encode($fila['archivo']),
         "fecha" =>  $fila['fecha'],
         "idprofesor"=>$fila['idprofesor']);
         }//fin del ciclo while 

   return $vector;
}


public function getTallerRecibido(){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM tallerhecho";
   $consulta = $db->prepare($sql);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "materia" => $fila['materia'],
         "grado" => $fila['grado'],
         "archivo" => base64_encode($fila['archivo']),
         "fecha" =>  $fila['fecha'],
       );
         }//fin del ciclo while 

   return $vector;
}


public function getAlumno(){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM alumno";
   $consulta = $db->prepare($sql);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "nombre" => $fila['nombre'],
         "identificacion" => $fila['identificacion'],
         "grado" =>  $fila['grado']);
         }//fin del ciclo while 

   return $vector;


}

public function getAlumnoChat($grado){
 
  $vector = array();
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "SELECT id, identificacion, nombre FROM alumno WHERE grado=:grado";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':grado', $grado);
  $consulta->execute();
  while($fila = $consulta->fetch()) {
       $vector[] = array(
          "id" => $fila['id'],
          "nombre" => $fila['nombre'],
          "identificacion"=>$fila['identificacion']);
         }//fin del ciclo while 

   return $vector;
}

public function getMensajes($id, $sid){
 
  $vector = array();
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "SELECT * FROM chat WHERE idrecibe=:id";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':id', $sid);
  $consulta->execute();
  while($fila = $consulta->fetch()) {
    if($fila['idenvio']==$id){
      $vector[] = array(
        "id" => $fila['id'],
        "mensaje"=>$fila['mensaje'],
        "fecha"=>$fila['fecha'],
        "nombre" => $fila['nombre'],  
        "idenvio"=> $fila['idenvio'],    
      );  }
     
} 
 return $vector;
}

public function addMensaje($mensaje,$fecha,$idenvio, $nombre,$idrecibe ){
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO chat (mensaje,fecha,idenvio,nombre,idrecibe) VALUES (:mensaje,:fecha,:idenvio,:nombre,:idrecibe)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':mensaje', $mensaje);
  $consulta->bindParam(':fecha', $fecha);
  $consulta->bindParam(':idenvio', $idenvio);
  $consulta->bindParam(':nombre',$nombre);
  $consulta->bindParam(':idrecibe',$idrecibe);
  $consulta->execute();
  return '{"msg":"mensaje enviado"}';
}

public function addProfesor($nombre, $identificacion, $telefono, $correo, $clave ){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO profesor (nombre, identificacion, telefono, correo, clave) VALUES (:nombre,:identificacion,:telefono,:correo,:clave)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':nombre', $nombre);
  $consulta->bindParam(':identificacion', $identificacion);
  $consulta->bindParam(':telefono', $telefono);
  $consulta->bindParam(':correo', $correo);
  $consulta->bindParam(':clave', $clave);
  $consulta->execute();

  return '{"msg":"agregado con exito"}';
}

public function addAlumno($nombre, $identificacion, $grado, $correo, $clave ){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO alumno (nombre, identificacion, grado, correo, clave) VALUES (:nombre,:identificacion,:grado,:correo,:clave)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':nombre', $nombre);
  $consulta->bindParam(':identificacion', $identificacion);
  $consulta->bindParam(':grado', $grado);
  $consulta->bindParam(':correo', $correo);
  $consulta->bindParam(':clave', $clave);
  $consulta->execute();

  return '{"msg":"agregado con exito"}';
}


public function deleteMensajes($id){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "DELETE FROM chat WHERE id=:id";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':id', $id); 
  $consulta->execute();

  return '{"msg":"mensaje eliminada"}';
}

public function addArchivo($descripcion,$materia,$grado,$fecha,$archivo){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO taller (descripcion,materia,grado,fecha,archivo, idprofesor ) VALUES (:descripcion,:materia,:grado,:fecha,:archivo,:identificacion)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':descripcion', $descripcion);
  $consulta->bindParam(':materia', $materia);
  $consulta->bindParam(':grado', $grado);
  $consulta->bindParam(':fecha', $fecha);
  $consulta->bindParam(':archivo', $archivo);
  $consulta->bindParam(':identificacion', $identificacion);
  $consulta->execute();

  return '{"msg":"taller agregado"}';
}

public function addArchivoRealizado($materia,$grado,$archivo,$fecha, $idprofesor){
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO tallerhecho (materia,grado,archivo,fecha, idprofesor) VALUES (:materia,:grado,:archivo,:fecha,:idprofesor)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':materia', $materia);
  $consulta->bindParam(':grado', $grado);
  $consulta->bindParam(':archivo', $archivo);
  $consulta->bindParam(':fecha', $fecha);
  $consulta->bindParam(':idprofesor', $idprofesor);
  $consulta->execute();
  return '{"msg":"taller enviado"}';
}


public function getFormato(){
 
  $vector = array();
   $conexion = new Conexion();
   $db = $conexion->getConexion();
   $sql = "SELECT * FROM formato";
   $consulta = $db->prepare($sql);
   $consulta->execute();
   while($fila = $consulta->fetch()) {
       $vector[] = array(
         "id" => $fila['id'],
         "semillero" => $fila['semillero'],
         "titulo" => $fila['titulo'],
         "autor" => $fila['autor'],
         "identificacion" => $fila['identificacion'],
         "email" =>  $fila['email'],
         "telefono" => $fila['telefono'],
         "categoria" => $fila['categoria'],
         "area" => $fila['area'],
         "archivo" => base64_encode($fila['archivo']));
         }//fin del ciclo while 

   return $vector;
}


}

?>