<?php
	include 'includes/session.php';

 $price=$_GET['price'];
 $customerId = $_GET['id'];
 $ticket=$_GET['ticket'];
 $now = date('Y-m-d');

 $conn = $pdo->open();








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