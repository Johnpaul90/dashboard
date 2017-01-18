<?php
  session_start();
  ob_start();
  // set a time limit in seconds
   $timelimit = 15;
   // get the current time
   $now = time();
   // where to redirect if rejected
   $redirect = 'http://localhost/dashboard/sessions/login.php';
   // if session variable not set, redirect to login page
   // if session variable not set, redirect to login page
  if (!isset($_SESSION['authenticated'])||$_SESSION['authenticated']!= 'Jethro Tull'){
     header("Location: $redirect ");
     exit;
   }
   // if timelimit has expired, destroy session and redirect
  elseif ($now > $_SESSION['start'] + $timelimit) {
      // empty the $_SESSION array
      $_SESSION = array();
      // invalidate the session cookie
    if (isset($_COOKIE[session_name()])) {
       setcookie(session_name(), '', time()-86400, '/');
      }
      // end session and redirect with query string
      session_destroy();
      header("Location: {$redirect}?expired=yes");
      exit;
    }
    // if it's got this far, it's OK, so update start time
   else {
      $_SESSION['start'] = time();
    }
   
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=iso-"utf-8">
<title>Secret menu</title>
</head>

<body>
<h1>Restricted area for menu</h1>
<p><a href="secretpage.php">Another secret page</a> </p>
<?php include('logout.inc.php'); ?>
</body>
</html>
