<?php
session_start();

// kiểm tra đăng nhập
if(!isset($_SESSION['login'])){
header("Location: login.php");
exit();
}
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : "";
$page = isset($_GET['page']) ? $_GET['page'] : "home";

/* chỉ tìm menu khi ở trang chủ */
if($search != "" && $page == "home"){

    if(strpos($search,"khoa") !== false){
        header("Location: index.php?page=khoa");
        exit();
    }

    elseif(strpos($search,"lop") !== false || strpos($search,"lớp") !== false){
        header("Location: index.php?page=lop");
        exit();
    }

    elseif(strpos($search,"doan") !== false || strpos($search,"đoàn") !== false){
        header("Location: index.php?page=doanvien");
        exit();
    }

    elseif(strpos($search,"hoat") !== false || strpos($search,"hoạt") !== false){
        header("Location: index.php?page=hoatdong");
        exit();
    }

    elseif(strpos($search,"tham") !== false){
        header("Location: index.php?page=thamgia");
        exit();
    }

    elseif(strpos($search,"phu") !== false || strpos($search,"phụ") !== false){
        header("Location: index.php?page=phutrach");
        exit();
    }

}
$conn = new mysqli("localhost","root","","quanlydoanvientruong");

if ($conn->connect_error) {
    die("Kết nối thất bại: ".$conn->connect_error);
}

$page = isset($_GET['page']) ? $_GET['page'] : "home";
$search = isset($_GET['search']) ? $_GET['search'] : "";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hệ thống quản lý đoàn viên</title>

<style>

body{
    font-family: Arial;
    margin:40px;
    background:#f4f6f9;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logos img{
    width:80px;
    height:80px;
    object-fit:contain;
    margin-left:10px;
}

/* Layout mới */

.container{
display:flex;
margin-top:20px;
}

.sidebar{
width:220px;
background:#2c3e50;
padding:20px;
border-radius:8px;
}

.sidebar a{
display:block;
color:white;
padding:10px;
margin-bottom:10px;
text-decoration:none;
border-radius:5px;
}

.sidebar a:hover{
background:#3498db;
}

