<?php
echo "<ul class='pagination pull-left margin-zero mt0'>";
 
// Mã chứa nút “Trang đầu” sẽ đặt tại đây
 // Nút “Trang đầu”
if($page>1){
 
    $prev_page = $page - 1;
    echo "<li>";
        echo "<a href='{$page_url}page={$prev_page}'>";
            echo "<span style='margin:0 .5em;'>&laquo;</span>";
        echo "</a>";
    echo "</li>";
}

// Hành động kích chọn trang cụ thể sẽ đặt tại đây
 // hành động kích vào số trang cụ thể
 
// xác định tổng số trang
$total_pages = ceil($total_rows / $records_per_page);
 
// phạm vi số link để hiển thị
$range = 1;
 
// hiển thị link xung quanh trang hiện tại
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
 
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
 
    if (($x > 0) && ($x <= $total_pages)) {
 
        // trang hiện tại
        if ($x == $page) {
            echo "<li class='active'>";
                echo "<a href='javascript::void();'>{$x}</a>";
            echo "</li>";
        }
 
        // trường hợp không phải trang hiện tại
        else {
            echo "<li>";
                echo " <a href='{$page_url}page={$x}'>{$x}</a> ";
            echo "</li>";
        }
    }
}
// Mã chứa nút “Trang cuối” sẽ đặt tại đây
 // Nút “Trang cuối”
if($page<$total_pages){
    $next_page = $page + 1;
 
    echo "<li>";
        echo "<a href='{$page_url}page={$next_page}'>";
            echo "<span style='margin:0 .5em;'>&raquo;</span>";
        echo "</a>";
    echo "</li>";
}

echo "</ul>";
?>