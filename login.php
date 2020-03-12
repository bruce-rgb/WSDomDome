<?php
  include_once 'conection.php';

  //Recibir datos POST
  $data = json_decode(file_get_contents('php://input'),true);
  $usuario = $data['usuario'];
  $password = $data['password'];

  //Crear un objeto de tipo conexión
  $mongo = getConnection();

  //Consulta
  $filtros = ['usuario'=>''.$usuario.'', 'password'=>''.$password.'']; 
      //print_r($filtros); //PRUEBAS
  $opciones = [];
  $query = new MongoDB\Driver\Query($filtros, $opciones);
  $cursor = $mongo->executeQuery('bd_domotica_divided.usuario',$query);

  foreach($cursor as $row){
    $row;
  }
  
  if($row != null ){ 
    $userData = json_decode(json_encode($row), true);
    header("HTTP/1.1 200 OK");
    echo json_encode($userData);
  }
  else {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(array("mensaje"=>"Datos de acceso incorrectos"));
  }

?>