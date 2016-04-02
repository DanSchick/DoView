<?php
include "top.php";








if($_GET){
    foreach($_GET as $class){
        $q = "INSERT INTO `DSCHICK_Registration`.`tblStudentCourses` (`fnkNetID`, `fnkCourseId`) VALUES (?, ?)";
        $data = array($username, $class);
        print_r($data);
        $insert = $thisDatabaseWriter->insert($q, $data, 0, 0, 0);

    }
    $q = "SELECT * FROM tblCourses WHERE fnkCourseId = ?";
    $data = array($courseCode);
    $select = $thisDatabaseReader->select($q, $data, 1, 0);

}
?><header>
<img src="doView_4.png" alt="logo" style="width:220px">
<link rel="shortcut icon" href="doView_3.png">
</header>

<article>
<link href='courseform.css' rel='stylesheet' type='text/css' media='screen' title='professional'/>
<body>

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

</body>

</article>



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



