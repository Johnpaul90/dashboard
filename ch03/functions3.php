<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Demonstration of variable scope</title>
</head>

<body>
<?php
function doubleIt($number) {
  $number *= 22;
  echo "$number<br>";
}
$number = 12;
doubleIt($number);
echo $number;
?>
</body>
</html>
