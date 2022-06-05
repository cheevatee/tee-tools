<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "30";
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "The page automatic reload itself every 30 seconds!";
    ?>
    </body>
</html>

<html>
  <body>
    <p><?php echo "hostname is: ".gethostname(); ?></p>
    <p><?php echo date("D M j G:i:s T Y"); ?></p>
  </body>
</html>

<?php
    echo('Database host: '.getenv('OPENSHIFT_MYSQL_DB_HOST').'<br/>');
    echo('Database name: '.getenv('OPENSHIFT_MYSQL_DB_NAME').'<br/>');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Form - PHP/MySQL Demo </title>
</head>

<body>
<p></p>
<fieldset>
<legend>User Insert Form</legend>
<form name="frmContact" method="post" action="insert.php">
<p>
<label for="Name">Name </label>
<input type="text" name="txtName" id="txtName" required="required" pattern="[A-Za-z0-9]{1,20}" >
</p>
<p>
<label for="email">Email</label>
<input type="text" name="txtEmail" id="txtEmail" required="required" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" >
</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset>
<p>



<fieldset>
<legend>User Update Form</legend>
<form name="frmContact" method="post" action="update.php">
<p>
<label for="UID">UID - </label>
<input type="text" name="txtUid" id="txtUid" required="required" pattern="[0-9]{1,20}" >
</p>
<p>
<label for="Name">Name </label>
<input type="text" name="txtName" id="txtName" required="required" pattern="[A-Za-z0-9]{1,20}" >
</p>
<p>
<label for="email">Email</label>
<input type="text" name="txtEmail" id="txtEmail" required="required" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" >
</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset> 
<p>



<fieldset>
<legend>User Delete Form</legend>
<form name="frmContact" method="post" action="delete.php">
<p>
<label for="UID">UID - </label>
<input type="text" name="txtUid" id="txtUid" required="required" pattern="[0-9]{1,20}" >
</p>
<p>
<label for="Name">Name </label>
<input type="text" name="txtName" id="txtName" required="required" pattern="[A-Za-z0-9]{1,20}" >
</p>
<p>
<label for="email">Email</label>
<input type="text" name="txtEmail" id="txtEmail" required="required" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" >
</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset>

</body>
</html>
