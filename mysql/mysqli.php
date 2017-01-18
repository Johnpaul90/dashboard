<?php
   include('conn_mysqli.inc.php');
   // connect to MySQL
   $conn = dbConnect('query');
   $sql = 'SELECT * FROM images';
   $result = $conn->query($sql) or die(mysqli_error());
   $numRows = $result->num_rows;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>sELECT statement MYSQLI</title>
</head>
<p><strong>A total of <?php echo $numRows; ?> records were found.</strong></p>
  <table>
    <tr>
      <th>Image_id</th>
      <th>Filename</th>
      <th>Caption</th>
    </tr>
<?php
  while ($row = $result->fetch_assoc()) {
?>
    <tr>
      <td><?php echo $row['image_id']; ?></td>
      <td><strong><?php echo $row['filename']; ?></strong></td>
      <td><?php echo $row['caption']; ?></td>
    </tr>
<?php } ?>
 </table>
<body>
</body>
</html>
