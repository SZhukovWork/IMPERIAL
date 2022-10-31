<?php
define('MODX_API_MODE', true);
require $_SERVER['DOCUMENT_ROOT'].'/index.php';

// Включаем обработку ошибок
$modx->getService('error','error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$miniShop2 = $modx->getService('miniShop2');

$response = json_decode(file_get_contents('php://input'), true);

// file_put_contents('test.txt', file_get_contents('php://input'));

if ($response['code'] == 'ok') {
    // $orderID = substr($response['invoiceId'], 8, 2);
    $orderID = str_replace(date('jnY'), '', $response['invoiceId']);

    $miniShop2->changeOrderStatus($orderID, 2);
}

?>