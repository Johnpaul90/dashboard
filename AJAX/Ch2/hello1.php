<?php
header('Content-Type:text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone= "yes"?>';

echo '<response>';
     $name = $_GET['name'];

echo 'Hello, ' .$name.'!';
echo '<br />';
echo 'I use to know someone called <i>'.$name.'.</i> Are you related ?';

echo '</response>';


?>