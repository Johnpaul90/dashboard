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
  $conn = new mysqli('localhost', $user, $pwd, 'phpsolutions') or die ('Cannot open database');
  return $conn;
}