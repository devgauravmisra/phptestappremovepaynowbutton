<html>
    <head>
        <title>Custom PHP TEST APP</title>
    </head>
    <body>
        <h2>How to remove default pay now button</h2>
        <table>
            <form method="post" action="">
            <tr>
                 <td>
                     Name:
                 </td>
                 <td>
                     <input type="text" name="customer name" id="custname" placeholder="Customer name">
                 </td>
            </tr>
            <tr>
                 <td>
                     Contact:
                 </td>
                 <td>
                     <input type="number" name="customer contact" id="custcontact" placeholder="Customer contact">
                 </td>
            </tr>
            <tr>
                 <td>
                     Email:
                 </td>
                 <td>
                     <input type="email" name="customer email" id="custemail" placeholder="Customer Email">
                 </td>
            </tr>
            <tr>
                 <td>
                     Amount:
                 </td>
                 <td>
                     <input type="number" name="customer amount" id="custamt" placeholder="Amount">
                 </td>
            </tr>
            <tr>
                 <td>
                 <input type="submit" name="submit" value="Pay Now" >
                 </td>
                
            </tr>
</form>
       </table>
    </body>
</html>

<?php

<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => 1 * 100, // 2000 rupees in paise
    'currency'        => 'USD',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];



$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "DJ Tiesto",
    "description"       => "Tron Legacy",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => "customer@merchant.com",
    "contact"           => "9999999999",
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];



$json = json_encode($data);

require("checkout/{$checkout}.php");

?>