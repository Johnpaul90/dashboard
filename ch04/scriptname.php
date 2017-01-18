<?php
echo"The time is ".date("h:i:s A");
echo"<br />";
printf("Your IP address is: %s", $_SERVER['REMOTE_ADDR']);
echo"<br />";
echo $_SERVER['PHP_SELF']; 
echo"<br />";
$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
echo $current;
echo"<br />";
$filename = basename($_SERVER['SCRIPT_FILENAME']);
echo $filename;
echo"<br />";
echo basename($_SERVER['SCRIPT_NAME']);
echo "<br />";
echo basename($_SERVER['SCRIPT_NAME'], '.php');
echo "<br />";
echo $_SERVER['DOCUMENT_ROOT'];
echo "<br />";
if (isset($_SERVER['DOCUMENT_ROOT'])) {
echo 'Supported. The server root is '.$_SERVER['DOCUMENT_ROOT'];
}
else {
echo "\$_SERVER['DOCUMENT_ROOT'] is not supported";
}
?>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
  <p>
    <label for="image">Upload image:</label>
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
    <input type="file" name="image" id="image">
  </p>
  <p>
    <input type="submit" name="upload" id="upload" value="Upload">
  </p>
</form>
<?php
if(isset($_POST['upload'])){
print_r($_FILES);
}

phpinfo();
?>
