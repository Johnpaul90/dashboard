<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Automatically Generated Image Menu</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
  <select name="pix" id="pix">
    <option value="">Select an image</option>
	<?php
include('buildlist.php');
buildFileList5('../images');
?>
  </select>
  </form>
</body>
</html>