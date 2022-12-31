<?php
require_once('tcpdf.php');
$pdf = new TCPDF_FONTS();
$fontname = $pdf->addTTFfont('DroidSansFallbackFull.ttf', 'TrueTypeUnicode');
var_dump($fontname);
?>