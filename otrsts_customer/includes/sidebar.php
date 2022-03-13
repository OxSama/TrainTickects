<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
			  <?php
		  if(isset($_SESSION['user'])||isset($_SESSION['staff'])){
			$id = $_GET['id'];
		  }
	 
		  else{
	 
					$id = '';
	 
		  }
?>
	    	<h3 class="box-title"><b>How to Book a Ticket?</b></h3>

	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<li><strong>Step 1:</strong> Make an acount.</li>
			<li><strong>Step 2:</strong> Then Login with your email and password.</li>
	  		<li><strong>Step 3:</strong> Enter Stations between which you want to travel and date 
			  <br>of journey.</li>
	  		<li><strong>Step 4:</strong> Select preferrable trip if exist.</li>
			  <li><strong>Step 5:</strong>Fill your booking details:<br>
			  <strong>a)</strong>Fill passanger information.<br>
			  <strong>b)</strong>Make Payment.<br>
			  <strong>c)</strong>After Payment you will get Ticket's ID, keep it save.
</li>

	    	<ul>
	  	</div>
	</div>
</div>

<div class="row">
<?php
    //   if(isset($_SESSION['error'])){
    //     echo "
    //       <div class='callout callout-danger text-center'>
    //         <p>".$_SESSION['error']."</p> 
    //       </div>
    //     ";
    //     unset($_SESSION['error']);
    //   }
    //   if(isset($_SESSION['success'])){
    //     echo "
    //       <div class='callout callout-success text-center'>
    //         <p>".$_SESSION['success']."</p> 
    //       </div>
    //     ";
    //     unset($_SESSION['success']);
    //   }
    ?>
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Are you already a passenger?</b></h3>
	  	</div>
	  	<div class="box-body">
	    	<p>Enter your ticket ID , to view Ticket details.</p>
	    	<form method="POST" action="./viewTicketVerify.php?id=<?php echo $id?>">
		    	<div class="input-group">
	                <input type="number" class="form-control" name="ticketId" required >
	                <span class="input-group-btn">
	                    <!-- <a href="viewTicketDetails.php?id=<?php //echo "$id"?>"> -->
						<button type="submit" class="btn btn-info btn-flat" name="view"><i class="fa fa-search"></i> view </button>
					<!-- </a> -->
	                </span>
	            </div>
		    </form>
	  	</div>
	</div>
</div>

<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Routes Map     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </b></h3> 
			
<a href="images/Railways_in_Sudan.svg.png" download>
  <img src="images/d.png" alt="download" width="15" height="15">
</a>
	  	</div>
	  	<div class="box-body">
		  <a target="_blank" href="images/Railways_in_Sudan.svg.png">

		  <img src="images/Railways_in_Sudan.svg.png"  width="265" height="230" alt="trains routes map"></a>


	  	</div>
	</div>
</div>






<div class="row">
	<div class='box box-solid'>
	  	<div class='box-header with-border'>
	    	<h3 class='box-title'><b>Follow us on Social Media</b></h3>
	  	</div>
	  	<div class='box-body'>
	    	<a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
	    	<a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
	    	<a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
	    	<a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
	  	</div>
	</div>
</div>

<div class="row">
	<div class='box box-solid'>
	  	<div class='box-header with-border'>
	    	<h3 class='box-title'><b>Contact us</b></h3>
	  	</div>
	  	<div class='box-body'>
	    	<a class="btn btn-phone-icon btn-phone"><i class="fa fa-phone"></i>  +249123456789</a> <br>
	    	<a class="btn btn-envelope-icon btn-envelope"><i class="fa fa-envelope"></i>  sudanrailways@gmail.com</a>
	  	</div>
	</div>
</div>

