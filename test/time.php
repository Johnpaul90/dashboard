<?php
printf("There are %d days in %s.", date("t"), date("F"));
echo"<br />";

$futuredate = strtotime("+45 days");
echo date("F d, Y", $futuredate);
echo"<br />";

$futuredate = strtotime("10 weeks 2 days");
echo date("F d, Y", $futuredate);
?>