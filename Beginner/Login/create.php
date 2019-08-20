<!-- <!DOCTYPE html>
<html>
<head>
	<title>Tạo Tài Khoản</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
   <form>
   	   <!-- container -->
    <div class="container">
    
        <div class="page-header">
            <h1>Tạo tài khoản mới</h1>
        </div>
       
    <!-- html form tạo mới sản phẩm sẽ đặt tại đây -->
    <?php
if($_POST){
  
    // include file kết nối CSDL
    include 'level1.php';
  
    try{
      
        // truy vấn INSERT
        $query = "INSERT INTO taikhoan SET username=:username, Password=:Password, LoaiTK=:LoaiTK";
  
        // Chuẩn bị cho thực thi truy vấn
        $stmt = $con->prepare($query);
  
        // Các giá trị được lấy từ các trường nhập trên form
        $username=htmlspecialchars(strip_tags($_POST['username']));
        $Password=htmlspecialchars(strip_tags($_POST['Password']));
        $LoaiTK=htmlspecialchars(strip_tags($_POST['LoaiTK']));
  
        // truyền các tham số cho câu truy vấn
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':Password', $Password);
        $stmt->bindParam(':LoaiTK', $LoaiTK);
        // Thực thi truy vấn
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Tạo tài khoản mới thành công.</div>";
        }
        else{
            echo "<div class='alert alert-danger'>Tạo sản phẩm mới thất bại.</div>";
        }
    }
      
    // hiển thị lỗi
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
        ?>
   </form>
</body>
</html> -->
<!DOCTYPE html>
<html>
<head>
	<title>dhdfvf</title>
</head>
<body>
<p>fvfbvjk</p>
</body>
</html>