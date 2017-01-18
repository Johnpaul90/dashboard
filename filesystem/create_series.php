<?php
if (array_key_exists('putContents', $_POST)) {
   include('getNextFilename5.php');

$dir = 'C:/private';
$filename = getNextFilename5($dir, 'comment', 'txt');
// attempt to create file only if $filename contains a real value
   if ($filename) {
      // create a file ready for writing only if it doesn't already exist
       if ($file = @ fopen("$dir/$filename", 'x')) {
          // write the contents
          fwrite($file, $_POST['contents']);
          // close the file
          fclose($file);
          $result = "$filename created";
       }
        else {
         $result = 'Cannot create file';
        }
   }
   else {
        $result = 'Invalid folder or filename';
   }
   
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Exclusive write</title>
</head>

<body>
<?php
   if (isset($result)) {
       echo "<p><strong>$result</strong></p>";
   }
?>
<form id="writeFile" name="writeFile" method="post" action="">
    <p>
        <label for="contents">Write this to file:</label>
        <textarea name="contents" cols="40" rows="6" id="contents"></textarea>
    </p>
    <p>
        <input name="putContents" type="submit" id="putContents" value="Write to file">
    </p>
</form>
</body>
</html>