.main{
flex:1;
background:white;
margin-left:20px;
padding:25px;
border-radius:8px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.search{
    margin-top:20px;
}

.search input{
    padding:8px;
    width:250px;
    border:1px solid #ccc;
    border-radius:5px;
}

.search button{
    padding:8px 15px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.search button:hover{
    background:#2980b9;
}

table{
    border-collapse:collapse;
    width:100%;
    margin-top:20px;
}

table, th, td{
    border:1px solid #ddd;
}

th{
    background:#3498db;
    color:white;
    padding:10px;
}

td{
    padding:8px;
}

tr:nth-child(even){
    background:#f9f9f9;
}

tr:hover{
    background:#eaf3ff;
}

</style>

</head>

<body>

<div class="header">

<div>

<h2>
HỆ THỐNG QUẢN LÝ ĐOÀN VIÊN - HỘI VIÊN <br>
TRƯỜNG ĐẠI HỌC KỸ THUẬT CÔNG NGHIỆP
</h2>

<p><b>Địa chỉ:</b> Số 666 đường 3/2, phường Tích Lương, tỉnh Thái Nguyên</p>

</div>

<div class="logos">

<img src="images/logo_truong.png">
<img src="images/logo_doan.png">
<img src="images/logo_hoi.png">

</div>

</div>


<div class="container">

<!-- MENU BÊN TRÁI -->
<div class="sidebar">

<a href="?page=home">Trang chủ</a>
<a href="?page=khoa">Khoa</a>
<a href="?page=lop">Lớp</a>
<a href="?page=doanvien">Đoàn viên</a>
<a href="?page=hoatdong">Hoạt động</a>
<a href="?page=thamgia">Tham gia hoạt động</a>
<a href="?page=phutrach">Phụ trách</a>
<a href="logout.php">Đăng xuất</a>

</div>

<!-- NỘI DUNG BÊN PHẢI -->
<div class="main">

<div class="search">

<form method="GET">

<input type="hidden" name="page" value="<?php echo $page; ?>">

<input type="text" name="search" placeholder="Nhập thông tin tìm kiếm">

<button type="submit">Tìm</button>

</form>

</div>

<?php

// ================= TRANG CHỦ =================

if($page=="home"){

echo "

<h2>TRANG CHỦ HỆ THỐNG QUẢN LÝ</h2>

<p>Chào mừng bạn đến với hệ thống quản lý Đoàn - Hội TNUT</p>

<div style='text-align:center;margin-top:30px;'>

<img src='images/doan_hoi.png'
style='width:100%;height:420px; object-fit:cover; border-radius:12px;'>

</div>

<div style='margin-top:30px; line-height:1.6; font-size:16px;'>

<h3>Giới thiệu Đoàn - Hội TNUT</h3>

<p>
Đoàn Thanh niên - Hội Sinh viên Trường Đại học Kỹ thuật Công nghiệp (TNUT) 
là tổ chức chính trị - xã hội của sinh viên trong nhà trường, 
đóng vai trò quan trọng trong việc giáo dục lý tưởng, đạo đức, 
lối sống và phát huy tinh thần xung kích, sáng tạo của đoàn viên thanh niên.
</p>

<p>
Trong nhiều năm qua, Đoàn - Hội TNUT đã tổ chức nhiều hoạt động ý nghĩa 
như: tình nguyện vì cộng đồng, hiến máu nhân đạo, mùa hè xanh, 
các cuộc thi học thuật, hoạt động văn hóa - văn nghệ - thể thao, 
góp phần xây dựng môi trường học tập năng động và sáng tạo cho sinh viên.
</p>

<p>
Thông qua các chương trình và phong trào, Đoàn - Hội TNUT không chỉ giúp 
sinh viên phát triển kỹ năng mềm, tinh thần trách nhiệm với cộng đồng 
mà còn góp phần xây dựng môi trường học tập tích cực, đoàn kết và sáng tạo 
trong toàn trường.
</p>

</div>

";

}

// ================= KHOA =================

// ================= KHOA =================

if($page=="khoa"){

echo "<h3>Danh sách Khoa</h3>";

echo "<a href='?page=them_khoa'>➕ Thêm khoa</a><br><br>";

$sql="SELECT * FROM khoa WHERE TenKhoa LIKE '%$search%'";
$result=$conn->query($sql);

echo "<table border='1' cellpadding='10'>";

echo "<tr>
<th>Mã khoa</th>
<th>Tên khoa</th>
<th>Chức năng</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["MaKhoa"]."</td>";
echo "<td>".$row["TenKhoa"]."</td>";

echo "<td>
<a href='?page=sua_khoa&id=".$row["MaKhoa"]."'>Sửa</a> |
<a href='?page=xoa_khoa&id=".$row["MaKhoa"]."' 
onclick=\"return confirm('Bạn có chắc muốn xóa?')\">Xóa</a>
</td>";

echo "</tr>";

}

echo "</table>";
}
if($page=="them_khoa"){

echo "<h3>Thêm khoa</h3>";

echo "<form method='post'>

Mã khoa<br>
<input type='text' name='makhoa' required><br><br>

Tên khoa<br>
<input type='text' name='tenkhoa' required><br><br>

<button name='them'>Thêm</button>

<a href='?page=khoa'
style='margin-left:10px;padding:5px 10px;background:#888;color:white;text-decoration:none;border-radius:4px;'>
Quay lại
</a>

</form>";

if(isset($_POST["them"])){

$makhoa=$_POST["makhoa"];
$tenkhoa=$_POST["tenkhoa"];

$conn->query("INSERT INTO khoa VALUES('$makhoa','$tenkhoa')");

header("Location:index.php?page=khoa");
exit();

}

}
///Sửa khoa
if($page=="sua_khoa"){

$id=$_GET["id"];

$sql="SELECT * FROM khoa WHERE MaKhoa='$id'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

echo "<h3>Sửa khoa</h3>";

echo "<form method='post'>

Mã khoa<br>
<input type='text' value='".$row["MaKhoa"]."' readonly><br><br>

Tên khoa<br>
<input type='text' name='tenkhoa' value='".$row["TenKhoa"]."'><br><br>

<button name='sua'>Cập nhật</button>

<a href='?page=khoa'
style='margin-left:10px;padding:5px 10px;background:#888;color:white;text-decoration:none;border-radius:4px;'>
Quay lại
</a>

</form>";

if(isset($_POST["sua"])){

$tenkhoa=$_POST["tenkhoa"];

$conn->query("UPDATE khoa SET TenKhoa='$tenkhoa' WHERE MaKhoa='$id'");

header("Location:index.php?page=khoa");
exit();

}

}
if($page=="xoa_khoa"){

$id=$_GET["id"];

$conn->query("DELETE FROM khoa WHERE MaKhoa='$id'");

header("Location:index.php?page=khoa");
exit();

}

// ================= LỚP =================

if($page=="lop"){

echo "<h3>Danh sách Lớp</h3>";

echo "<a href='?page=themlop'>➕ Thêm lớp</a>";

$sql="SELECT * FROM lop 
WHERE MaLop LIKE '%$search%' 
OR TenLop LIKE '%$search%'
OR MaKhoa LIKE '%$search%'";

$result=$conn->query($sql);

echo "<table>";

echo "<tr>
<th>Mã lớp</th>
<th>Tên lớp</th>
<th>Mã khoa</th>
<th>Hành động</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["MaLop"]."</td>";
echo "<td>".$row["TenLop"]."</td>";
echo "<td>".$row["MaKhoa"]."</td>";

echo "<td>
<a href='?page=sualop&id=".$row["MaLop"]."'>Sửa</a> |
<a href='?page=xoalop&id=".$row["MaLop"]."' onclick='return confirm(\"Bạn chắc chắn xóa?\")'>Xóa</a>
</td>";

echo "</tr>";

}

echo "</table>";

}
if($page=="themlop"){

if(isset($_POST['them'])){

$ma=$_POST['ma'];
$ten=$_POST['ten'];
$khoa=$_POST['khoa'];

$conn->query("INSERT INTO lop VALUES('$ma','$ten','$khoa')");

echo "<p style='color:green;'>Thêm thành công!</p>";
}

echo "

<h3>Thêm lớp</h3>

<form method='post'>

Mã lớp<br>
<input type='text' name='ma'><br><br>

Tên lớp<br>
<input type='text' name='ten'><br><br>

Mã khoa<br>
<input type='text' name='khoa'><br><br>

<button name='them'>Thêm</button>

<a href='index.php?page=lop'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}
if($page=="xoalop"){

$id=$_GET['id'];

$conn->query("DELETE FROM lop WHERE MaLop='$id'");

header("Location: index.php?page=lop");

}
if($page=="sualop"){

$id=$_GET['id'];

$result=$conn->query("SELECT * FROM lop WHERE MaLop='$id'");
$row=$result->fetch_assoc();

if(isset($_POST['sua'])){

$ten=$_POST['ten'];
$khoa=$_POST['khoa'];

$conn->query("UPDATE lop 
SET TenLop='$ten',
MaKhoa='$khoa'
WHERE MaLop='$id'");

echo "Cập nhật thành công!";
}

echo "

<h3>Sửa lớp</h3>

<form method='post'>

Tên lớp<br>
<input type='text' name='ten' value='".$row['TenLop']."'><br><br>

Mã khoa<br>
<input type='text' name='khoa' value='".$row['MaKhoa']."'><br><br>

<button name='sua'>Cập nhật</button>

<a href='index.php?page=lop'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}



// ================= ĐOÀN VIÊN =================

if($page=="doanvien"){

echo "<h3>Danh sách Đoàn viên</h3>";

echo "<a href='?page=themdoanvien'>➕ Thêm đoàn viên</a>";

$sql="SELECT * FROM doanvien 
WHERE MaSinhVien LIKE '%$search%' 
OR HoVaTen LIKE '%$search%'";

$result=$conn->query($sql);

echo "<table>";

echo "<tr>
<th>Mã sinh viên</th>
<th>Họ và tên</th>
<th>Mã lớp</th>
<th>Khóa học</th>
<th>Hành động</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["MaSinhVien"]."</td>";
echo "<td>".$row["HoVaTen"]."</td>";
echo "<td>".$row["MaLop"]."</td>";
echo "<td>".$row["KhoaHoc"]."</td>";

echo "<td>
<a href='?page=suadoanvien&id=".$row["MaSinhVien"]."'>Sửa</a> |
<a href='?page=xoadoanvien&id=".$row["MaSinhVien"]."' onclick='return confirm(\"Bạn chắc chắn xóa?\")'>Xóa</a>
</td>";

echo "</tr>";
}

echo "</table>";

}
if($page=="themdoanvien"){

if(isset($_POST['them'])){

$ma=$_POST['ma'];
$ten=$_POST['ten'];
$lop=$_POST['lop'];
$khoa=$_POST['khoa'];

$conn->query("INSERT INTO doanvien VALUES('$ma','$ten','$lop','$khoa')");

echo "<p style='color:green;'>Thêm thành công!</p>";
}

echo "

<h3>Thêm đoàn viên</h3>

<form method='post'>

Mã sinh viên<br>
<input type='text' name='ma'><br><br>

Họ và tên<br>
<input type='text' name='ten'><br><br>

Mã lớp<br>
<input type='text' name='lop'><br><br>

Khóa học<br>
<input type='text' name='khoa'><br><br>

<button name='them'>Thêm</button>

<a href='index.php?page=doanvien'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}
if($page=="xoadoanvien"){

$id=$_GET['id'];

$conn->query("DELETE FROM doanvien WHERE MaSinhVien='$id'");

header("Location: index.php?page=doanvien");

}
if($page=="suadoanvien"){

$id=$_GET['id'];

$result=$conn->query("SELECT * FROM doanvien WHERE MaSinhVien='$id'");
$row=$result->fetch_assoc();

if(isset($_POST['sua'])){

$ten=$_POST['ten'];
$lop=$_POST['lop'];
$khoa=$_POST['khoa'];

$conn->query("UPDATE doanvien 
SET HoVaTen='$ten',
MaLop='$lop',
KhoaHoc='$khoa'
WHERE MaSinhVien='$id'");

echo "Cập nhật thành công!";
}

echo "

<h3>Sửa đoàn viên</h3>

<form method='post'>

Họ và tên<br>
<input type='text' name='ten' value='".$row['HoVaTen']."'><br><br>

Mã lớp<br>
<input type='text' name='lop' value='".$row['MaLop']."'><br><br>

Khóa học<br>
<input type='text' name='khoa' value='".$row['KhoaHoc']."'><br><br>

<button name='sua'>Cập nhật</button>

<a href='index.php?page=doanvien'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}


// ================= HOẠT ĐỘNG =================

if($page=="hoatdong"){

echo "<h3>Danh sách Hoạt động</h3>";

echo "<a href='?page=themhoatdong'>➕ Thêm hoạt động</a>";

$sql="SELECT hoatdong.*, nguoiphutrach.TenPhuTrach
FROM hoatdong
LEFT JOIN nguoiphutrach 
ON hoatdong.MaHoatDong = nguoiphutrach.MaHoatDong
WHERE hoatdong.MaHoatDong LIKE '%$search%' 
OR hoatdong.TenHoatDong LIKE '%$search%'
OR nguoiphutrach.TenPhuTrach LIKE '%$search%'";

$result=$conn->query($sql);

echo "<table border='1'>";

echo "<tr>
<th>Mã hoạt động</th>
<th>Tên hoạt động</th>
<th>Ngày tổ chức</th>
<th>Ngày kết thúc</th>
<th>Người phụ trách</th>
<th>Hành động</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["MaHoatDong"]."</td>";
echo "<td>".$row["TenHoatDong"]."</td>";
echo "<td>".$row["NgayToChuc"]."</td>";
echo "<td>".$row["NgayKetThuc"]."</td>";
echo "<td>".$row["TenPhuTrach"]."</td>";

echo "<td>
<a href='?page=suahd&id=".$row["MaHoatDong"]."'>Sửa</a> |
<a href='?page=xoahd&id=".$row["MaHoatDong"]."' onclick='return confirm(\"Bạn chắc chắn xóa?\")'>Xóa</a>
</td>";

echo "</tr>";

}

echo "</table>";
}

