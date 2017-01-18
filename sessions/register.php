
<?php
// execute script only if form has been submitted
   if (array_key_exists('register', $_POST)) {
      // remove backslashes from the $_POST array
      include('corefuncs.php');
      nukeMagicQuotes();
      // check length of username and password
	  $username = trim($_POST['username']);
      $pwd = trim($_POST['pwd']);
      if (strlen($username) < 6 || strlen($pwd) < 6) {
         $result = 'Username and password must contain at least 6 characters';
        }
      // check that the passwords match
	  elseif ($pwd != $_POST['conf_pwd']) {
         $result = 'Your passwords don\'t match';
        }
      // continue if OK
	  else {
      // encrypt password, using username as salt
      $pwd = sha1($username.$pwd);
      // define filename and open in read-write append mode
      $filename = 'C:/private/encrypted.txt';
      $file = fopen($filename, 'a+');
      // if filesize is zero, no names yet registered
      // so just write the username and password to file
       if (filesize($filename) === 0) {
	       fwrite($file, "$username, $pwd");
        }
        // if filesize is greater than zero, check username first
        else {
            // move internal pointer to beginning of file
            rewind($file);
            // loop through file one line at a time
            while (!feof($file)) {
                $line = fgets($file);
                // split line at comma, and check first element against username
                $tmp = explode(', ', $line);
                if ($tmp[0] == $username) {
                    $result = 'Username taken - choose another';
                    break;
                }
            }
        // if $result not set, username is OK
        if (!isset($result)) {
           // insert line break followed by username, comma, and password
           fwrite($file, "\r\n$username, $pwd");
           $result = "$username registered";
        }
        // close the file
        fclose($file);
        }
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Register User</title>
<style>
form1{
    display:inline-block;
	align:center;
}
label {
	display:inline-block;
	width:115px;
	text-align:left;
	padding-right:8px;
}
input[type="submit"] {
	margin-left:122px;
}
</style>
</head>

<body>
<?php
   if (isset($result)) {
      echo "<p>$result</p>";
    }
?>
<h1>Register User</h1>
<form action="" method="post" id="form1">
  <p>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
  </p>
  <p>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd">
  </p>
  <p>
    <label for="conf_pwd">Confirm Password:</label>
    <input type="password" name="conf_pwd" id="conf_pwd">
  </p>
  <p>
    <input type="submit" name="register" id="register" value="Submit">
  </p>
</form>
</body>
</html>