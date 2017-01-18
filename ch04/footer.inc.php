<div id="footer">
    <p>&copy;<?php
ini_set('date.timezone', 'Africa/Lagos');
$startYear = 2010;
$thisYear = date('Y');
if ($startYear == $thisYear) {
echo $startYear;
}
else {
echo "{$startYear}-{$thisYear}";
}
?> Okeke JohnPaul</p>
    </div>