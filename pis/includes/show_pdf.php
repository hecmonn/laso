<?php
$file = "files/vendor_handbook.pdf";
$filename = "vendor_handbook.pdf";
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename .'"');
header('Accept-Ranges: bytes');
@readfile($file);
?>