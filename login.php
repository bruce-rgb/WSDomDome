<?php
  include_once 'conection.php';

  //Recibir datos POST
  $data = json_decode(file_get_contents('php://input'),true);
  $usuario = $data['usuario'];
  $password = $data['password'];

  //Crear un objeto de tipo conexión
  $mongo = getConnection();

  //Consulta de datos de usuarios
  $filtros = ['usuario'=>''.$usuario.'', 'password'=>''.$password.'']; 
      //print_r($filtros); //PRUEBAS
  $opciones = [];
  $query = new MongoDB\Driver\Query($filtros, $opciones);
  $cursor = $mongo->executeQuery('bd_domotica_divided.usuario',$query);
  foreach($cursor as $row){$row;}
  
  if(isset($row ) != null ){   //isset si row esta definido y es diferente de null 
    $userData = json_decode(json_encode($row), true); //transforma objeto a arreglo
    
    $id_domicilio = $userData['id_domicilio'];
    $nombre = $userData['nombre'];
    $ap_paterno = $userData['ap_paterno'];
    $ap_materno = $userData['ap_materno'];

      //Consulta de datos de domicilio
      $filtros = ['id'=>''.$id_domicilio.'']; 
      $opciones = [];
      $query = new MongoDB\Driver\Query($filtros, $opciones);
      $cursor = $mongo->executeQuery('bd_domotica_divided.domicilio',$query);

      foreach($cursor as $domicilio){$domicilio;}

      $domicilioUser = json_decode(json_encode($domicilio), true);
      $calle = $domicilioUser['calle'];
      $ciudad = $domicilioUser['ciudad'];
      $estado = $domicilioUser['estado'];

    header("HTTP/1.1 200 OK");
    echo json_encode(array(
      "nombre"=>"$nombre",
      "ap_paterno"=>"$ap_paterno",
      "ap_materno"=>".$ap_materno.",
      "calle"=>"$calle",
      "ciudad"=>"$ciudad",
      "estado"=>"$estado",
    )); 
  }
  else {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(array("mensaje"=>"Datos de acceso incorrectos"));
  }

?>