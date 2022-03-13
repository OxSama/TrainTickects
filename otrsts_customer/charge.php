<?php
	include 'includes/session.php';
  require_once('vendor/autoload.php');

 $price=$_GET['price'];
 $customerId = $_GET['id'];
 $ticket='';
 $now = date('Y-m-d');

 $conn = $pdo->open();

 try{
  $stmt1 = $conn->prepare("SELECT * from passingers where customer_id = :customer order by id desc limit 1");
  $stmt1->execute(['customer'=>$customerId]);
                  
  foreach ($stmt1 as $row) {

     $ticket= $row['ticket_id'];
    //echo "jbt";  
  }            

}
catch(PDOException $e){
  $_SESSION['error'] = $e->getMessage();
}





  \Stripe\Stripe::setApiKey('sk_test_51Jdy9WDngJbepu4hfVEcWJtBgYjPwGC7opuNzH5xGjz9Zrpe1ZQ93WjodiLl4FMHYQGoAoqKtOfMZaIK5YTUbqy600wNRvj3lK');

   // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
 $first_name = $POST['first_name'];
 $last_name = $POST['last_name'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));
//echo $customer;
// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $price,
  "currency" => "usd",
  "description" => "Ticket Booking",
  "customer" => $customer->id
));

// Customer Data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email
];



// Add Customer To DB
try{
  $stmt = $conn->prepare("INSERT INTO accounts (id, first_name, last_name, email, created_at) 
  VALUES(:id, :first_name, :last_name, :email, :created_at)");
   $stmt->execute(['id'=>$charge->customer,'first_name'=>$first_name,'last_name'=>$last_name,'email' => $email 
    ,'created_at' => $now]);
}
catch(PDOException $e){
  $_SESSION['error'] = $e->getMessage();
}


// Add Transaction To DB
try{
    $stmt = $conn->prepare("INSERT INTO transactions (id, account_id, product, amount, currency, status,created_at,ticket_id ) 
  VALUES (:id, :account_id, :product, :amount, :currency, :status,:created_at,:ticket_id )");
  $stmt->execute(['id'=>$charge->id,'account_id'=>$charge->customer,'product'=>$charge->description,'amount'=>$charge->amount,'currency'=>$charge->currency,'status'=>$charge->status,'created_at'=>$now , 'ticket_id' => $ticket ]);
}
catch(PDOException $e){
  $_SESSION['error'] = $e->getMessage();
}















include('phpqrcode/qrlib.php');

// how to save PNG codes to server

$tempDir = "qrcodes/";

$codeContents = (string)$ticket;

// we need to generate filename somehow, 
// with md5 or with database ID used to obtains $codeContents...
$fileName = '005_file_'.md5($codeContents).'.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = $tempDir.$fileName;

// generating
if (!file_exists($pngAbsoluteFilePath)) {
    QRcode::png($codeContents, $pngAbsoluteFilePath);
    // echo 'File generated!';
    // echo '<hr />';
} else {
    // echo 'File already generated! We can use this cached file to speed up site on common codes!';
    // echo '<hr />';
}

// echo 'Server PNG File: '.$pngAbsoluteFilePath;
// echo '<hr />';

// displaying
echo '<img src="'.$urlRelativeFilePath.'" />';


$stmt4 = $conn->prepare("SELECT COUNT(*) AS numrows FROM passingers WHERE ticket_id=?");
$stmt4->execute(array($ticket));
$row4 = $stmt4->fetch();
if($row4['numrows'] > 0){

try{
  $stmt = $conn->prepare("UPDATE passingers SET qrcode=:qrcode WHERE ticket_id=:ticket_id");
$stmt->execute(['qrcode'=>$pngAbsoluteFilePath ,'ticket_id'=>$ticket]);
}
catch(PDOException $e){
$_SESSION['error'] = $e->getMessage();
}

}

$pdo->close();






















// Redirect to success

header("Location: viewTicketDetails.php?id=$customerId&ticket=$ticket");