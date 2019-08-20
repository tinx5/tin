<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Đọc các bản ghi - PHP CRUD Beginner</title>
      
    <!-- Sử dụng thư viện Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
    <!--tùy biến css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
  
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Danh sách sản phẩm</h1>
        </div>
   <?php
// include kết nối CSDL
include 'level1.php';
  // CÁC BIẾN PHÂN TRANG
// $page là trang hiện tại, nếu không thiết lập, mặc định là trang 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// Thiết lập số bản ghi hoặc số dòng dữ liệu xuất hiện trong mỗi trang
$records_per_page = 5;
 
// Tính toán phục vụ truy vấn trong mệnh đề LIMIT
$from_record_num = ($records_per_page * $page) - $records_per_page;
// hiển thị thông báo xóa bản ghi sẽ đặt tại đây 
  $action = isset($_GET['action']) ? $_GET['action'] : "";
  
// nếu nó được điều hướng từ “delete.php”
if($action=='deleted'){
    echo "<div class='alert alert-success'>Sản phẩm đã được xoá.</div>";
}
// lấy tất cả dữ liệu
// lấy dữ liệu cho trang hiện tại
$query = "SELECT id, name, description, price FROM products ORDER BY id DESC
    LIMIT :from_record_num, :records_per_page";
$stmt = $con->prepare($query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// số lượng bản ghi trả về
$num = $stmt->rowCount();
  
// liên kết gọi đến trang Tạo sản phẩm mới
echo "<a href='taomoi.php' class='btn btn-primary m-b-1em'>Tạo sản phẩm mới</a>";
  
//kiểm tra nếu số bản ghi dữ liệu lấy được > 0
if($num>0){
  
    // dữ liệu từ CSDL sẽ hiển thị tại đây
      echo "<table class='table table-hover table-responsive table-bordered'>";//start table
  
    // tạo tiêu đề cho bảng dữ liệu
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Tên</th>";
        echo "<th>Mô tả</th>";
        echo "<th>Giá</th>";
        echo "<th>Chức năng</th>";
    echo "</tr>";
      
    // nội dung của bảng sẽ đặt tại đây
   // lấy các nội dung vào bảng
// fetch() là hàm xử lý nhanh hơn fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // thay cho việc truy xuất dữ liệu bằng cách $row[‘name’], thì chỉ cần gọi $name
    // bằng cách sử dụng hàm extract($row)
    extract($row);
      
    // mỗi bản ghi sẽ được hiển thị thành từng dòng trong bảng
    echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$description}</td>";
        echo "<td>&#36;{$price}</td>";
        echo "<td>";
            // liên kết gọi chức năng hiển thị chi tiết từng sản phẩm theo ID
            echo "<a href='read.php?id={$id}' class='btn btn-info m-r-1em'>Đọc</a>";
              
            // liên kết gọi chức năng cập nhật sản phẩm theo ID.
     // chức năng này sẽ được thực hiện trong mục 8 của bài viết
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Sửa</a>";
  
            // chức năng xoá sản phẩm theo ID, sẽ được thực hiện trong phần tiếp theo
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Xoá</a>";
        echo "</td>";
    echo "</tr>";
} 
// end table
echo "</table>";
// PHÂN TRANG
// đếm tổng số bản ghi
$query = "SELECT COUNT(*) as total_rows FROM products";
$stmt = $con->prepare($query);
 
// thực thi truy vấn
$stmt->execute();
 
// lấy tổng số dòng dữ liệu
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];
// điều hướng phân trang
$page_url="index.php?";
include_once "paging.php";
}
  
// nếu không tìm thấy bản ghi dữ liệu nào
else{
    echo "<div class='alert alert-danger'>Không tìm thấy sản phẩm nào.</div>";
}
?>        
    </div> <!-- end .container -->
      
<!-- jQuery (Thư viện Jquery, sự cần thiết cho Bootstrap's JavaScript) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
<!-- Thư viện Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!-- Xác thực xóa bản ghi dữ liệu sẽ đặt tại đây -->
  <script type='text/javascript'>
// xác thực việc xóa bản ghi dữ liệu
function delete_user( id ){
      
    var answer = confirm('Bạn có chắc muốn xóa sản phẩm này không?');
    if (answer){
        // nếu người dùng kích OK, 
        // truyền id tới delete.php và thực thi truy vấn delete
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>

		

<?php  ?>