/////////////////////////////////////////////////////
// ================= THÊM HOẠT ĐỘNG =================
/////////////////////////////////////////////////////

if($page=="themhoatdong"){

if(isset($_POST['them'])){

$ten=$_POST['ten'];
$ngay=$_POST['ngay'];
$ket=$_POST['ket'];
$phutrach=$_POST['phutrach'];

// Lấy mã hoạt động lớn nhất
$sql="SELECT MaHoatDong FROM hoatdong ORDER BY MaHoatDong DESC LIMIT 1";
$result=$conn->query($sql);

if($result->num_rows>0){

$row=$result->fetch_assoc();
$last=$row['MaHoatDong'];

$num=substr($last,2);
$num++;
$ma="HD".str_pad($num,2,"0",STR_PAD_LEFT);

}else{

$ma="HD01";

}

// Thêm hoạt động
$conn->query("INSERT INTO hoatdong VALUES('$ma','$ten','$ngay','$ket')");

// Tạo mã phụ trách
$sql2="SELECT MaPhuTrach FROM nguoiphutrach ORDER BY MaPhuTrach DESC LIMIT 1";
$result2=$conn->query($sql2);

if($result2->num_rows>0){

$row2=$result2->fetch_assoc();
$last2=$row2['MaPhuTrach'];

$num2=substr($last2,2);
$num2++;

$mapt="PT".str_pad($num2,2,"0",STR_PAD_LEFT);

}else{

$mapt="PT01";

}

// Thêm người phụ trách
$conn->query("INSERT INTO nguoiphutrach VALUES('$mapt','$phutrach','$ma')");

echo "<p style='color:green;'>Thêm thành công!</p>";

}

echo "

<h3>Thêm hoạt động</h3>

<form method='post'>

Tên hoạt động<br>
<input type='text' name='ten' required><br><br>

Ngày tổ chức<br>
<input type='date' name='ngay' required><br><br>

Ngày kết thúc<br>
<input type='date' name='ket' required><br><br>

Người phụ trách<br>
<input type='text' name='phutrach' required><br><br>

<button name='them'>Thêm</button>

<a href='index.php?page=hoatdong'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}

