<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/homeNavbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-15">
					<!-- trip search begin -->
				<h1 class="page-header">Search for Trips</h1>
	        		<div class="box box-solid">
	        			<div class="box-body" >
						<form id="manage-filter"  action="index.php?page=flights" method="POST" >
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="" class="col-sm-3 control-label">Route</label>
                                            <select name="departure" id="departure" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="col-sm-5 control-label">Stop Station</label>
                                            <select name="arrival" id="arrival" class="form-control">

                                                <option value=""></option>

                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="" class="col-sm-3 control-label">Day</label>
                                            <input type="date" class="form-control" name="date" autocomplete="off" value="<?php echo  date("Y-m-d") ?>">
                                        </div>
                         <br>
                                        <div class="col-sm-3 offset-sm-3">
										<button type="submit" class="btn btn-primary btn-flat" name=""><i class="fa fa-search"></i> Find trip</button>
                                        </div>

                                     
                                        
                                    </div>

									
                                </form>
						</div>
					</div>
					<!-- trip search end  -->
	        		<h1 class="page-header">Trips Available</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th>Departure Date & Time</th>
                                <th>Arrival Date & Time</th>
                                <th width="30%">Price</th>
								<th></th>

		        			</thead>
		        			<tbody>


								<td></td>
								<td></td>
								<td><select class='form-control'><option >Busniss class : 2000</option ><option >Common class : 1000</option></select></td>
								<td width="2%">
                              <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-ticket'></i> Book now</button>
								</td>
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				echo "
	        				";
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to book your tickets.</h4>
	        				";
	        			}
	        		?>
	        	</div>
	        	
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
</body>
</html>