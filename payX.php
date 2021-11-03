
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
                     <input type="text" name="customer name" id="custname" placeholder="Customer name" required="required">
                 </td>
            </tr>
            <tr>
                 <td>
                     Contact:
                 </td>
                 <td>
                     <input type="number" name="customer contact" id="custcontact" placeholder="Customer contact" required="required">
                 </td>
            </tr>
            <tr>
                 <td>
                     Email:
                 </td>
                 <td>
                     <input type="email" name="customer email" id="custemail" placeholder="Customer Email" required="required">
                 </td>
            </tr>
            <tr>
                 <td>
                     Amount:
                 </td>
                 <td>
                     <input type="number" name="customer_amount" id="custamt" placeholder="Amount" required="required">
                 </td>
            </tr>
            <tr>
                 <td>
                 <input type="submit" name="submit" value="Pay Now" id="rzp-button1" >
                 </td>
                
            </tr>
</form>
       </table>
    </body>
</html>

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
$amount = $_POST['customer_amount'];

$orderData = [
    'receipt'         => 3456,
   // 'amount'          => $amount  * 100, // 2000 rupees in paise
    'amount'          => '100', // 2000 rupees in paise

    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
print_r($orderData);
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];
//print_r($razorpayOrderId );echo "orderid";
$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];
$checkout = 'Manual';
// $data = [
//      "key"               => $keyId,
//      "amount"            => $amount,
//      "name"              => "DJ Tiesto",
//      "description"       => "Tron Legacy",
//      "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
//      "prefill"           => [
//      "name"              => "Daft Punk",
//      "email"             => "customer@merchant.com",
//      "contact"           => "9999999999",
//      ],
//      "notes"             => [
//      "address"           => "Hello World",
//      "merchant_order_id" => "12312321",
//      ],
//      "readonly"          => [
//          "email"             => true,
//          "contact"           => true,
//          ],
//      "theme"             => [
//      "color"             => "#F37254"
//      ],
//      "order_id"          => $razorpayOrderId,
//  ];

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
    "readonly"          => [
    "email"             => true,
    "contact"           => true,
    ],
    "theme"             => [
             "color"             => "#F37254"
             ],
    "order_id"          => $razorpayOrderId,
];

$json = json_encode($data);
//print_r($json); die('hi brop');
require("checkout/{$checkout}.php");
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var rzp = new Razorpay(options);

document.getElementById('rzp-button11').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>