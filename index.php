<?php
include "top.php";

?>
<body>

<div id="splashscreen">
  <img class = "splashscreenimg" src="welcomeSPLASH.png" />

<script>
    $(window).load(function() {
      $('#splashscreen').fadeOut(5000,"swing");
    });

  </script>


</div>

<style>
.splashscreenimg {
  position: absolute;
  top: -160px;
  left: 0;
  bottom: 0;
  width: 100%;
  margin: 0 auto;
}
</style>


        <img id='center-logo' src='doView_4.png' alt='doView Logo'>

        <p id ='center-text'> <a id='center-text' href="courseForm.php">Select Courses</a>
        <a id="center-text" href='profile.php'> Edit Profile </a> </p>

    </body>

