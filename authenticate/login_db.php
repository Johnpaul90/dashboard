<?php
    // process the script only if the form has been submitted
       if (array_key_exists('login', $_POST)) {
          // start the session
          session_start();
          include('../includes/corefuncs.php');
          include('../includes/conn_pdo.inc.php');
          // clean the $_POST array and assign to shorter variables
          nukeMagicQuotes();
          $username = trim($_POST['username']);
          $pwd = trim($_POST['pwd']);
          // connect to the database as a restricted user
          $conn = dbConnect('query');
		  // get the username's details from the database
          $sql = "SELECT * FROM users WHERE username = ?";
          $stmt = $conn->prepare($sql);
          $stmt->execute(array($username));
          $row = $stmt->fetch();
		     if (sha1($pwd.$row['salt']) == $row['pwd']) {
                $_SESSION['authenticated'] = 'Jethro Tull';
            }
			// if no match, destroy the session and prepare error message
            else {
              $_SESSION = array();
              session_destroy();
              $error = 'Invalid username or password';
            }
           // if the session variable has been set, redirect
            if (isset($_SESSION['authenticated'])) {
               // get the time the session started
               $_SESSION['start'] = time();
               header('Location: http://localhost/dashboard/authenticate/menu_db.php');
               exit;
           }
        }
		?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Please login here</h1>
<?php
   if ($error) {
     echo "<p>$error</p>";
    } 
   elseif (isset($_GET['expired'])) {
?>
   <p>Your session has expired. Please log in again.</p>
<?php } ?>
<form id="form1" method="post" action="">
    <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd">
    </p>
    <p>
        <input name="login" type="submit" id="login" value="Log in">
    </p>
</form>
</body>
</html>
