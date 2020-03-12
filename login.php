<?php
  include_once 'conection.php';

  //Crear un objeto de tipo conexión
  $mongo = getConnection();

  //Consulta
  $filtros=['ciudad'=>'Puebla']; //$filtros=['nombre'=>'valor_atributo'];
  $opciones=[];
  $query=new MongoDB\Driver\Query($filtros,$opciones);
  $cursor=$mongo->executeQuery('db_domotica.domicilio',$query);

  foreach($cursor as $row){
    print_r($row);
  }
  
?>