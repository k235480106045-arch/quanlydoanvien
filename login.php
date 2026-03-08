<?php
session_start();

$conn = new mysqli("localhost","root","","quanlydoanvientruong");

if(isset($_POST['login'])){

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if($result->num_rows > 0){
$_SESSION['login']=$user;
header("Location:index.php");
}
else{
$error="Sai tài khoản hoặc mật khẩu";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng nhập hệ thống</title>

<style>

body{
background:#e9eef3;
font-family:Arial;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:40px;
width:320px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

button{
width:100%;
padding:10px;
background:#3498db;
color:white;
border:none;
}

.error{
color:red;
text-align:center;
}

</style>

</head>

<body>

<div class="box">

<h3>Đăng nhập hệ thống</h3>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">

<input type="text" name="username" placeholder="Tài khoản" required>

<input type="password" name="password" placeholder="Mật khẩu" required>

<button name="login">Đăng nhập</button>

</form>

</div>

</body>
</html>