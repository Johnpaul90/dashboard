<?php
   require_once('../includes/conn_pdo.inc.php');
   // create database connection
   $conn = dbConnect('admin');
   // initialize flags
   $OK = false;
   $deleted = false;
   // get details of selected record
     if (isset($_GET['article_id']) && !$_POST) {
        // prepare SQL query
        $sql = 'SELECT * FROM journal WHERE article_id = ?';
        $stmt = $conn->prepare($sql);
        // execute query by passing array of variables
        $OK = $stmt->execute(array($_GET['article_id']));
        // fetch the result
        $row=$stmt->fetch();
        // assign result array to variables
          if (is_array($row)) {
            extract($row);

        }
	}		
   // if confirm deletion button has been clicked, delete record
     if (isset($_POST['delete'])) {
        $sql = 'DELETE FROM journal WHERE article_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_POST['article_id']));
        // get number of affected rows
        $deleted = $stmt->rowCount();
          if (!$deleted) {
	        $error = 'There was a problem deleting the record.';
        }
    }
    // redirect the page if deleted, cancel button clicked, or $_GET['article_id'] not defined
      if ($deleted || isset($_POST['cancel_delete']) || !isset($_GET['article_id']))  {
        header('Location: http://localhost/dashboard/admin/journal_list.php');
        exit;
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Delete Journal Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Delete Journal Entry </h1>
<?php 
if (isset($error)) {
  echo "<p class='warning'>Error: $error</p>";
} elseif (isset($article_id) && $article_id == 0) { ?>
<p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<p class="warning">Please confirm that you want to delete the following item. This action cannot be undone.</p>
<p><?php echo $created .': ' .htmlentities($title, ENT_COMPAT, 'utf-8'); ?></p>
<?php } ?>
<form id="form1" method="post" action="">
    <p>
	<?php if (isset($article_id) && $article_id > 0) { ?>
        <input type="submit" name="delete" value="Confirm Deletion">
	<?php } ?>
		<input name="cancel_delete" type="submit" id="cancel_delete" value="Cancel">
<?php if (isset($article_id) && $article_id > 0) { ?>
		<input name="article_id" type="hidden" value="<?php echo $article_id; ?>">
	<?php } ?>
    </p>
</form>
</body>
</html>
