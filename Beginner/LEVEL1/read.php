<!DOCTYPE HTML>
<html>
<head>
    <title>xem dữ liệu</title>
  
    <!-- Thư viện Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  
</head>
<body>
  
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Thông tin chi tiết sản phẩm</h1>
        </div>
          
        <!-- Mã PHP đọc một bản ghi dữ liệu sẽ đặt tại đây -->
    	<?php
// lấy giá trị của tham số ‘id’ trên URL
// isset() là hàm trong PHP cho phép kiểm tra giá trị là có hoặc không
$id=isset($_GET['id']) ? $_GET['id'] : die('LỖI: Không tìm thấy ID.');
  
//include kết nối CSDL
include 'level1.php';
  
// đọc dữ liệu của bản ghi hiện tại
try {
    // chuẩn bị truy vấn SELECT
    $query = "SELECT id, name, description, price, image FROM products WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
  
    // truyền giá trị cho tham số ‘?’ trong câu truy vấn bên trên
    $stmt->bindParam(1, $id);
  
    // thực thi truy vấn
    $stmt->execute();
  
    // lưu bản ghi dữ liệu lấy được vào một biến ‘row’
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // điền giá trị lấy được từ $row vào trong form
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
    $image = htmlspecialchars($row['image'], ENT_QUOTES);
}
  
// hiển thị lỗi
catch(PDOException $exception){
    die('LỖI: ' . $exception->getMessage());
}
?>
        <!-- HTML table biểu diễn dữ liệu của một bản ghi lấy theo ID sẽ đặt tại đây -->
  			<!--chúng ta sử dụng HTML table để hiển thị bản ghi dữ liệu theo ID-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Tên</td>
        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Mô tả</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Giá</td>
        <td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
    <td>Hình ảnh</td>
    <td>
    <?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "Không tìm thấy ảnh.";  ?>
    </td>
</tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Quay lại danh sách sản phẩm</a>
        </td>
    </tr>
</table>
    </div> <!-- end .container -->
      
<!-- jQuery (Thư viện JQuery, sự cần thiết cho Bootstrap JavaScript) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
<!-- Thư viện Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
<?php  ?>