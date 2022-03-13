<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }

 

?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition register-page">
<div class="register-box">
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
  	<div class="register-box-body">
    <a href="index.php"><i class="fa fa-home"></i> Home</a><br><br><br>

    	<h3 class="login-box-msg"><strong>Register a new account</strong></h3><br><br>
<form  method="POST" action="register.php" enctype="multipart/form-data">
  <input type="hidden" id="g-token" name="g-token">
    	
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname"   required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" minlength="8" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repassword" placeholder="Retype password" minlength="8" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
      
          <hr>
      		<div class="row">
    			<div class="col-xs-12">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Sign Up</button>
        		</div>
      		</div>
    	</form>
      <br>
      <p class="text-center" >already have an account?<a href="login.php"><strong> Login</strong></a></p><br>
  	</div>

</div>
	
<?php include 'includes/scripts.php' ?>
<script>
      
        grecaptcha.ready(function() {
          grecaptcha.execute('6Ld4SaMeAAAAAPOPb4QXXZplFCKRiT2Ciav-cghK', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
              document.getElementById("g-token").value=token;
          });
        });
      
  </script>
</body>
<script src="https://www.google.com/recaptcha/api.js?render=6Ld4SaMeAAAAAPOPb4QXXZplFCKRiT2Ciav-cghK"></script>

</html>