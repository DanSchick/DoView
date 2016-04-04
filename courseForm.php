<?php
include "top.php";
if($_GET){
    $delete = "DELETE FROM tblStudentCourses WHERE fnkNetId = ?";
    $data = array($username);
    $del = $thisDatabaseWriter->delete($delete, $data, 1, 0);
    foreach($_GET as $class){
        if($class != "Enter"){
            $q = "INSERT INTO `DSCHICK_Registration`.`tblStudentCourses` (`fnkNetID`, `fnkCourseId`) VALUES (?, ?)";
            $data = array($username, $class);
            print_r($data);
            $insert = $thisDatabaseWriter->insert($q, $data, 0, 0, 0);
        }
    }
    print '<script>window.location.replace("schedule.php");</script>';
    $q = "SELECT * FROM tblCourses WHERE fnkCourseId = ?";
    $data = array($courseCode);
    $select = $thisDatabaseReader->select($q, $data, 1, 0);
}
?>
<img id="logo" src="doView_4.png">
<form>

    <div id="sections">
        <div class="section">
            <fieldset class="wrapper">
                <legend>Course Info</legend>
                <p>Please enter course names or numbers.</p>


            <div>
            Class Code: <input type="text" name="name" value="">

            </div>


            </fieldset>

            <fieldset class="button">
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Enter" tabindex="900" class="button">
            </fieldset>
        </div>
    </div>

    <a href="#" id="addsection">Add Class</a>
</form>

</article>
</body>





<script type="text/javascript">
$(document).ready(function() {
    var counter = 1;
    var printErr = 1;
    $('#addsection').click(function(){
        counter += 1;
        if(counter <= 5){
            var appendStr = 'Class Code: <input type="text" name="name' + counter + '" value=""><br>';
            $('.wrapper').append(appendStr);
        } else if(printErr == 1){
            printErr = 0;
            $('.wrapper').append("You've reached the 5 class limit");
        }
    });
});
</script>
