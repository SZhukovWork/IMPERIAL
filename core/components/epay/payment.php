<?php
define('MODX_API_MODE', true);
require $_SERVER['DOCUMENT_ROOT'].'/index.php';

$params = [
    'grant_type' => 'client_credentials',
    'scope' => 'webapi usermanagement email_send verification statement statistics payment',
    'client_id' => $modx->getOption('epay_client_id'),
    'client_secret' => $modx->getOption('epay_client_secret'),
    'invoiceID' => $_GET['invoiceId'],
    'amount' => $_GET['amount'],
    'currency' => 'KZT',
    'terminal' => $modx->getOption('epay_terminal_id'),
    'postLink' => 'https://'.$_SERVER['HTTP_HOST'].'/core/components/epay/succsess.php',
    'failurePostLink' => 'https://'.$_SERVER['HTTP_HOST'].'/core/components/epay/error.php'
];


$debug = $modx->getOption('epay_debug');

$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => $debug == 1 ? 'https://testoauth.homebank.kz/epay2/oauth2/token' : 'https://epay-oauth.homebank.kz/oauth2/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($params)
));
$response = curl_exec($myCurl);
curl_close($myCurl);

header('Content-type: application/json');
echo $response;

?>