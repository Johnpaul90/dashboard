<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Heredoc syntax</title>
</head>

<body>
<?php
$fish = 'whiting';
$mockTurtle = <<< Gryphon
"Will you walk a little faster?" said a $fish to a snail.
"There's a porpoise close behind us, and he's treading on my tail."
Gryphon;
echo $mockTurtle;
print"<br>";
$books = array(
array(
'title' => 'PHP Solutions: Dynamic Web Design Made Easy',
'author' => 'David Powers',
'publisher' => 'friends of ED',
'ISBN' => '1-59059-731-1'),
array(
'title' => 'Beginning PHP and MySQL 5',
'author' => 'W. Jason Gilmore',
'publisher' => 'Apress', 
'ISBN' => '1-59059-552-1')
);
echo $books[1]['title'];
echo"<br>";
?>
</body>
</html>
