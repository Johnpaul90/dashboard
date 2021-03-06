<?php 
   include('../includes/title.inc.php');  
   include('../includes/getFirst.inc.php');
   include('../includes/conn_pdo.inc.php');
   // create database connection
   $conn = dbConnect('query');
   $sql = 'SELECT * FROM journal ORDER BY created DESC';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey<?php if (isset($title)) {echo "&#8212;{$title}";} ?></title>
<link href="../styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('../includes/menu.inc.php'); ?>
    <div id="maincontent">
	<?php
        foreach ($conn->query($sql) as $row) {
    ?>
       <h2><?php echo $row['title']; ?></h2>
       <p><?php $extract = getFirst($row['article']);
          echo $extract[0];
         if ($extract[1]) {
            echo '<a href="../journal/details.php?article_id='.$row['article_id'].'">More</a>';
        } 
    ?></p>
<?php } ?>
        
    </div>
    <?php include('../includes/footer.inc.php'); ?>
</div>
</body>
</html>
