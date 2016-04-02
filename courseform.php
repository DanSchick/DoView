<header>
<img src="doView_4.png" alt="logo" style="width:220px">
<link rel="shortcut icon" href="doView_3.png">
</header>

<article>
<link href='courseform.css' rel='stylesheet' type='text/css' media='screen' title='professional'/>
<body>
    
<form>
    
<fieldset class="wrapper">
    <legend>Course Info</legend>
    <p>Please enter course names or numbers.</p>
    

<div>
Department Name: <input type="text" name="name" value="<?php echo $name;?>">
    
Course Number: <input type="text" name="num" value="<?php echo $num;?>">
</div>
    
    

    
</fieldset>

<fieldset class="button">
    <input type="submit" id="btnSubmit" name="btnSubmit" value="Enter" tabindex="900" class="button">
</fieldset>
    
</form>
    
</body>
    
</article>
