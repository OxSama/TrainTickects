<?php
	include 'includes/session.php';



	if(isset($_POST['print'])){
	

		$conn = $pdo->open();

		require_once('tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('Ticket Info');  
	    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	    $pdf->SetDefaultMonospacedFont('helvetica');  
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
	    $pdf->setPrintHeader(false);  
	    $pdf->setPrintFooter(false);  
	    $pdf->SetAutoPageBreak(TRUE, 10);  
	    $pdf->SetFont('helvetica', '', 11);  
	    $pdf->AddPage();  
	    $content = '';  
	    $content .= '
        <strong>
        <i><h4>Sudan Railways</h4></i><br>
</strong>

        <h4>
        Ticket ID : 298437592567835
         </h4><br>

        <strong>
            Passenger Name :</strong> Razan Mohamed Elhassan
        <br><br>
        <h3>
        kHARTOUM
         - 
       ATBARA
         </h3><br>
        <p><strong>Departure Date:</strong> 8-10-2021 @9:00AM</p>
    </strong>
        <i>Estimated Arrival Time: 9-10-2021 @3:00PM</i><br><br>
        
        <strong>
            Class Type :</strong> Class A
        <br><br>
        <strong>
            Capin No :</strong> 506
        <br><br>
        <strong>
            Seat No :</strong> 23
        <br><br>
        <strong>
            Amount :</strong> 1000 SDG
        <br><br>
        <strong>
            Customer :</strong> Manal Mohamed
        <br><br> 
	      ';  
	    // $content .= '</table>';  
	    $pdf->writeHTML($content);  
        ob_end_clean();
	    $pdf->Output('Ticket Info.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Need Ticket ID to provide Ticket info print';
		header('location: viewTicketDetails.php');
	}
?>