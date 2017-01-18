<?php
include('../includes/title.inc.php');
   // include the connector function for MySQL, MySQLI, or PDO
     if (! @include('../includes/conn_pdo.inc.php')) {
        echo 'Sorry page unavailable';
        exit;
    }
    // connect to the database
    $conn = dbConnect('query');
    // check for article_id in query string
       if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
           $article_id = $_GET['article_id'];
        }
       else {
           $article_id = 0;
        }
       // prepare SQL query
      //$sql = "SELECT title, article, filename, caption  
	          //FROM journal, images
              //WHERE journal.article_id = $article_id
              //AND journal.image_id = images.image_id";
		$sql="SELECT title, article, filename, DATE_FORMAT(updated, '%W, %M %D, %Y') AS updated, caption
              FROM journal LEFT JOIN images USING (image_id)
              WHERE journal.article_id = $article_id";	  
      // process the query and results
	  $result = $conn->query($sql);
      $row = $result->fetch();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey</title>
<link href="../styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('../includes/menu.inc.php'); ?>
    <div id="maincontent">
        <h2><?php if ($row) {
                     echo $row['title'];
                    }
                  else {
                    echo 'No record found';
                    }
         ?></h2>
        
		<?php
           if ($row && !empty($row['filename'])) {
              $filename = "../images/{$row['filename']}";
              $imageSize = getimagesize($filename);
?>
        <div id="pictureWrapper"><img src="<?php echo $filename; ?>" alt="<?php echo $row['caption']; ?>"
   <?php echo $imageSize[3];?> />
          </div>
		  <?php } ?>
      <p>
        <?php
             if ($row) {
                echo nl2br($row['article']);
                }
             else {
        ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
<?php }?>
</p>
        <p><a href="<?php
                        // check that browser supports $_SERVER variables
                          if (isset($_SERVER['HTTP_REFERER']) && isset($_SERVER['HTTP_HOST'])) {
                             $url = parse_url($_SERVER['HTTP_REFERER']);
                             // find if visitor was referred from a different domain
                               if ($url['host'] == $_SERVER['HTTP_HOST']) {
                                   // if same domain, use referring URL
                                   echo $_SERVER['HTTP_REFERER'];
                                }
                            }
                          else {
                             // otherwise, send to main page
                             echo '../journal/journal.php';
                            } 
					?>">Back to the journal </a></p>
    </div>
    <?php include('../includes/footer.inc.php'); ?>
</div>
</body>
</html>
