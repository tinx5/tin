<?php
$host="localhost";
$db_name="level1";
$username="root";
$password="";
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// Hiển thị lỗi nếu quá trình kết nối xảy ra vấn đề
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

?>
