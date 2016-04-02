<?php
include 'top.php';
$query = 'SELECT * FROM tblStudent WHERE pmkNetId=?';
$data = array($username);
$user = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0);
?>


<article>
    <aside class="petInfo">
        <h1>Info<a href="welcome.php" data-ajax="false"><button>Edit</button></a></h1>
        <ul>
            <li>First Name: <?php echo $user[0]['fldFirstName'];?></li>
            <li>Laste Name: <?php echo $user[0]['fldLastName'];?></li>
            <li>Major: <?php echo $user[0]['fldMajor'];?></li>
            <li>Minor: <?php echo $user[0]['fldMinor'];?></li>
            <li>Starting Year:<?php echo $user[0]['fldYear']?></li>
        </ul>
    </aside>

</article>
<?php
include 'footer.php';
?>
</body>
</html>

