<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "The page automatic reload itself every 5 seconds!";
    ?>
    <p><?php echo "hostname is: ".gethostname(); ?></p>
    <p><?php echo date("D M j G:i:s T Y"); ?></p>
    </body>
</html>

<html>
 <head>
 </head>
 <body>
 <p>PHP connecting to MySQL</p>
</body>
</html>

<?php
$servername = "a82d02d0ae1244f9d8616b9d2b401cb7-1839195161.us-east-2.elb.amazonaws.com";
$username = "test";
$password = "redhat";
$dbname = "testdb";

$DB_HOST = getenv('OPENSHIFT_MYSQL_DB_HOST');
echo('Database host: '.getenv('OPENSHIFT_MYSQL_DB_HOST').'<br/>');
echo('Database name: '.getenv('OPENSHIFT_MYSQL_DB_NAME').'<br/>');

try {
  //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  //$conn = new PDO("mysql:host=".getenv('OPENSHIFT_MYSQL_DB_HOST').";dbname=".getenv('OPENSHIFT_MYSQL_DB_NAME'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
  $conn = new PDO("mysql:host=".getenv('OPENSHIFT_MYSQL_DB_HOST').";dbname=".getenv('OPENSHIFT_MYSQL_DB_NAME').";port=".getenv('OPENSHIFT_MYSQL_DB_PORT'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

<html>
 <head>
 </head>
 <body>
 <p>PHP connected to MySQL</p>
</body>
</html>
