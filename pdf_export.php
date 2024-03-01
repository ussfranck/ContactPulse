<?php 
  require("./fpdf185/fpdf.php");
  $contacts = json_decode(file_get_contents('/data/usr_data.json'), true);
  
  // Init classe services
  $myPdf = new FPDF();
  $myPdf->AddPage();

  // Title Document
  $myPdf->SetFont("Arial", 'B', 16);
  $myPdf->Cell(40, 10, 'Liste des Contacts');

  // Append Contact 
  $myPdf->SetFont('Arial', '', 12);
  foreach ($contacts as $contact) {
      $myPdf->Ln();
      $myPdf->Cell(40, 10, "Name: {$contact['surname']} {$contact['name']}");
      $myPdf->Cell(40, 10, "Email: {$contact['email']}");
      $myPdf->Cell(40, 10, "Phone: {$contact['phone']}");
      $myPdf->Cell(40, 10, "Birth Date: {$contact['birth']}");
  }
  // HTTP Headers -> download Pdf File
  header('Content-Type: application/pdf');
  header('Content-Disposition: attachment; filename="contacts.pdf"');
  $myPdf->Output();
?>