<?php
  function getConnection(){
    $conn = new MongoDB\Driver\Manager('mongodb+srv://dbOne:adminadmin@domhome-cvs2b.mongodb.net/test?retryWrites=true&w=majority');
    /* if($conn){
      echo "Conexión establecida";
    }else{
      echo "No se pudo establecer la conexión";
    }*/
    return $conn;
  }
?>