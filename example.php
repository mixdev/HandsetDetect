<?php

// Use your own API Key from http://handsetdetection.com
define('APIKEY','00000000000000000000000000000000');

define('HD_SERVER','http://api-us1.handsetdetection.com');

include("_lib.php");

$hd = new HandsetDetect(APIKEY,HD_SERVER);

// Detect the current device accessing the page. 
print_r($hd->DetectDevice());

// Get the complete list of supported vendors
print_r($hd->GetVendorList());

// Get the complete list of handsets from a vendor
print_r($hd->GetDeviceModels("Apple"));


?>