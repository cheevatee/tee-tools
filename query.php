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



<?php
 // include("database.php");
$servername = "a82d02d0ae1244f9d8616b9d2b401cb7-1839195161.us-east-2.elb.amazonaws.com";
$username = "test";
$password = "redhat";
$dbname = "testdb";

echo('Database host: '.getenv('OPENSHIFT_MYSQL_DB_HOST').'<br/>');
echo('Database name: '.getenv('OPENSHIFT_MYSQL_DB_NAME').'<br/>');

//$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn = new PDO("mysql:host=".getenv('OPENSHIFT_MYSQL_DB_HOST').";dbname=".getenv('OPENSHIFT_MYSQL_DB_NAME').";port=".getenv('OPENSHIFT_MYSQL_DB_PORT'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

$query = "SELECT user_id, name, email FROM users";
$result = $conn->query($query);
 ?>
 <p></p>
 <table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>UID</th>
    <th>Name</th>
    <th>Email</th>
  </tr>
 <?php
 while($data = $result->fetch(PDO::FETCH_ASSOC)) {
   
   ?>
    <tr>
   <td><?php echo $data['user_id']; ?> </td>
   <td><?php echo $data['name']; ?> </td>
   <td><?php echo $data['email']; ?> </td>
    </tr>
    <?php
  }
  ?>
</table>
  <?php
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
  ?>
