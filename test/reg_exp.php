<?php
   $username = "jasOn";
       if (ereg("([^a-z])",$username))
          echo "Username must be all lowercase!";
       else
          echo "Username is all lowercase!";
?>

<?php
echo "<br />";
   $pswd = "jasonas111";
      if (!eregi("^[a-zA-Z0-9]{8,10}$", $pswd))
          echo "Invalid password!";
      else
         echo "Valid password!";
?>

<?php
echo "<br />";
   $draft = "In 2010 the company faced plummeting revenues and scandal.";
   $keywords = array("/faced/", "/plummeting/", "/scandal/");
   $replacements = array("celebrated", "skyrocketing", "expansion");
   echo preg_replace($keywords, $replacements, $draft);
?>

<?php
echo "<br />";
$msg = "I annoy people by capitalizing e-mail text.";
echo strtoupper($msg);
?>

<?php
echo "<br />";
$url = "sales@example.com";
echo ltrim(strstr($url, "@"),"@");
?>

<?php
echo "<br />";
$ccnumber = "0027691294";
echo substr_replace($ccnumber,"******",2,6);
?>

//<?php
//echo "<br />"
//include ('../pear/tests/Validate_US/tests/validate_Us.php');
$validate = new Validate_US();
echo $validate->phoneNumber("614-999-9999") ? "Valid!" : "Not valid!";
?>