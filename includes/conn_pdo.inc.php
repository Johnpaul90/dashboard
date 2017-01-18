<?php
  function dbConnect($type) {
    if ($type == 'query') {
       $user = 'psquery';
       $pwd = 'emerie1990';
    }
    elseif ($type == 'admin') {
       $user = 'psadmin';
       $pwd = 'emerie1990';
    }
    else {
      exit('Unrecognized connection type');
    }
    // Connection code goes here
    try {
       $conn = new PDO('mysql:host=localhost;dbname=phpsolutions', $user, $pwd);
       return $conn;
    }
     catch (PDOException $e) {
       echo 'Cannot connect to database';
       exit;
    }
 }
?>