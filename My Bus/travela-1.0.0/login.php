<?php
// Initialize the session
session_start();
date_default_timezone_set("Asia/Kolkata"); 
//echo date('m/d/Y',strtotime("-1 days"));
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["user_login"]) && $_SESSION["user_login"] == true)
{
    header("location: index.php");
    exit;
}

include("./includes/db.php");
if(isset($_POST["login"]))
{
	$cust_email=$_POST["uname"];
	$password=$_POST["pass"];
	//session_start();
	if(empty($cust_email))
	{
		echo '<script language="javascript">';
		echo 'alert("Please Enter Your Mobile No")';
		echo '</script>';
	}
	else if(empty($password))
	{
		echo '<script language="javascript">';
		echo 'alert("Please Enter Password")';
		echo '</script>';
	}
	else
	{
	
        $checkUser="SELECT * FROM `user` WHERE `email`='$cust_email' ";
        $result=mysqli_query($conn,$checkUser);
    
        if(mysqli_num_rows($result)>0)
        { 
            
            $checkUserquery="SELECT * FROM `user` WHERE `email`='$cust_email' AND `password`='$password'";
            $resultant=mysqli_query($conn,$checkUserquery);
        
            if(mysqli_num_rows($resultant)>0)
            {
                session_start();
                // Store data in session variables
                $_SESSION["user_login"] = true;
                $_SESSION["email"] = $cust_email;
                header("location:index.php");
			      
            }
        }
        else{
            echo 'alert("Please Enter valid details")';
	
        }
    }
}    
?>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Glowing Inputs Login Form UI</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');
*{
  margin: 0;
  padding: 0;
  font-family: 'Poppins',sans-serif;
}
body{
  display: flex;
  height: 100vh;
  text-align: center;
  align-items: center;
  justify-content: center;
  background:#00000099;
}
.login-form{
  position: relative;
  width: 370px;
  height: auto;
  background: #1b1b1b;
  padding: 40px 35px 60px;
  box-sizing: border-box;
  border: 1px solid black;
  border-radius: 5px;
  box-shadow: inset 0 0 1px #272727;
}
.text{
  font-size: 30px;
  color: #c7c7c7;
  font-weight: 600;
  letter-spacing: 2px;
}
form{
  margin-top: 40px;
}
form .field{
  margin-top: 20px;
  display: flex;
}
.field .fas{
  height: 50px;
  width: 60px;
  color: #868686;
  font-size: 20px;
  line-height: 50px;
  border: 1px solid #444;
  border-right: none;
  border-radius: 5px 0 0 5px;
  background: linear-gradient(#333,#222);
}
.field input,form button{
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 19px;
  color: #868686;
  padding: 0 15px;
  border-radius: 0 5px 5px 0;
  border: 1px solid #444;
  caret-color: #f6f717;
  background: linear-gradient(#333,#222);
}
input:focus{
  color: #f6f717;
  box-shadow: 0 0 5px rgba(0,255,0,.2),
              inset 0 0 5px rgba(0,255,0,.1);
  background: linear-gradient(#333933,#222922);
  animation: glow .8s ease-out infinite alternate;
}
@keyframes glow {
   0%{
    border-color: #f6f717;
    box-shadow: 0 0 5px rgba(0,255,0,.2),
                inset 0 0 5px rgba(0,0,0,.1);
  }
   100%{
    border-color: #6f6;
    box-shadow: 0 0 20px rgba(0,255,0,.6),
                inset 0 0 10px rgba(0,255,0,.4);
  }
}
button{
  margin-top: 30px;
  border-radius: 5px!important;
  font-weight: 600;
  letter-spacing: 1px;
  cursor: pointer;
}
button:hover{
  color: #f6f717;
  border: 1px solid #f6f717;
  box-shadow: 0 0 5px rgba(0,255,0,.3),
              0 0 10px rgba(0,255,0,.2),
              0 0 15px rgba(0,255,0,.1),
              0 2px 0 black;
}
.link{
  margin-top: 25px;
  color: #868686;
}
.link a{
  color: #f6f717;
  text-decoration: none;
}
.link a:hover{
  text-decoration: underline;
}
      </style>
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            LOGIN
         </div>
         <form method="POST" action="">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" placeholder="Enter Username" name="uname" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" title="xyz@something.com" required>
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" placeholder="Enter Password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
            </div>
            <button type="submit" name="login">LOGIN</button>
            <div class="link">
               Not a member?
               <a href="register.php">Signup now</a>
            </div>
         </form>
      </div>
   </body>
</html>