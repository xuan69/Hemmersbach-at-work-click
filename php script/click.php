<?php

// Leave the qoutes and replace with your https://mystatus.hemmersbach.com custom link
$link = “REPLACE_THIS_TEXT_WITH_YOUR_LINK”;

$queryString = parse_url($link, PHP_URL_QUERY);

// Parse the query string to get individual parameters
parse_str($queryString, $params);

if (!isset($params[‘token’])) {
header(“Location: error.php”);
exit();
} else {
$token = $params[‘token’];

$form_data = array(
‘token’ => $token,
‘action’ => ‘Login’,
‘attendanceCheck’ => ‘0’
);

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
CURLOPT_URL => $link,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => http_build_query($form_data)
));

// Execute cURL request
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
echo ‘Error: ‘ . curl_error($curl);
} else {
//Done
exit();

}
// Close cURL session
curl_close($curl);
}

?>