/////////////////////////////////////////////////////
// ================= XÓA HOẠT ĐỘNG =================
/////////////////////////////////////////////////////

if($page=="xoahd"){

$id=$_GET['id'];

// Xóa người phụ trách trước
$conn->query("DELETE FROM nguoiphutrach WHERE MaHoatDong='$id'");

// Xóa hoạt động
$conn->query("DELETE FROM hoatdong WHERE MaHoatDong='$id'");

header("Location: index.php?page=hoatdong");

}

/////////////////////////////////////////////////////
// ================= SỬA HOẠT ĐỘNG =================
/////////////////////////////////////////////////////

if($page=="suahd"){

$id=$_GET['id'];

// Lấy dữ liệu hoạt động + người phụ trách
$result=$conn->query("SELECT hoatdong.*, nguoiphutrach.TenPhuTrach
FROM hoatdong
LEFT JOIN nguoiphutrach
ON hoatdong.MaHoatDong = nguoiphutrach.MaHoatDong
WHERE hoatdong.MaHoatDong='$id'");

$row=$result->fetch_assoc();

if(isset($_POST['sua'])){

$ten=$_POST['ten'];
$ngay=$_POST['ngay'];
$ket=$_POST['ket'];
$phutrach=$_POST['phutrach'];

// Cập nhật hoạt động
$conn->query("UPDATE hoatdong 
SET TenHoatDong='$ten',
NgayToChuc='$ngay',
NgayKetThuc='$ket'
WHERE MaHoatDong='$id'");

// Cập nhật người phụ trách
$conn->query("UPDATE nguoiphutrach
SET TenPhuTrach='$phutrach'
WHERE MaHoatDong='$id'");

// quay lại danh sách
header("Location: index.php?page=hoatdong");
exit();

}

echo "

<h3>Sửa hoạt động</h3>

<form method='post'>

Tên hoạt động<br>
<input type='text' name='ten' value='".$row['TenHoatDong']."' required><br><br>

Ngày tổ chức<br>
<input type='date' name='ngay' value='".$row['NgayToChuc']."' required><br><br>

Ngày kết thúc<br>
<input type='date' name='ket' value='".$row['NgayKetThuc']."' required><br><br>

Người phụ trách<br>
<input type='text' name='phutrach' value='".$row['TenPhuTrach']."' required><br><br>

<button name='sua'>Cập nhật</button>

<a href='index.php?page=hoatdong'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}


// ================= THAM GIA =================

if($page=="thamgia"){

// ===== TẠO DANH SÁCH SINH VIÊN NGẪU NHIÊN =====
if(isset($_POST['tao'])){

$mahd=$_POST['mahd'];
$soluong=$_POST['soluong'];

$sql="SELECT MaSinhVien FROM doanvien ORDER BY RAND() LIMIT $soluong";
$result_rand=$conn->query($sql);

while($r=$result_rand->fetch_assoc()){

$masv=$r['MaSinhVien'];

$conn->query("INSERT INTO thamgia1 VALUES('$masv','$mahd','Đã tham gia')");

}

echo "<p style='color:green;'>Đã tạo danh sách sinh viên tham gia!</p>";
}


// ===== TIÊU ĐỀ =====
echo "<h3>Danh sách Tham gia hoạt động</h3>";

echo "

<h4>Tạo sinh viên tham gia hoạt động</h4>

<form method='post'>

Mã hoạt động
<input type='text' name='mahd' required>

Số lượng sinh viên
<input type='number' name='soluong' required>

<button name='tao'>Tạo danh sách</button>

</form>

<br>

<h4>Tìm sinh viên theo mã hoạt động</h4>

<form method='get'>

<input type='hidden' name='page' value='thamgia'>

Nhập mã hoạt động
<input type='text' name='search' placeholder='VD: HD01'>

<button type='submit'>Tìm</button>

</form>

<br>

<h4>Kiểm tra sinh viên tham gia bao nhiêu hoạt động</h4>

<form method='get'>

<input type='hidden' name='page' value='thamgia'>

Nhập mã sinh viên
<input type='text' name='masv' placeholder='VD: SV01'>

<button type='submit'>Kiểm tra</button>

</form>

<br>

";


// ===== ĐẾM HOẠT ĐỘNG CỦA SINH VIÊN =====

if(isset($_GET['masv']) && $_GET['masv']!=''){

$masv=$_GET['masv'];

$sql_count="SELECT COUNT(*) as tong
FROM thamgia1
WHERE `COL 1`='$masv'
AND `COL 3`='Đã tham gia'";

$result_count=$conn->query($sql_count);

$row_count=$result_count->fetch_assoc();

echo "<h4>Sinh viên <b>$masv</b> đã tham gia <b>".$row_count['tong']."</b> hoạt động</h4>";

}


// ===== TÌM THEO MÃ HOẠT ĐỘNG =====

if(isset($_GET['search']) && $_GET['search']!=''){

$search=$_GET['search'];

$sql="SELECT * FROM thamgia1
WHERE `COL 2`='$search'
AND `COL 3`='Đã tham gia'";

}else{

$sql="SELECT * FROM thamgia1 WHERE `COL 3`='Đã tham gia'";

}

$result=$conn->query($sql);


// ===== ĐẾM TỔNG SINH VIÊN =====
$total = $result->num_rows;

echo "<h4>Tổng sinh viên đã tham gia: ".$total."</h4>";


// ===== HIỂN THỊ BẢNG =====

echo "<table border='1' cellpadding='6'>";

echo "<tr>
<th>Mã sinh viên</th>
<th>Mã hoạt động</th>
<th>Trạng thái</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";
echo "<td>".$row["COL 1"]."</td>";
echo "<td>".$row["COL 2"]."</td>";
echo "<td>".$row["COL 3"]."</td>";
echo "</tr>";

}

echo "</table>";

}
// ================= PHỤ TRÁCH =================

if($page=="phutrach"){

echo "<h3>Danh sách Phụ trách</h3>";

echo "<a href='?page=thempt'>➕ Thêm phụ trách</a>";

$sql="SELECT * FROM nguoiphutrach
WHERE MaPhuTrach LIKE '%$search%' 
OR TenPhuTrach LIKE '%$search%'
OR MaHoatDong LIKE '%$search%'";

$result=$conn->query($sql);

echo "<table>";

echo "<tr>
<th>Mã phụ trách</th>
<th>Tên phụ trách</th>
<th>Mã hoạt động</th>
<th>Hành động</th>
</tr>";

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row["MaPhuTrach"]."</td>";
echo "<td>".$row["TenPhuTrach"]."</td>";
echo "<td>".$row["MaHoatDong"]."</td>";

echo "<td>
<a href='?page=suapt&id=".$row["MaPhuTrach"]."'>Sửa</a> |
<a href='?page=xoapt&id=".$row["MaPhuTrach"]."' onclick='return confirm(\"Bạn chắc chắn xóa?\")'>Xóa</a>
</td>";

echo "</tr>";

}

echo "</table>";
}

// ================= THÊM PHỤ TRÁCH =================

if($page=="thempt"){

if(isset($_POST['them'])){

$ma=$_POST['ma'];
$ten=$_POST['ten'];
$hd=$_POST['hd'];

// thêm vào bảng
$conn->query("INSERT INTO nguoiphutrach(MaPhuTrach,TenPhuTrach,MaHoatDong)
VALUES('$ma','$ten','$hd')");

// quay lại trang danh sách
header("Location: index.php?page=phutrach");
exit();
}

echo "

<h3>Thêm phụ trách</h3>

<form method='post'>

Mã phụ trách<br>
<input type='text' name='ma' required><br><br>

Tên phụ trách<br>
<input type='text' name='ten' required><br><br>

Mã hoạt động<br>
<input type='text' name='hd' required><br><br>

<button name='them'>Thêm</button>

<a href='index.php?page=phutrach'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";
}


// ================= XÓA PHỤ TRÁCH =================

if($page=="xoapt"){

$id=$_GET['id'];

$conn->query("DELETE FROM nguoiphutrach WHERE MaPhuTrach='$id'");

header("Location: index.php?page=phutrach");
exit();

}


// ================= SỬA PHỤ TRÁCH =================

if($page=="suapt"){

$id=$_GET['id'];

$result=$conn->query("SELECT * FROM nguoiphutrach WHERE MaPhuTrach='$id'");
$row=$result->fetch_assoc();

if(isset($_POST['sua'])){

$ten=$_POST['ten'];
$hd=$_POST['hd'];

$conn->query("UPDATE nguoiphutrach 
SET TenPhuTrach='$ten',
MaHoatDong='$hd'
WHERE MaPhuTrach='$id'");

header("Location: index.php?page=phutrach");
exit();
}

echo "

<h3>Sửa phụ trách</h3>

<form method='post'>

Tên phụ trách<br>
<input type='text' name='ten' value='".$row['TenPhuTrach']."' required><br><br>

Mã hoạt động<br>
<input type='text' name='hd' value='".$row['MaHoatDong']."' required><br><br>

<button name='sua'>Cập nhật</button>

<a href='index.php?page=phutrach'
style='padding:6px 12px;background:#888;color:white;text-decoration:none;border-radius:4px;margin-left:10px;'>
Quay lại
</a>

</form>

";

}


?>

</div>

</body>
</html>
</div>
</div>