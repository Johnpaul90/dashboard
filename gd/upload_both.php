<?php
define ('MAX_FILE_SIZE', 500000);
if (array_key_exists('upload', $_POST)) {
// define constant for upload folder
    define('UPLOAD_DIR', 'C:/upload_test/');
	$file = str_replace(' ', '_', $_FILES['image']['name']);
	// convert the maximum size to KB
    $max = number_format(MAX_FILE_SIZE/1024, 1).'KB';
	// create an array of permitted MIME types
    $permitted = array('image/gif','image/jpeg','image/pjpeg','image/jpg','image/png');
// begin by assuming the file is unacceptable
    $sizeOK = false;
	$typeOK = false;
// check that file is within the permitted size
 
 ini_set('date.timezone', 'Africa/Lagos');
$now = date('Y-m-d-His');

if ($_FILES['image']['size'] > 0 && $_FILES['image']['size'] <= MAX_FILE_SIZE) {
     $sizeOK = true;
}
  // check that file is of a permitted MIME type
   foreach ($permitted as $type) {
  if ($type == $_FILES['image']['type']) {
      $typeOK = true;
      break;
}
}
if ($sizeOK && $typeOK) {
   switch($_FILES['image']['error']) {
      case 0:
	  include('create_both.inc.php');
break;
    case 3:
   $result = "Error uploading $file. Please try again.";
default:
   $result = "System error uploading $file. Contact webmaster.";
}
}
elseif ($_FILES['image']['error'] == 4) {
   $result = 'No file selected';
}
else {
   $result = "$file cannot be uploaded. Maximum size: $max.Acceptable file types: gif, jpg, png.";
}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Upload File</title>
</head>

<body>
<?php
// if the form has been submitted, display result
if (isset($result)) {
echo "<p><strong>$result</strong></p>";
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
</body>
</html>
