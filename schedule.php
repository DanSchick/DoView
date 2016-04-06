
    <?php
    include 'top.php';



    $test = "SELECT * FROM tblCourses INNER JOIN tblStudentCourses ON tblCourses.fnkCourseId = tblStudentCourses.fnkCourseId WHERE tblStudentCourses.fnkNetId = ?";
    $data = array($username);

    $select = $thisDatabaseReader->select($test, $data, 1, 0, 0, 0);
    ?>

<script>
    function printInfo(section){
            // build the string we need
            var returnStr = "<p class='classinfo " + section['fnkCourseId'] + "' id='" + section['fldCRN'] + "' ";
            returnStr += "data-lab=" + section['fldType'] + ">";
            returnStr += section['fldStartTime'] + "<br>" + section['fldCRN'] + "<br>" + section[2] ;
            // print lab if class IS lab
            if(section['fldType'] == "LAB"){
                    returnStr += "<br>" + section['fldType'] + "</p>";
            } else {
                    returnStr += "</p>";
            }
            return returnStr;
    }

    $(document).ready(function() {
    var classes = <?php echo json_encode($select);?>;
    console.log(classes);
    var colors = ['#ec9123', '#c1cd23', '#1ea2f2', '#e8c583', '#FFE224'];
    var classCodes = [];
    var startTime;
    var section;
    var count = 0;
    var prevClass;

    for(var i=0;i<classes.length;i++){
        if(classes[i]['fnkCourseId'] != prevClass){
                classCodes.push(classes[i]['fnkCourseId']);
                count += 1;
                console.log("flag");
        }
        section = classes[i];
        section['color'] = colors[i];
        prevClass = section['fnkCourseId'];
        startTime = section['fldStartTime'];
        if(startTime.charAt(0) == "0"){
            startTime = startTime.substring(1);
        }
        startTime = startTime.split(":");
        startTime = startTime[0] + startTime[1];

        var days = section['fldDays'].split(" ");
        console.log("Days: ");

        for(var j=0;j<days.length;j++){
            if(days[j] == 'M'){
                $('.Monday').find('#mon' + count).find('#' + startTime).append(printInfo(section));
            } else if(days[j] == 'T'){
                $('.Tuesday').find('#tue' + count).find('#' + startTime).append(printInfo(section));
            } else if(days[j] == 'W'){
                $('.Wednesday').find('#wends' + count).find('#' + startTime).append(printInfo(section));
            } else if(days[j] == 'R'){
                $('.Thursday').find('#thurs' + count).find('#' + startTime).append(printInfo(section));
            } else if(days[j] == 'F'){
                $('.Friday').find('#fri' + count).find('#' + startTime).append(printInfo(section));
            }
        }

    }
        for(var i=0;i<classCodes.length;i++){
                console.log('len: ' + classCodes.length + 'i: ' + i);
                $('.' + classCodes[i]).attr('style', "background-color: " + colors[i] + "; ");

        }
    $('.classinfo').click(function(event){
        var firstParent = $(event.target).parent();
        var column = firstParent.parent();
        var columnId = column.attr('id').slice(-1);
        console.log(columnId);
        var CRN = $(event.target).attr('id');

        console.log($('.mon'+columnId).find("div > p").attr('class'));
        console.log($('.mon'+columnId).find("*").find("p").attr('class'));
        // console.log($('.mon'+columnId).find("div").find('p'));

        var classes = $(event.target).attr('class');
        var code = classes.split(" ");
        console.log(code[1]);
        // console.log($('.' + code[1]));
        var sameClasses = $('.' + code[1]);
        console.log(sameClasses);
        for(var i=0;i<sameClasses.length;i++){
            if($(sameClasses[i]).attr('id') != CRN && $(sameClasses[i]).attr('data-lab') == $(event.target).attr('data-lab')){
                console.log('flag');
                $(sameClasses[i]).css('display', 'none');
            }
        }


    });
});
</script>


    <div class="hero-bar">
        <img src="doView_4.png">
        <div class="internal-nav">
            <a href="">Registration</a>
            <p> | </p>
            <a href="">Assignments</a>
        </div>
    </div>
    <div class="week first">
        <div class="TitleInfo">
            <h1>Current Week</h1>
        </div>
        <div class="ti">
                <div class="time"><p>8 AM</p></div>
                <div class="time"><p>9 AM</p></div>
                <div class="time"><p>10 AM</p></div>
                <div class="time"><p>11 AM</p></div>
                <div class="time"><p>12 PM</p></div>
                <div class="time"><p>1 PM</p></div>
                <div class="time"><p>2 PM</p></div>
                <div class="time"><p>3 PM</p></div>
                <div class="time"><p>4 PM</p></div>
                <div class="time"><p>5 PM</p></div>
                <div class="time"><p>6 PM</p></div>
        </div>
        <div class="Monday">
                <h2>Monday</h2>
            <div id="mon1">
                <div class="c m 1" id="830"></div>
                <div class="c m 2" id="940"></div>
                <div class="c m 3" id="1050"></div>
                <div class="c m 4" id="1200"></div>
                <div class="c m 5" id="1310"></div>
                <div class="c m 6" id="1420"></div>
                <div class="c m 7" id="1530"></div>
                <div class="c m 8" id="1531"></div>
                <div class="c m 9" id="1532"></div>
                <div class="c m 10" id="1640"></div>
            </div>
            <div id="mon2">
                <div class="c m 1" id="830"></div>
                <div class="c m 2" id="940"></div>
                <div class="c m 3" id="1050"></div>
                <div class="c m 4" id="1200"></div>
                <div class="c m 5" id="1310"></div>
                <div class="c m 6" id="1420"></div>
                <div class="c m 7" id="1530"></div>
                <div class="c m 8" id="1531"></div>
                <div class="c m 9" id="1532"></div>
                <div class="c m 10" id="1640"></div>
            </div>
            <div id="mon3">
                <div class="c m 1" id="830"></div>
                <div class="c m 2" id="940"></div>
                <div class="c m 3" id="1050"></div>
                <div class="c m 4" id="1200"></div>
                <div class="c m 5" id="1310"></div>
                <div class="c m 6" id="1420"></div>
                <div class="c m 7" id="1530"></div>
                <div class="c m 8" id="1531"></div>
                <div class="c m 9" id="1532"></div>
                <div class="c m 10" id="1640"></div>
            </div>
            <div id="mon4">
                <div class="c m 1" id="830"></div>
                <div class="c m 2" id="940"></div>
                <div class="c m 3" id="1050"></div>
                <div class="c m 4" id="1200"></div>
                <div class="c m 5" id="1310"></div>
                <div class="c m 6" id="1420"></div>
                <div class="c m 7" id="1530"></div>
                <div class="c m 8" id="1531"></div>
                <div class="c m 9" id="1532"></div>
                <div class="c m 10" id="1640"></div>
            </div>
            <div id="mon5">
                <div class="c m 1" id="830"></div>
                <div class="c m 2" id="940"></div>
                <div class="c m 3" id="1050"></div>
                <div class="c m 4" id="1200"></div>
                <div class="c m 5" id="1310"></div>
                <div class="c m 6" id="1420"></div>
                <div class="c m 7" id="1530"></div>
                <div class="c m 8" id="1531"></div>
                <div class="c m 9" id="1532"></div>
                <div class="c m 10" id="1640"></div>
            </div>
        </div>
        <div class="Tuesday">
                <h2>Tuesday</h2>
            <div id="tue1">
                <div class="c t 1" id="830"></div>
                <div class="c t 2" id="1005"></div>
                <div class="c t 3" id="1140"></div>
                <div class="c t 4" id="1315"></div>
                <div class="c t 5" id="1450"></div>
                <div class="c t 6" id="1625"></div>
                <div class="c t 7" id="1800"></div>
            </div>
            <div id="tue2">
                <div class="c t 1" id="830"></div>
                <div class="c t 2" id="1005"></div>
                <div class="c t 3" id="1140"></div>
                <div class="c t 4" id="1315"></div>
                <div class="c t 5" id="1450"></div>
                <div class="c t 6" id="1625"></div>
                <div class="c t 7" id="1800"></div>
            </div>
            <div id="tue3">
                <div class="c t 1" id="830"></div>
                <div class="c t 2" id="1005"></div>
                <div class="c t 3" id="1140"></div>
                <div class="c t 4" id="1315"></div>
                <div class="c t 5" id="1450"></div>
                <div class="c t 6" id="1625"></div>
                <div class="c t 7" id="1800"></div>
            </div>
            <div id="tue4">
                <div class="c t 1" id="830"></div>
                <div class="c t 2" id="1005"></div>
                <div class="c t 3" id="1140"></div>
                <div class="c t 4" id="1315"></div>
                <div class="c t 5" id="1450"></div>
                <div class="c t 6" id="1625"></div>
                <div class="c t 7" id="1800"></div>
            </div>
            <div id="tue5">
                <div class="c t 1" id="830"></div>
                <div class="c t 2" id="1005"></div>
                <div class="c t 3" id="1140"></div>
                <div class="c t 4" id="1315"></div>
                <div class="c t 5" id="1450"></div>
                <div class="c t 6" id="1625"></div>
                <div class="c t 7" id="1800"></div>
            </div>
        </div>
        <div class="Wednesday">
                <h2>Wednesday</h2>
            <div id="wends1">
                <div class="c w 1" id="830"></div>
                <div class="c w 2" id="940"></div>
                <div class="c w 3" id="1050"></div>
                <div class="c w 4" id="1200"></div>
                <div class="c w 5" id="1310"></div>
                <div class="c w 6" id="1420"></div>
                <div class="c w 7" id="1530"></div>
                <div class="c w 8" id="1531"></div>
                <div class="c w 9" id="1532"></div>
                <div class="c w 10" id="1640"></div>
            </div>
            <div id="wends2">
                <div class="c w 1" id="830"></div>
                <div class="c w 2" id="940"></div>
                <div class="c w 3" id="1050"></div>
                <div class="c w 4" id="1200"></div>
                <div class="c w 5" id="1310"></div>
                <div class="c w 6" id="1420"></div>
                <div class="c w 7" id="1530"></div>
                <div class="c w 8" id="1531"></div>
                <div class="c w 9" id="1532"></div>
                <div class="c w 10" id="1640"></div>
            </div>
            <div id="wends3">
                <div class="c w 1" id="830"></div>
                <div class="c w 2" id="940"></div>
                <div class="c w 3" id="1050"></div>
                <div class="c w 4" id="1200"></div>
                <div class="c w 5" id="1310"></div>
                <div class="c w 6" id="1420"></div>
                <div class="c w 7" id="1530"></div>
                <div class="c w 8" id="1531"></div>
                <div class="c w 9" id="1532"></div>
                <div class="c w 10" id="1640"></div>
            </div>
            <div id="wends4">
                <div class="c w 1" id="830"></div>
                <div class="c w 2" id="940"></div>
                <div class="c w 3" id="1050"></div>
                <div class="c w 4" id="1200"></div>
                <div class="c w 5" id="1310"></div>
                <div class="c w 6" id="1420"></div>
                <div class="c w 7" id="1530"></div>
                <div class="c w 8" id="1531"></div>
                <div class="c w 9" id="1532"></div>
                <div class="c w 10" id="1640"></div>
            </div>
            <div id="wends5">
                <div class="c w 1" id="830"></div>
                <div class="c w 2" id="940"></div>
                <div class="c w 3" id="1050"></div>
                <div class="c w 4" id="1200"></div>
                <div class="c w 5" id="1310"></div>
                <div class="c w 6" id="1420"></div>
                <div class="c w 7" id="1530"></div>
                <div class="c w 8" id="1531"></div>
                <div class="c w 9" id="1532"></div>
                <div class="c w 10" id="1640"></div>
            </div>
        </div>
        <div class="Thursday">
                <h2>Thursday</h2>
            <div id="thurs1">
                <div class="c r 1" id="830"></div>
                <div class="c r 2" id="1005"></div>
                <div class="c r 3" id="1140"></div>
                <div class="c r 4" id="1315"></div>
                <div class="c r 5" id="1450"></div>
                <div class="c r 6" id="1625"></div>
                <div class="c r 7" id="1800"></div>
            </div>
            <div id="thurs2">
                <div class="c r 1" id="830"></div>
                <div class="c r 2" id="1005"></div>
                <div class="c r 3" id="1140"></div>
                <div class="c r 4" id="1315"></div>
                <div class="c r 5" id="1450"></div>
                <div class="c r 6" id="1625"></div>
                <div class="c r 7" id="1800"></div>
            </div>
            <div id="thurs3">
                <div class="c r 1" id="830"></div>
                <div class="c r 2" id="1005"></div>
                <div class="c r 3" id="1140"></div>
                <div class="c r 4" id="1315"></div>
                <div class="c r 5" id="1450"></div>
                <div class="c r 6" id="1625"></div>
                <div class="c r 7" id="1800"></div>
            </div>
            <div id="thurs4">
                <div class="c r 1" id="830"></div>
                <div class="c r 2" id="1005"></div>
                <div class="c r 3" id="1140"></div>
                <div class="c r 4" id="1315"></div>
                <div class="c r 5" id="1450"></div>
                <div class="c r 6" id="1625"></div>
                <div class="c r 7" id="1800"></div>
            </div>
            <div id="thurs5">
                <div class="c r 1" id="830"></div>
                <div class="c r 2" id="1005"></div>
                <div class="c r 3" id="1140"></div>
                <div class="c r 4" id="1315"></div>
                <div class="c r 5" id="1450"></div>
                <div class="c r 6" id="1625"></div>
                <div class="c r 7" id="1800"></div>
            </div>
        </div>
        <div class="Friday">
                <h2>Friday</h2>
            <div id="fri1">
                <div class="c f 1" id="830"></div>
                <div class="c f 2" id="940"></div>
                <div class="c f 3" id="1050"></div>
                <div class="c f 4" id="1200"></div>
                <div class="c f 5" id="1310"></div>
                <div class="c f 6" id="1420"></div>
                <div class="c f 7" id="1530"></div>
                <div class="c f 8" id="1531"></div>
                <div class="c f 9" id="1532"></div>
                <div class="c f 10" id="1640"></div>
            </div>
            <div id="fri2">
                <div class="c f 1" id="830"></div>
                <div class="c f 2" id="940"></div>
                <div class="c f 3" id="1050"></div>
                <div class="c f 4" id="1200"></div>
                <div class="c f 5" id="1310"></div>
                <div class="c f 6" id="1420"></div>
                <div class="c f 7" id="1530"></div>
                <div class="c f 8" id="1531"></div>
                <div class="c f 9" id="1532"></div>
                <div class="c f 10" id="1640"></div>
            </div>
            <div id="fri3">
                <div class="c f 1" id="830"></div>
                <div class="c f 2" id="940"></div>
                <div class="c f 3" id="1050"></div>
                <div class="c f 4" id="1200"></div>
                <div class="c f 5" id="1310"></div>
                <div class="c f 6" id="1420"></div>
                <div class="c f 7" id="1530"></div>
                <div class="c f 8" id="1531"></div>
                <div class="c f 9" id="1532"></div>
                <div class="c f 10" id="1640"></div>
            </div>
            <div id="fri4">
                <div class="c f 1" id="830"></div>
                <div class="c f 2" id="940"></div>
                <div class="c f 3" id="1050"></div>
                <div class="c f 4" id="1200"></div>
                <div class="c f 5" id="1310"></div>
                <div class="c f 6" id="1420"></div>
                <div class="c f 7" id="1530"></div>
                <div class="c f 8" id="1531"></div>
                <div class="c f 9" id="1532"></div>
                <div class="c f 10" id="1640"></div>
            </div>
            <div id="fri5">
                <div class="c f 1" id="830"></div>
                <div class="c f 2" id="940"></div>
                <div class="c f 3" id="1050"></div>
                <div class="c f 4" id="1200"></div>
                <div class="c f 5" id="1310"></div>
                <div class="c f 6" id="1420"></div>
                <div class="c f 7" id="1530"></div>
                <div class="c f 8" id="1531"></div>
                <div class="c f 9" id="1532"></div>
                <div class="c f 10" id="1640"></div>
            </div>
        </div>

    <?php
    include "footer.php";
    ?>
 </body>
</html>
