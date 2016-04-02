<?php
include 'top.php';
$queryOne = 'SELECT; * FROM tblStudents WHERE pmkNetId=?';
$data = array($username);
$q = $thisDatabaseReader->select($queryOne, $data, 1, 0);
if(empty($q)){
  $insert = "INSERT INTO `DSCHICK_Registration`.`tblStudent` (`fldFirstName`, `fldLastName`, `fldMajor`, `fldMinor`, `fldYear`, `pmkNetID`) VALUES ('', '', '', '', '', ?)";
  $data = array($username);
  $t = $thisDatabaseWriter->insert($insert, $data, 0, 0, 10);


}
//Initialize every form element as a variable, and set the current content in the database to its default value.
$studentFirstName = $user[0]['fldFirstName'];
$studentLastName = $user[0]['fldLastName'];
$studentMajor = $user[0]['fldMajor'];
$studentMinor = $user[0]['fldMinor'];
$studentStartYear = $user[0]['fldYear'];
$netID = $user[0]['fldNetId'];
//Initialize error variables for each field. Assume false.
$studentFirstNameError = false;
$studentLastNameError = false;
$studentMajorError = false;
$studentMinorError = false;
$netIDError = false;
//Initalize arrays
$errorMsg = array();
$dataRecord = array();
if (isset($_POST["btnSubmit"])) {

//Sanitize data
    $studentFirstName = htmlentities($_POST["txtStudentFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $studentFirstName;
    $studentLastName = htmlentities($_POST["txtStudentLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $studentLastName;
    $studentMajor = htmlentities($_POST["txtStudentMajor"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $studentMajor;
    $studentMinor = htmlentities($_POST["txtStudentMinor"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $studentMinor;
    $studentStartYear = htmlentities($_POST["intStudentStartYear"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $studentStartYear;


//Check For Errors in the submission
    if ($studentFirstName == "") {
        $errorMsg[] = "Please enter your Name";
        $studentFirstNameError = true;
    } elseif (!verifyAlphaNum($studentFirstName)) {
        $errorMsg[] = "Your name appears to have extra characters.";
        $studentFirstName = true;
    }
    if ($studentLastName == "") {
        $errorMsg[] = "Please enter your Name";
        $studentLastNameError = true;
    } elseif (!verifyAlphaNum($studentLastName)) {
        $errorMsg[] = "Your name appears to have extra characters.";
        $studentLastName = true;
    }
    if ($studentMajor == "") {
        $errorMsg[] = "Please enter what your current Major is. (If Undecided, enter Undecided)";
        $studentMajorError = true;
    } elseif (!verifyAlphaNum($studentMajor)) {
        $errorMsg[] = "Your Major appears to have extra characters.";
        $studentMajorError = true;
    }
    if ($studentMinor == "") {
        $errorMsg[] = "Please enter what your current Minor is. (If Undecided, enter Undecided)";
        $studentMinorError = true;
    } elseif (!verifyAlphaNum($studentMinor)) {
        $errorMsg[] = "Your Minor appears to have extra characters.";
        $studentMinorError = true;
    }
    if (!$errorMsg) {
        $updateQuery = 'UPDATE tblStudent SET fldFirstName = ?, fldLastName = ?, fldMajor = ?, fldMinor = ?, fldYear = ? where pmkNetId = ?';
        //header("Location: index.php");

        $updateData = array($_POST['txtStudentFirstName'], $_POST['txtStudentLastName'], $_POST['txtStudentMajor'], $_POST['txtStudentMinor'], $_POST['intStartYear'], $username);
        // $updater = $thisDatabaseWriter->update($updateQuery, $updateData, 1, 0, 0, 0);
        $updater = $thisDatabaseWriter->update($updateQuery, $updateData, 1, 0, 0, 0);
        print '<script>window.location.replace("courseForm.php");</script>';
        die();
    }
}
?>
<form action=" "
      method="post"
      id="frmRegister">

    <?php
    // SECTION 3b Error Messages
    //
        // display any error messages before we print out the form
    if ($errorMsg) {
        print '<div id="errors">';
        print "<ol class='errors'>\n";
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        print "</ol>\n";
    }
    ?>
    <fieldset class="info">
        <h1>Info</h1>
        <label for="txtStudentFirstName" class="required">First Name
            <input type="text" id="txtStudentFirstName" name="txtStudentFirstName"
                   value="<?php print $studentFirstName; ?>"
                   tabindex="100" maxlength="45" placeholder="Enter Your First Name"
                   <?php
                   if ($studentFirstNameError) {
                       print 'class="mistake"';
                   }
                   ?>
                   onfocus="this.select()"
                   autofocus="">
        </label>
        <label for="txtStudentLastName" class="required">Last Name
            <input type="text" id="txtStudentLastName" name="txtStudentLastName"
                   value="<?php print $studentLastName; ?>"
                   tabindex="100" maxlength="45" placeholder="Enter Your Last Name"
                   <?php
                   if ($studentLastNameError) {
                       print 'class="mistake"';
                   }
                   ?>
                   onfocus="this.select()"
                   autofocus="">
        </label>
        <label for="txtStudentMajor" class="required">Major
            <input type="text" id="txtStudentMajor" name="txtStudentMajor"
                   value="<?php print $studentMajor; ?>"
                   tabindex="100" maxlength="45" placeholder="Enter Your Major"
                   <?php
                   if ($studentMajorError) {
                       print 'class="mistake"';
                   }
                   ?>
                   onfocus="this.select()"
                   autofocus="">
        </label>
        <label for="txtStudentMinor" class="required">Minor
            <input type="text" id="txtStudentMinor" name="txtStudentMinor"
                   value="<?php print $studentMinor; ?>"
                   tabindex="100" maxlength="45" placeholder="Enter Your Minor"
                   <?php
                   if ($studentMinorError) {
                       print 'class="mistake"';
                   }
                   ?>
                   onfocus="this.select()"
                   autofocus="">
        </label>
            <label for="intStudentStartYear" class="required">Starting Year
                <input type="text" id="intStartYear" name="intStartYear"
                       value="<?php print $studentStartYear; ?>"
                       tabindex="100" maxlength="45" placeholder="Enter The Year You Started College"
                       <?php
                       if ($studentStartYearError) {
                           print 'class="mistake"';
                       }
                       ?>
                       onfocus="this.select()"
                       autofocus="">
            </label>
        <input type="submit" id="btnSubmit" name="btnSubmit" value="Make Changes" tabindex="900" class="button">
    </fieldset>


</form>
<?php
//include 'footer.php';
?>
</body>
</html>
