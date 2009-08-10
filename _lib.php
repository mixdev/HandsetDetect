<?php

/**********************************************************************
*  Author: Arun Vijayan (arunvijayan[]gmail.com)
*  Web...: http://www.webforth.com/handsetdetect
*  Name..: HandSetDetect
*  Desc..: Handset Detection API client.
*
*/

class HandsetDetect{

	var $apikey;
	var $hd_server;

	function __construct($apikey, $hd_server)
		{
		  $this->apikey = $apikey;
		  $this->hd_server = $hd_server;
		}

	// Using JSON. You can use XML also if you want.
	function sendjson($data, $url) {
		
		$data['apikey'] = $this->apikey;
		$tmp	= json_encode($data);	
		$ch		= curl_init($url);	
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $tmp);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 	
		$reply = curl_exec($ch);
		$ch = null;
		return json_decode($reply, true);
	}

	// Detect the handset device
	function DetectDevice(){

			$data = array();
			$data['User-Agent'] = $_SERVER['HTTP_USER_AGENT'];
			$data['ipaddress']	= $_SERVER['REMOTE_ADDR'];
			$data['options']	= "geoip, product_info, display";
			$data = array_merge ($data, $_SERVER);

			print_r( $data);
			return $this->sendjson($data, $this->hd_server."/devices/detect.json");
		}

	// Fetch a list of vendors
	function GetVendorList() {

			$data = array();
			return $this->sendjson($data, $this->hd_server."/devices/vendors.json");	
		}

	// Fetch a list of all models for a given vendor
	function GetDeviceModels($vendor) {
		$data = array();	
		$data['vendor'] = $vendor;
		return $this->sendjson($data, $this->hd_server."/devices/models.json");
	}



}// end HandsetDetect class


?>