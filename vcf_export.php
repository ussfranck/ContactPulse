<?php 
  $contacts = json_decode(file_get_contents('/data/usr_data.json'), true);
  print "<script>console.info('/data/usr_data.json')</script>";
  // vcf sytem content
  $vcfContent = "";
  if ($contacts.lenght !== 0) print "<script>console.info('Contact')</script>";
  foreach ($contacts as $contact) {
    $vcfContent .= "BEGIN:VCARD\n";
    $vcfContent .= "VERSION:3.0\n";
    $vcfContent .= "FN:{$contact['name']} {$contact['surname']}\n";
    $vcfContent .= "TEL:{$contact['phone']}\n";
    $vcfContent .= "EMAIL:{$contact['email']}\n";
    $vcfContent .= "BDAY:{$contact['birth']}\n";
    $vcfContent .= "END:VCARD\n";
  }
  // HTTP Headers -> download VCF File
  header('Content-Type: text/vcard');
  header('Content-Disposition: attachment; filename="contact.vcf"');

  print $vcfContent;
?>