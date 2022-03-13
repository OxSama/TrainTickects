<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    $id=$_SESSION['user'];
    header("location: index.php?id=$id");
  }
  else if(isset($_SESSION['staff'])){
    $id=$_SESSION['staff'];
    header("location: index.php?id=$id");
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="login-box-body">
    <a href="index.php"><i class="fa fa-home"></i> Home</a>

    	<h3 class="login-box-msg"><strong>Login</strong></h3>

    	<form action="verify.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-12" text-center >
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Login</button>
        		</div>
      		</div>
    	</form>
      <br>
      <p class="text-center" ><a href="password_forgot.php"><strong>Forgotten password?</strong></a><br></p>
      <hr>
      <h4 class="text-center" ><a href="signup.php"><strong>Create New Account</strong></a><br></h4>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>