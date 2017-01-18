<?php
require_once('../includes/conn_pdo.inc.php');
// create database connection
$conn = dbConnect('query');
$sql = 'SELECT article_id, title,DATE_FORMAT(created, "%a, %b %D, %Y") AS created FROM journal ORDER BY created DESC';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Manage Journal Entries</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Manage Journal Entries</h1>
<p><a href="../journal/journal_insert_pdo.php">Insert new entry</a></p>
<table>
  <tr>
    <th scope="col">Created</th>
    <th scope="col">Title</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php foreach ($conn->query($sql) as $row) { ?>
  <tr>
    <td><?php echo $row['created']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><a href="../journal/journal_update_pdo2.php?article_id=<?php echo $row['article_id']; ?>">MODIFY</a></td>
    <td><a href="../journal/journal_delete_pdo.php?article_id=<?php echo $row['article_id']; ?>">DELETE</a></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>