<?php ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Cập nhật một bản ghi - PHP CRUD Beginner</title>
     
    <!-- Thư viện Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Cập nhật thông tin sản phẩm</h1>
        </div>
     
        <!-- Mã  PHP đọc bản ghi dữ liệu theo ID sẽ đặt tại đây -->
 		<?php
// lấy giá trị của tham số ‘id’ trên URL
// isset() là hàm trong PHP cho phép kiểm tra giá trị là có hoặc không
$id=isset($_GET['id']) ? $_GET['id'] : die('LỖI: Không tìm thấy ID.');
 
//include kết nối CSDL
include 'level1.php';
 
// đọc dữ liệu của bản ghi hiện tại
try {
    // chuẩn bị câu truy vấn
    $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
     
    // truyền giá trị cho tham số ‘?’ trong câu truy vấn bên trên
    $stmt->bindParam(1, $id);
     
    // thực thi truy vấn
    $stmt->execute();
     
    // lưu dòng dữ liệu lấy được vào một biến $row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // điền lần lượt giá trị vào form thông qua các biến
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
}
 
// hiển thị lỗi
catch(PDOException $exception){
    die('LỖI: ' . $exception->getMessage());
}
?>
        <!-- HTML form để cập nhật bản ghi dữ liệu sẽ đặt tại đây -->
         <!-- Mã PHP xử lý cập nhật dữ liệu sẽ đặt tại đây -->
 	<?php
 
// kiểm tra nếu form đã được submit
if($_POST){
     
    try{
     
        // viết câu truy vấn
        // trong trường hợp này, tham số truyền cho câu truy vấn nhiều hơn 1  
        // do đó, ta nên dùng các label đại diện cho các giá trị tham số đầu vào 
        // thay cho dùng dấu “?”
        $query = "UPDATE products 
                    SET name=:name, description=:description, price=:price 
                    WHERE id = :id";
 
        // chuẩn bị truy vấn cho thực thi
        $stmt = $con->prepare($query);
 
        // nhận giá trị được post từ form
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $price=htmlspecialchars(strip_tags($_POST['price']));
 
        // truyền giá trị cho các tham số trong câu truy vấn
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
         
        // Thực thi truy vấn
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Cập nhật sản phẩm thành công.</div>";
        }else{
            echo "<div class='alert alert-danger'>Quá trình cập nhật thất bại. Vui lòng thử lại!</div>";
        }
         
    }
     
    // hiển thị lỗi
    catch(PDOException $exception){
        die('LỖI: ' . $exception->getMessage());
    }
}
?>
<!-- HTML form chứa thông tin của bản ghi dữ liệu cần cập nhật -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Tên</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Cập nhật' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Quay lại danh sách sản phẩm</a>
            </td>
        </tr>
    </table>
</form>

    </div> <!-- end .container -->
     
<!-- jQuery (JQuery, Thư viện hỗ trợ cho Bootstrap JavaScript) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Thư viện Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>