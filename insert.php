 <?php
$servername = "a82d02d0ae1244f9d8616b9d2b401cb7-1839195161.us-east-2.elb.amazonaws.com";
$username = "test";
$password = "redhat";
$dbname = "testdb";

try {
  //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn = new PDO("mysql:host=".getenv('OPENSHIFT_MYSQL_DB_HOST').";dbname=".getenv('OPENSHIFT_MYSQL_DB_NAME').";port=".getenv('OPENSHIFT_MYSQL_DB_PORT'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // get the post records
  $txtName = $_POST['txtName'];
  $txtEmail = $_POST['txtEmail'];

  $sql = "INSERT INTO users (name, email)
  VALUES ('$txtName', '$txtEmail')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
sleep(3);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
