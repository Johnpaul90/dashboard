<?php
// process the script only if the form has been submitted
  if (array_key_exists('login', $_POST)) {
     // start the session
     session_start();
	 //$_SESSION['username'] = $_POST['username']
     // include nukeMagicQuotes and clean the $_POST array
     include('corefuncs.php');
     nukeMagicQuotes();
     $textfile = 'C:/private/encrypted.txt';
	 $username = trim($_POST['username']);
     $pwd = sha1($username.trim($_POST['pwd']));
     if (file_exists($textfile) && is_readable($textfile)) {
        // read the file into an array called $users
        $users = file($textfile);
        // loop through the array to process each line
        for ($i = 0; $i < count($users); $i++) {
            // separate each element and store in a temporary array
            $tmp = explode(', ', $users[$i]);
            // assign each element of the temp array to a named array key
            $users[$i] = array('name' => $tmp[0], 'password' =>rtrim($tmp[1]));
           // check for a matching record
           if ($users[$i]['name'] == $_POST['username'] &&$users[$i]['password'] == $_POST['pwd']) {
           // if there's a match, set a session variable
           $_SESSION['authenticated'] = 'Jethro Tull';
           break;
           }
        }
        // if the session variable has been set, redirect
        if (isset($_SESSION['authenticated'])) {
		    header('Location: http://localhost/dashboard/sessions/menu.php');
            exit;
        }
        // if the session variable hasn't been set, refuse entry
        else {
           $error = 'Invalid username or password.';
        }
    }
    // error message to display if text file not readable
    else {
       $error = 'Login facility unavailable. Please try later.';
    }
}
?>