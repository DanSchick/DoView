<?php
include "top.php";

$test = "SELECT * FROM tblCourses";
print "<pre>";
//$testQ = $thisDatabaseReader->testquery($test, 0, 0);
$select = $thisDatabaseReader->select($test, 0, 0);

print_r($select);
print "</pre>";


?>
