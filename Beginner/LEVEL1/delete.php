<?php
// include kết nối CSDL
include 'level1.php';
  
try {
      
    // lấy ID từ URL
    $id=isset($_GET['id']) ? $_GET['id'] : die('LỖI: Không tìm thấy ID.');
  
    // truy vấn xóa dữ liệu
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
      
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Không thể xóa bản ghi.');
    }
}
  
// Hiển thị lỗi
catch(PDOException $exception){
    die('LỖI: ' . $exception->getMessage());
}
?>