<?php include "connect.php";
session_start();
$err = [];
if (isset($_POST['login'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    $sqllogin = "SELECT * FROM tai_khoan t, nhan_vien n WHERE t.manv = n.ma and ten_dang_nhap='$username' AND mat_khau='$password' AND role=2";

    $reslogin = mysqli_query($conn,$sqllogin);
    $login = mysqli_fetch_assoc($reslogin);
    if ($username!= '' && $password!=''){
    if (mysqli_num_rows($reslogin) == 1)
    {
       
        $_SESSION['admin'] = $login;
        header("location:index.php");
}
else {
    $error[] = 'Tài khoản hoặc mật khẩu không đúng!!!';
}
    }
}


// if (isset($_POST['signup'])){
//   $username= $_POST['username'];
//   $password= $_POST['password'];
//   $name = $_POST['name'];
//   $confirmpassword = $_POST['confirm'];
//     $sqlsignup = "SELECT * FROM tai_khoan WHERE ten_dang_nhap='$username' AND mat_khau='$password' AND role=1";
//     $ressignup = mysqli_query($conn,$sqlsignup );
//     $signup = mysqli_fetch_assoc($ressignup);
// if(mysqli_num_rows($ressignup) > 0){
 
//    $error[] = 'Tên đăng nhập đã tồn tại!';
 
// }else{
 
//    if($password != $confirmpassword){
//       $error[] = 'Mật khẩu không khớp!';
//    }else{
   

//     $sql = "INSERT INTO tai_khoan( ten_dang_nhap, mat_khau, role)
//     VALUES ('$username','$password','1')";
//     mysqli_query($conn, $sql);
    
//     $sql = "INSERT INTO khach_hang (ten,ma_tai_khoan) VALUES ('$name',@@identity)";      
//     mysqli_query($conn, $sql);
//     $_SESSION['admin'] = $login;
//     header("location:index.php");
//    }
// }}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login & Signup Form | CodingNepal</title>
    <link rel="stylesheet" href="../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <style>
      .error-msg {
    font-size:small;
    color :red;
}
    </style>
   
    <div style="height: 400px;" class="wrapper">
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
      
        <!-- <div class="title signup">Đăng Ký</div> -->
        
      </div>
      <div class="form-container">
        <!-- <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div> -->
        <div class="form-inner">
          <form action="login.php" method="post" class="login">
            <div class="field">
              <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input name="login" type="submit" value="Login">
            </div>
            <!-- <div class="signup-link">Not a member? <a href="">Signup now</a></div> -->
          </form>
          <form action="login.php" method="post" class="signup">
          <div class="field">
              <input name="name" type="text" placeholder="Name" required>
            </div>
            <div class="field">
              <input name="username" type="text" placeholder="Username" required>
            </div>
            <div class="field">
              <input name="password" type="password" placeholder="Password" required>
            </div>
            <div class="field">
              <input name="confirm" type="password" placeholder="Confirm password" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input name="signup" type="submit" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>

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
