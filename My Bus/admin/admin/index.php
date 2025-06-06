  <?php
  require("./include/config.php");
  session_start();
  if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `admin` WHERE email='$email' AND password='$password'";
    $select = mysqli_query($conn, $sql);

    if ($select) {

      $row = mysqli_fetch_assoc($select);
      if ($row) {
        $_SESSION['admin_email'] = $email;
        header("location:dashboard.php");
        exit();
      } else {
        echo '<script>alert("Invalid email or password")</script>';
        header("location:index.php");
        exit();
      }
    } else {
      echo '<script>alert("Error in query execution")</script>';
      header("location:index.php");
      exit();
    }
  }
  ?>


  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Admin</title>
  </head>

  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Bus Booking System</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i> Sign In | Admin</h3>

          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" name="email" id="email" type="text" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>

          <div class="form-group btn-container" style="margin-top:45px">
            <button type="login" name="login" id="submit" class="btn btn-primary btn-block">SIGN IN</button>
          </div>

        </form>

      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
    </script>
  </body>

  </html>