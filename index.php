<?php
include "top.php";

$test = "SELECT * FROM tblCourses INNER JOIN tblStudentCourses ON tblCourses.fnkCourseId = tblStudentCourses.fnkCourseId WHERE tblStudentCourses.fnkNetId = 'dschick'";
print "<pre>";
// $data = array("%CS124%");
$select = $thisDatabaseReader->select($test, 0, 1, 0, 2);


var_dump($select);
print "</pre>";



?>

<div class='contain'>
    <div class='c2'>
        <div class'c3'>
        </div>
    </div>
</div>


<form action='' method='post'>
        <p><label>Class:</label><input type='text' name='className' value='' class='auto'></p>
</form>
<div id='append'></div>

<script type="text/javascript">

$(document).ready(function() {
    var selectArr = <?php echo json_encode($select);?>;
    console.log(selectArr);

    for(var i=0;i<selectArr.length;i++){

    }

});


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
