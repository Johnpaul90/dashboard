<?php 
include('../ch04/title.inc.php');
// define number of columnin table
define('COLS', 2); 
// set maximum number of records per page
define('SHOWMAX', 6);
// include MySQL connector function
  if (! @include('../mysql/conn_pdo.inc.php')){
     echo 'Sorry, database unavailable';
     exit;
    }
    // create a connection to MySQL
    $conn = dbConnect('query');
	// prepare SQL to get total records
    $getTotal = 'SELECT COUNT(*) FROM images';
	// submit query and store result as $totalPix
    $total = $conn->query($getTotal);
    $row = $total->fetchColumn();
    $totalPix = $row[0];
    $total->closeCursor();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;
	// calculate the start row of the subset
    $startRow = $curPage * SHOWMAX;
    // prepare SQL to retrieve subset of image details
    $sql = "SELECT * FROM images LIMIT $startRow,".SHOWMAX;
    // submit the query
    $result = $conn->query($sql);
    // get any error messages
    $error = $conn->errorInfo();
    if (isset($error[2])) die($error[2]);
      // extract the first record as an array
     $row = $result->fetch();
	 // get the name and caption for the main image
	 if (isset($_GET['image'])) {
        $mainImage = $_GET['image'];
      }
      else {
        $mainImage = $row['filename'];
	  }
    
    // get the dimensions of the main image
    $imageSize = getimagesize('../images/'.$mainImage);
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Japan Journey<?php if (isset($title)) {echo "&#8212;{$title}";} ?>
</title>
<link href="../ch04/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('../ch04/menu.inc.php'); ?>
    <div id="maincontent">
        <h2>Images of Japan</h2>
      <p id="picCount">Displaying <?php echo $startRow+1;
         if ($startRow+1 < $totalPix) {
            echo ' to ';
            if ($startRow+SHOWMAX < $totalPix) {
               echo $startRow+SHOWMAX;
            }
        else {
          echo $totalPix;
          }
        }
echo " of $totalPix";
?></p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
					<!--This row needs to be repeated-->
					<?php 
					     // initialize cell counter outside loop
                         $pos = 0;
					     do { // set caption if thumbnail is same as main image
                            if ($row['filename'] == $mainImage) {
                               $caption = $row['caption']; 
							   }
				    ?>
							   
                    <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?image=<?php echo $row['filename']; ?>&amp;curPage=<?php echo $curPage; ?>"><img src="../images/thumbs/<?php echo $row['filename']; ?>" alt="<?php echo $row['caption']; ?>" width="80" height="54"></a></td>
					<?php
                        $row = $result->fetch();
						// increment counter after next row extracted
                       $pos++;
                       // if at end of row and records remain, insert tags
                       if ($pos%COLS === 0 && is_array($row)) {
                          echo '</tr><tr>';
                          }
                        } while ($row );
						// new loop to fill in final row
                        while ($pos%COLS) {
                           echo '<td>&nbsp;</td>';
                           $pos++;
                        }
                    ?>
                </tr>
				<!-- Navigation link needs to go here -->
				<tr><td>
               <?php
               // create a back link if current page greater than 0
                  if ($curPage > 0) {
                     echo '<a href="'.$_SERVER['PHP_SELF'].'?curPage='.($curPage-1).'"> &lt; Prev</a>';
                    }
                    // otherwise leave the cell empty
                  else {
                    echo '&nbsp;';
                    }
               ?>
              </td>
              <?php
              // pad the final row with empty cells if more than 2 columns
                 if (COLS-2 > 0) {
                    for ($i = 0; $i < COLS-2; $i++) {
                        echo '<td>&nbsp;</td>';
                    }
                }
              ?>
             <td>
             <?php
             // create a forward link if more records exist
                if ($startRow+SHOWMAX < $totalPix) {
                   echo '<a href="'.$_SERVER['PHP_SELF'].'?curPage='.($curPage+1).'"> Next &gt;</a>';
                }
				// otherwise leave the cell empty
                else {
                  echo '&nbsp;';
               }
            ?>
               </td></tr>
            </table>
            <div id="main_image">
                <p><img src="../images/<?php echo $mainImage; ?>" alt="<?php echo $caption; ?>"<?php echo $imageSize[3]; ?> /></p><p><?php echo $caption; ?></p>
            </div>
        </div>
    </div>
    <?php include('../ch04/footer.inc.php'); ?>
</div>
</body>
</html>