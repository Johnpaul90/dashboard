<?php
   include('../includes/conn_pdo.inc.php');
   include('../includes/corefuncs.php');
   // remove backslashes
   nukeMagicQuotes();
   // initialize flags
   $OK = false;
   $done = false;
   // create database connection
   $conn = dbConnect('admin');
   // get details of selected record
       if (isset($_GET['article_id']) && !$_POST) {
          // prepare SQL query
          $sql = 'SELECT * FROM journal WHERE article_id = ?';
          $stmt = $conn->prepare($sql);
          // execute query by passing array of variables
          $OK = $stmt->execute(array($_GET['article_id']));
          // fetch the result
          $row = $stmt->fetch();
          // assign result array to variables
            if (is_array($row)) {
               extract($row);
			   // free the database resources for the second query
               $stmt->closeCursor();
            }
		}	
	// if form has been submitted, update record
          if (array_key_exists('update', $_POST)) {
             // prepare update query
             $sql = 'UPDATE journal SET image_id=?, title = ?, article = ? WHERE article_id = ?';
             $stmt = $conn->prepare($sql);
             // execute query by passing array of variables
             $done = $stmt->execute(array($_POST['image_id'],$_POST['title'], $_POST['article'],$_POST['article_id']));
            }
        
		// redirect if $_GET['article_id'] not defined
       if ($done || !isset($_GET['article_id'])) {
          header('Location: http://localhost/dashboard/admin/journal_list.php');
          exit;
        }
       // display error message if query fails
          if (isset($stmt) && !$OK && !$done) {
             $error = $stmt->errorInfo();
             if (isset($error[2])) {
               echo $error[2];
            }
        }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Update Journal Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Update Journal Entry</h1>
<p><a href="../admin/journal_list.php">List all entries </a></p>
<?php 
   if (!isset($article_id)) { 
?>
     <p class="warning">Invalid request: record does not exist.</p>
<?php 
} else { ?><form id="form1" method="post" action="">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title" value="<?php echo htmlentities($title, ENT_COMPAT, 'utf-8'); ?>">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"><?php echo htmlentities($article, ENT_COMPAT, 'utf-8'); ?></textarea>
  </p>
  
  <p>
<label for="image_id">Image:</label>
   <select name="image_id" id="image_id">
     <option value="">Select image</option>
<?php
   // get details of the images
   $getImages = 'SELECT * FROM images ORDER BY filename';
      foreach ($conn->query($getImages) as $image) {
?>
     <option value="<?php echo $image['image_id']; ?>"
<?php
    if ($image['image_id'] == $image_id) {
       echo ' selected="selected"';
    }
?>><?php echo $image['filename']; ?>
</option>
<?php } ?>
</select>
</p>
<p>
    <input type="submit" name="update" value="Update Entry" id="update">
    <input name="article_id" type="hidden" value="<?php echo $article_id; ?>">
  </p>
</form>
<?php } ?>
</body>
</html>