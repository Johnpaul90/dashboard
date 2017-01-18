<?php
// define a constant for the maximum upload size
define ('MAX_FILE_SIZE', 512000);
if (array_key_exists('upload', $_POST)) {
    // define constant for upload folder
    define('UPLOAD_DIR', 'C:/upload_test/');
    
	// convert the maximum size to KB
    $max = number_format(MAX_FILE_SIZE/1024, 1).'KB';
    // create an array of permitted MIME types
    $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg','image/png');
	
   foreach ($_FILES['image']['name'] as $number => $file) {
       // replace any spaces in the filename with underscores
        $file = str_replace(' ', '_', $file);
       // begin by assuming the file is unacceptable
        $sizeOK = false;
        $typeOK = false;
       // check that file is within the permitted size
   if ($_FILES['image']['size'][$number] > 0 || $_FILES['image']['size'][$number] <= MAX_FILE_SIZE) {
       $sizeOK = true;
      }
    // check that file is of a permitted MIME type
   foreach ($permitted as $type) {
      if ($type == $_FILES['image']['type'][$number]) {
           $typeOK = true;
           break;
     }
     }
   if ($sizeOK && $typeOK) {
      switch($_FILES['image']['error'][$number]) {
          case 0:
          // check if a file of the same name has been uploaded
          if (!file_exists(UPLOAD_DIR.$file)) {
          // move the file to the upload folder and rename it
              $success = move_uploaded_file($_FILES['image']['tmp_name'][$number], UPLOAD_DIR.$file);
     }
    else {
        // get the date and time
       ini_set('date.timezone', 'Africa/Lagos');
       $now = date('Y-m-d-His');
       $success = move_uploaded_file($_FILES['image']['tmp_name'][$number], UPLOAD_DIR.$now.$file);
     }
    if ($success) {
       $result[] = "$file uploaded successfully";
     }
    else {
         $result[] = "Error uploading $file. Please try again.";
    }
         break;
		 
		 case 3:
         $result[] = "Error uploading $file. Please try again.";
         default:
         $result[] = "System error uploading $file. Contact webmaster.";
    }
	}
   elseif ($_FILES['image']['error'][$number] == 4) {
        $result[] = 'No file selected';
   }
    else {
        $result[] = "$file cannot be uploaded. Maximum size: $max. Acceptable file types: gif, jpg, png.";
    }
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Multiple Upload</title>
</head>

<body>
<?php
if (isset($result)) {
echo '<ol>';
foreach ($result as $item) {
echo "<strong><li>$item</li></strong>";
}
echo '</ol>';
}
?>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
  <p>
    <label for="image">Upload image_1:</label>
    <input type="file" name="image[]" id="image">
  </p>
  <p>
    <label for="image2">Upload image_2:</label>
    <input type="file" name="image[]" id="image2">
  </p>
  <p>
    <label for="image3">Upload image_3:</label>
    <input type="file" name="image[]" id="image3">
  </p>
  <p>
    <input type="submit" name="upload" id="upload" value="Upload">
  </p>
</form>
</body>
</html>

 