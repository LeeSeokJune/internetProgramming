<html>
<body>

<?php
// define variables and set to empty values
$num = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $num = test_input($_POST["num"]);
  $text = test_input($_POST["text"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo ("MySQL - PHP Connect Test <br>");
$hostname = "localhost";
$username = "ubuntu";
$password = "";
$dbname = "db_cse20121621";

$connect = new mysqli($hostname, $username, $password, $dbname) 
     or die("DB Connection Failed");

if($connect) {
 echo("MySQL Server Connect Success!<br>");
}
else {
 echo("MySQL Server Connect Failed!<br>");
}

//check if table exist
$val1 = "select 1 from pizza_table1";
$result = $connect->query($val1);

if($result !== FALSE){
  $val3 = "select * FROM pizza_table1 WHERE * " + "text";
  $re = mysql_query($val3);
  $re1 = mysql_fetch_arry($re);

}

//create table
if($connect->query($val3) === TRUE){
 echo "New record inserted successfully<br>";
}
else{
echo "Record not inserted <br> Error: " . $connect->error . "<br>";
}
}
else{
 echo "Error creating table : " . $connect->error . "<br>";
}
}

$connect->close() ; 
?>

<?php
echo "<h2>Your Input:</h2>";
echo "<br>";
echo "Name : "  ;
echo $name;
echo "<br>";
echo "E-mail : "  ;
echo $email;
echo "<br>";
echo "Phone Number : "  ;
echo $phone;
echo "<br>";
echo "Topping : " ; 
echo $topping ;
echo "<br>";
echo "Pay Method : "  ;
echo $paymethod;
echo "<br>";
echo "Call first : "  ;
echo $callfirst;
?>

</body>
</html>
