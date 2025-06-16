<?php
require_once("include/initialize.php");

 ?>
  <?php
 if (isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."index.php");
     } 
  ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Attenndance Monitoring</title> 

<!-- Bootstrap core CSS -->
<link href="<?php echo web_root; ?>css/css/bootstrap.min.css" rel="stylesheet"> 
<link href="<?php echo web_root; ?>css/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  
  <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/main.css">
 
   
<body id="login" style="">  


  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
          <span class="login100-form-title-1">
            Sign In
          </span>
          <?php check_message()?>
        </div>

        <form class="login100-form validate-form" action="" method="POST">
          <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
            <span class="label-input100">Username</span>
            <input class="input100" type="text" name="username" placeholder="Enter username">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="pass" placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>

  <!--         <div class="flex-sb-m w-full p-b-30">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div>

            <div>
              <a href="#" class="txt1">
                Forgot Password?
              </a>
            </div>
          </div> -->

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="btnLogin">
              Login
            </button>
          </div>
        </form>
      </div>
    </div> 
  </div> 

 <?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['username']);
  $upass  = trim($_POST['pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect("login.php");
         
    } else {  
  //it creates a new objects of member
    $user = new User();
    //make use of the static function, and we passed to parameters
    $res = $user::userAuthentication($email, $h_upass);
    if ($res==true) { 
       message("You logon as ".$_SESSION['ACCOUNT_TYPE'].".","success");
       
       $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
          VALUES (".$_SESSION['ACCOUNT_ID'].",'".date('Y-m-d H:i:s')."','".$_SESSION['ACCOUNT_TYPE']."','Logged in')";
          $mydb->setQuery($sql);
          $mydb->executeQuery();

      if ($_SESSION['ACCOUNT_TYPE']=='Administrator'){ 
         redirect(web_root."index.php");
      }elseif($_SESSION['ACCOUNT_TYPE']=='Registrar'){
          redirect(web_root."index.php");

      }else{
           redirect(web_root."login.php");
      }
    }else{
      message("Account does not exist! Please contact Administrator.", "error");
       redirect(web_root."login.php"); 
    }
 }
 } 
 ?>  
  <script src="<?php echo web_root; ?>jquery/jquery.min.js"></script>  
    <script src="<?php echo web_root; ?>js/main.js"></script>
  </body>
</html>
