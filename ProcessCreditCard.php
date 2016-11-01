<?php 
 
$post_body = http_build_query(array(
'UserName'   => 'username_API',      //your username_API goes here. 
'Password'   => 'yourpassword',      //Your password from your payleap account 
'TransType'  => 'Auth',
'CardNum'    => '4111111111111111',  //Credit Card Number
'ExpDate'    => '1222',              //Must Be Future Date
'NameOnCard' => 'Smith',
'Amount'     => 10.00,
'CVNum'      =>'789',
'Zip'        => '12345',
'PNRef'      => '',                  //Sending the PNRef name pair is required.
));

/* See http://payleap.com/pdf/PayLeap-API-Guide-v2-3.pdf#page=17 for all required fields */
 
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,'https://uat.payleap.com/transactservices.svc/ProcessCreditCard');
curl_setopt($curl, CURLOPT_POST, true);               // Use POST
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);   // Setup post body
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);        // Receive server response
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    // Receive server response
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
// Execute request and read response
$data = curl_exec($curl);
 
if(curl_error($curl))
{
 echo 'Error: ' . curl_error($curl);
 exit ;
}
else 
{
	$xml = simplexml_load_string($data);
	echo "<pre>";
	print_r($xml);
 
} 
curl_close($curl);
exit ;
