<?php 
$contents = @file_get_contents('C:/private/filetest01.txt');
if ($contents === false) {
echo 'Sorry, there was a problem reading the file!';
}
else {
// convert contents to uppercase and display
echo strtoupper($contents);
}?>