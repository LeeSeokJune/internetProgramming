<html>
<body>

<?php
// define variables and set to empty values
$num = $text= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = test_input($_POST["text"]);
  
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
 $val3 = "SELECT * FROM pizza_table1";
 $re = mysqli_query($connect,$val3);
 $re1 = mysqli_fetch_array($re);
}

$connect->close() ; 
?>

<?php
echo "<h2>Your Input:</h2>";
echo "<br>";
echo "Name : "  ;
echo $re1[0];
echo "<br>";
echo "E-mail : "  ;
echo $re1[1];
echo "<br>";
echo "Phone Number : "  ;
echo $re1[2];
echo "<br>";
echo "Topping : " ; 
echo $re1[3] ;
echo "<br>";
echo "Pay Method : "  ;
echo $re1[4];
echo "<br>";
echo "Call first : "  ;
echo $re1[5];
?>

</body>
</html>
