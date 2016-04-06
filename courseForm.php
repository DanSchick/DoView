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
<div id="container1">
    <div id='searchDiv'>
        <input type='text' value='' placeholder='Search' id='keyword'>
        <button id='submitCourse'>Add Course</button>
        <button id='finalSubmit'>Submit Courses</button>
        <div id="results"> </div>
    </div>

</div>
    <div id='classListDiv'><ul id='classList'></ul></div>






<script>


var MIN_LENGTH = 3;

$( document ).ready(function() {

    var courseArr = [];
    $("#keyword").keyup(function() {
        var keyword = $("#keyword").val();
        var id;
        keyword = keyword.replace(/ /g,"_");
        console.log(keyword);

        // search the database
        if (keyword.length >= MIN_LENGTH) {
            $.get( "search.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results').html('');
                var results = jQuery.parseJSON(data);

                // for each result
                $(results).each(function(key, value) {
                    id = value.split(" ");
                    id = id[0];
                    $('#results').append('<div class="item" id="' + id + '">' + value + '</div>');
                })

                // on result click
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword').val(text);
                })

            });
        } else {
            $('#results').html('');
        }
    });

    $('#submitCourse').click(function() {
        var course = $('#keyword').val();
        course = course.split(" ");
        course = course[0];

        if(courseArr.length == 0){
            // prepend current courses
            $('#classListDiv').prepend('<p>Current Classes</p>');
        }

        if(courseArr.length >= 5){
            $('#searchDiv').append("<p id='limitError'>You've reached the five class limit</p>")
            console.log('flag');
        } else {
            courseArr.push(course);
            $('#classList').append("<li class='classListMember' id='" + course + "'>" + course + "</li>");
            console.log(courseArr);

            $('.classListMember').click(function(event){
                var courseID = $(event.target).attr('id');
                for(var i=0;i<courseArr.length;i++){
                    if(courseArr[i] == courseID){
                        courseArr.splice(i, 1);
                    }
                }
                console.log(courseArr);
                $(event.target).remove();
            });

            $('.classListMember').hover(function(event){
                $(event.target).css('text-decoration', 'line-through');
            }, function(event){
                $(event.target).css('text-decoration', 'none');
            });

            // $('classListMember').mouseleave(function(event){
            //     $(event.target).css('text-decoration', 'none');
            // });
        }


    });

    $('#finalSubmit').click(function(){
            courseArr = JSON.stringify(courseArr);
            $.post('addCourse.php', {
                courses: courseArr,

            }, function(data){
                window.location.replace("schedule.php");
                var data = JSON.parse(data);
                console.log(data[0]);
                console.log(data);
            })

    });



    $("#keyword").blur(function(){
            $("#results").fadeOut(500);
        })
        .focus(function() {
            $("#results").show();
        });

});

</script>


<style>
#container1 {
    margin-left: 30%;
}
#classListDiv {
    margin-left: 50%;
}
#keyword {
    width: 200px;
    font-size: 1em;
}

#results {
    width: 204px;
    position: absolute;
    border: 1px solid #c0c0c0;
}

#results .item {
    padding: 3px;
    font-family: Helvetica;
    border-bottom: 1px solid #c0c0c0;
}

#results .item:last-child {
    border-bottom: 0px;
}

#results .item:hover {
    background-color: #f2f2f2;
    cursor: pointer;
}
</style>
</body>
