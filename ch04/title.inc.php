<?php
$title = basename($_SERVER['SCRIPT_NAME'], '.php');
if ($title == 'index') {
$title = 'home';
}else if($title=='blog'){
$title='journal';
}
$title = ucfirst($title);
?>