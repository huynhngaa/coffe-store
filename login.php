<?php
include "connect.php";
session_start();
$err = [];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sqllogin = "SELECT * FROM tai_khoan t , khach_hang k  WHERE t.makh= k.ma and ten_dang_nhap='$username' AND mat_khau='$password' AND role=1";

    $reslogin = mysqli_query($conn, $sqllogin);
    $login = mysqli_fetch_assoc($reslogin);
    if ($username != '' && $password != '') {
        if (mysqli_num_rows($reslogin) == 1) {
            $_SESSION['login'] = $login;
            header("location:index.php");
        } else {
            $error[] = 'Tài khoản hoặc mật khẩu không đúng!!!';
        }
    }
}
if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $name = $_POST['name'];
  $phone = $_POST['sdt'];
  $confirmpassword = $_POST['confirm'];

  try {
      // Thực hiện thêm khách hàng
      $sql = "INSERT INTO khach_hang (ten, so_dien_thoai) VALUES ('$name', '$phone')";
      mysqli_query($conn, $sql);

      // Thực hiện thêm tài khoản
      $sql = "INSERT INTO tai_khoan (ten_dang_nhap, mat_khau, role, makh) VALUES ('$username', '$password', '1', LAST_INSERT_ID())";
      mysqli_query($conn, $sql);

      // Kiểm tra đăng nhập sau khi đăng ký thành công
      $sqllogin = "SELECT t.*, k.* FROM tai_khoan t JOIN khach_hang k ON t.makh = k.ma WHERE t.ten_dang_nhap='$username' AND t.mat_khau='$password' AND t.role=1";
      $reslogin = mysqli_query($conn, $sqllogin);
      $_SESSION['login'] = mysqli_fetch_assoc($reslogin); // Đặt phiên đăng nhập sau khi đăng ký thành công
      header("location: index.php");
  } catch (Exception $e) {
      // Xử lý lỗi 1062 (tên đăng nhập bị trùng) trong đây
      $errorCode = $e->getCode();
      if ($errorCode === 1062) {
          $error[] = 'Người dùng đã có trong hệ thống!';
      } else {
          // Xử lý các lỗi khác nếu cần
      }
  }
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login & Signup Form | CodingNepal</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <style>
      .error-msg {
    font-size:small;
    color :red;
}
    </style>
   
    <div class="wrapper">
    <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span style=" display: flex;
            justify-content: center;" class="error-msg text-center">'.$error.'</span>';
         }
      };
     
      ?>
      <div class="title-text">
      
        <div class="title login">Đăng Nhập</div>
      
        <div class="title signup">Đăng Ký</div>
        
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="login.php" method="post" class="login">
            <div class="field">
              <input   oninvalid="this.setCustomValidity('Vui lòng nhập!')"
  oninput="this.setCustomValidity('')" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="field">
              <input  oninvalid="this.setCustomValidity('Vui lòng nhập!')"
  oninput="this.setCustomValidity('')" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input name="login" type="submit" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
          </form>
          <form action="login.php" method="post" class="signup">
          <div class="field">
              <input name="name" type="text" placeholder="Name" required>
            </div>
            <div class="field">
  <input name="sdt" id="sdt" type="text" placeholder="Phone" required>
</div>
<div id="sdtError" style="color: red;"></div>
            <div class="field">
  <input name="username" id="username" type="text" placeholder="Username" required>
</div>
<div id="usernameError" style="color: red;"></div>
            <div class="field">
            <input  name="password" type="password" placeholder="VD: roHan123, Rohannguyen,..." required
            pattern="^(?=.*[A-Z]).{8,}$"
  oninvalid="this.setCustomValidity('Mật khẩu không hợp lệ!')"
  oninput="this.setCustomValidity('')" >

            </div>
            <div id="passwordError" style="color: red;"></div>
            <div class="field">
            <input name="confirm" type="password" placeholder="Confirm password" required
            oninvalid="this.setCustomValidity('Vui lòng nhập!')"
  oninput="this.setCustomValidity('')">

</div>
<div id="confirmPasswordError" style="color: red;"></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input name="signup" type="submit" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>
    


<script>
  const sdtInput = document.getElementById('sdt');
  const sdtError = document.getElementById('sdtError');

  sdtInput.addEventListener('input', () => {
    const phoneNumber = sdtInput.value;

    // Sử dụng regex để kiểm tra số điện thoại
    const regex = /^0\d{9}$/;

    if (!regex.test(phoneNumber)) {
      sdtError.textContent = "Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0 và có đúng 10 chữ số.";
      sdtInput.setCustomValidity("Invalid phone number");
    } else {
      sdtError.textContent = "";
      sdtInput.setCustomValidity("");
    }
  });
</script>




    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
