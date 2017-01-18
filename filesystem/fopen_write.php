<?php
// if the form has been submitted, process the input text
if (array_key_exists('putContents', $_POST)) {
// strip backslashes from the input text and save to shorter variable
$contents = get_magic_quotes_gpc() ?stripslashes($_POST['contents']) : $_POST['contents'];
// open the file in write-only mode
$file = fopen('C:/private/filetest04.txt', 'w');
// write the contents
fwrite($file, $contents);
// close the file
fclose($file);
}
?>