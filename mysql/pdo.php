<?php
   include('conn_pdo.inc.php');
   // connect to MySQL
   $conn = dbConnect('query');
   $sql = 'SELECT COUNT(*) FROM images';
   $result = $conn->query($sql);
   $error = $conn->errorInfo();
   if (isset($error[2])) die($error[2]);
   // find out how many records were retrieved
   $numRows = $result->fetchColumn();
   // free the database resources
   $result->closeCursor();
   // prepare second SQL query
   $getDetails = 'SELECT * FROM images';
  
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>sELECT statement for PDO</title>
</head>
<body>
<p><strong>A total of <?php echo $numRows; ?> records were found.</strong></p>
<table>
    <tr>
      <th>Image_id</th>
      <th>Filename</th>
      <th>Caption</th>
    </tr>
<?php
  foreach($conn->query($getDetails)as $row ) {
?>
    <tr>
      <td><?php echo $row['image_id']; ?></td>
      <td><strong><?php echo $row['filename']; ?></strong></td>
      <td><?php echo $row['caption']; ?></td>
    </tr>
<?php } ?>
 
</body>
</html>
