<?php
/*
Paso 1
Obtener 2 usuarios (Vendedor y comprador)
curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-35XXXXXXXX" -d '{"site_id":"MLA"}'

Vendedor
{"id":553945164,"nickname":"TETE1776398","password":"qatest1045","site_status":"active","email":"test_user_19001752@testuser.com"}
https://www.mercadopago.com/mla/account/credentials?type=basic
Client id:7641350439558593
Client secret:FXQllFoQwDcySoWoU5daMeQr2shevtf8


Comprador
{"id":553947920,"nickname":"TESTH1XAFUT5","password":"qatest4806","site_status":"active","email":"test_user_98483767@testuser.com"}

*/
require ('vendor/autoload.php');

// MercadoPago\SDK::setAccessToken("TEST_ACCESS_TOKEN"); // On Sandbox
// MercadoPago\MercadoPagoSdk::initialize(); 
// $config = MercadoPago\MercadoPagoSdk::config();

$_clientId = "7641350439558593";
$_secretId = "FXQllFoQwDcySoWoU5daMeQr2shevtf8";
MercadoPago\SDK::setClientId($_clientId);
MercadoPago\SDK::setClientSecret($_secretId);

$email="mi_cliente@hotmail.com";

$preference = new MercadoPago\Preference();
  
# Building an item

$item = new MercadoPago\Item();
$item->id               = "639045";
$item->title            = "Celular Libre Samsung A10S Negro"; 
$item->quantity         = 1;
$item->unit_price       = 15.999;

$preference->items = [$item];

//Datos del Usuario 

$payer = new MercadoPago\Payer();
$payer->email = $email;
# Return the HTML code for button
$preference->back_urls = array(
                "success" => "https://mymptest.herokuapp.com/success.php",
                "failure" => "https://mymptest.herokuapp.com/failure.php",
                "pending" => "https://mymptest.herokuapp.com/pending.php"
            );
$preference->auto_return = "approved";
$preference->payer = $payer;

$preference->save(); # Save the preference and send the HTTP Request to create
echo "<a href='$preference->sandbox_init_point' > Comprar ahora  </a>";

?>