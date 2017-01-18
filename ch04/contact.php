<?php include('title.inc.php');
/*$subject = 'Feedback from Japan Journey site';
// list expected fields
$expected = array('name', 'email', 'comments');
// set required fields
$required = array('name', 'comments');
// create empty array for any missing fields
$missing = array();
// process the $_POST variables
foreach ($_POST as $key => $value) {
// assign to temporary variable and strip whitespace if not an array
$temp = is_array($value) ? $value : trim($value);
// if empty and required, add to $missing array
if (empty($temp) && in_array($key, $required)) {
array_push($missing, $key);
}
// otherwise, assign to a variable of the same name as $key
elseif (in_array($key, $expected)) {
${$key} = $temp;
}
}
// go ahead only if all required fields OK
if (empty($missing)) {
// build the message
$message = "Name: $name\n\n";
$message .= "Email: $email\n\n";
$message .= "Comments: $comments";
// limit line length to 70 characters
$message = wordwrap($message, 70);
// send it
$mailSent = mail($to, $subject, $message);
if ($mailSent) {
// $missing is no longer needed if the email is sent, so unset it
unset($missing);
}
}
*/
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey<?php echo "&#8212;{$title}"; ?></title>
<link href="journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('menu.inc.php'); ?>
    <div id="maincontent">
        <h2>Contact Us  </h2>
		<?php
if ($_POST && isset($missing)) {
?>
<p class="warning">Please complete the missing item(s) indicated.</p>
<?php
}
elseif ($_POST && !$mailSent) {
?>
<p class="warning">Sorry, there was a problem sending your message.
Please try later.</p>
<?php
}
elseif ($_POST && $mailSent) {
?>
<p><strong>Your message has been sent. Thank you for your feedback.
</strong></p>
<?php } ?>
      <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
        <form id="feedback" method="post" action="">
            <p>
                <label for="name">Name:</label>
                <input name="name" id="name" type="text" class="formbox">
            </p>
            <p>
                <label for="email">Email:</label>
                <input name="email" id="email" type="text" class="formbox">
            </p>
            <p>
                <label for="comments">Comments:</label>
                <textarea name="comments" id="comments" cols="60" rows="8"></textarea>
            </p>
            <p>
                <input name="send" id="send" type="submit" value="Send message">
            </p>
        </form>
		
    </div>
	
	<fieldset id="subscribe">
<h2>Subscribe to newsletter?</h2>
<p>
<input name="subscribe" type="radio" value="Yes" id="subscribe-yes"
<?php
$OK = isset($_POST['subscribe']) ? true : false;
if ($OK && isset($missing) && $_POST['subscribe'] == 'Yes') { ?>
checked="checked"
<?php } ?>
/>
<label for="subscribe-yes">Yes</label>
<input name="subscribe" type="radio" value="No" id="subscribe-no"
<?php
if ($OK && isset($missing) && $_POST['subscribe'] == 'No') { ?>
checked="checked"
<?php } ?>
/>
<label for="subscribe-no">No</label>
</p>
</fieldset>
    <?php include('footer.inc.php'); ?>
</div>
</body>
</html>
