<?php
// create a socket connection
$remote = fsockopen('www.friendsofed.com', 80, $errno, $errstr, 30);
   if (!$remote) {
      // if no connection, display the error message and number
      echo "$errstr ($errno)";
   }
   else {
      // otherwise communicate with remote server
      // prepare the request
      $out = "GET /news.php HTTP/1.1\r\n";
      $out .= "Host: www.friendsofed.com\r\n";
      $out .= "Connection: Close\r\n\r\n";
      // send the request
     fwrite($remote, $out);
	 // initialize a variable to capture the response
     $received = '';
     // keep the connection open until the end of the response
     while (!feof($remote)) {
        $received .= fgets($remote, 1024);
     }
     // close the connection
     fclose($remote);
   }
echo $received;
?>