<?php
include "top.php";

$test = "SELECT CONCAT(fnkCourseId, ' ', fldCourseName) as FullName FROM tblCourses WHERE CONCAT(fnkCourseId, ' ', fldCourseName) LIKE ?";
print "<pre>";
print "<p>Test</p>";
$data = array("%CS124%");
$select = $thisDatabaseReader->select($test, $data, 1, 0, 4);

var_dump($select);
print "</pre>";

?>

<form action='' method='post'>
        <p><label>Class:</label><input type='text' name='className' value='' class='auto'></p>
</form>
<div id='append'></div>

<script type="text/javascript">


$(function() {
    var availableTutorials = [
               "ActionScript",
               "Boostrap",
               "C",
               "C++",
            ];
    // autocomplete function
    $(".auto").autocomplete({
        source: "search.php",
        minLength: 1,
        appendTo: "#append"
    });
});


</script>
