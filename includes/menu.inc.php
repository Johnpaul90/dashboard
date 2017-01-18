<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<ul id="nav">
  <li><a href="../ch04/index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"';} ?>>Home</a></li>
  <li><a href="../journal/journal.php" <?php if ($currentPage == 'blog.php') {echo 'id="here"';} ?>>Journal</a></li>
  <li><a href="../ch04/gallery.php" <?php if ($currentPage == 'gallery.php') {echo 'id="here"';} ?>>Gallery</a></li>
  <li><a href="../ch04/contact.php" <?php if ($currentPage == 'contact.php') {echo 'id="here"';} ?>>Contact</a></li>
</ul>
