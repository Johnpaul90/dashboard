<?php
  
   if (array_key_exists('insert', $_POST)) {
      include('../includes/conn_pdo.inc.php');
      include('../includes/corefuncs.php');
      // remove backslashes
      nukeMagicQuotes();
      // initialize flag
      $OK = false;
      // create database connection
      $conn = dbConnect('admin');
      // create SQL
      $sql = 'INSERT INTO journal (title, article, created)VALUES(:title, :article, NOW())';     
	  // initialize prepared statement
      $stmt = $conn->prepare($sql);
	  // bind the parameters and execute the statement
      $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
      $stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
      $OK = $stmt->execute();     
      // redirect if successful or display error
	    if ($OK) {
           header('Location: http://localhost/dashboard/admin/journal_list.php');
           exit;
        }
        else {
          $error = $stmt->errorInfo();
          echo $error[2];
       }
 	  
    }

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Insert Journal Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Insert New Journal Entry</h1>
<form id="form1" method="post" action="">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"></textarea>
  </p>
  <p>
    <input type="submit" name="insert" value="Insert New Entry" id="insert">
  </p>
</form>

</body>
</html>