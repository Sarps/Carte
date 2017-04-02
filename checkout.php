<?php
   
    include_once './classes/DBSlydeBridge.class.php';
    include_once './classes/slydepay/Integrator.class.php';
        
    $settings= parse_ini_file("config/local.ini");
    $bridge = new DBSlydeLayer($settings);
    $slydepayIntegrator = new SlydepayConnector($settings);
    $productIds = explode(',', $_POST["orderItems"]);
	$products = array (
		array(
			'product_id' => 0,
			'name' => 'Rice',
			'price' => 4
		), 
		array(
			'product_id' => 1,
			'name' => 'Salad',
			'price' => 1
		), 
		array(
			'product_id' => 2,
			'name' => 'Fish',
			'price' => 2
		), 
		array(
			'product_id' => 3,
			'name' => 'Chicken',
			'price' => 2
		)
	);
    
    $arrayOfOrderItems = array();
    foreach ($productIds as $productId) {
		$item = $products[$productId];
		$quantity = 1;
        $arrayOfOrderItems[] = $slydepayIntegrator->buildOrderItem($item['product_id'], $item['name'], $item['price'], $quantity, $item['price']*$quantity);
    }
    processSlydepayOrder($productIds, $arrayOfOrderItems);
    
    
    function processSlydepayOrder(array $productIds, array $arrayOfOrderItems){
        $orderId = GUID();
        global $settings, $slydepayIntegrator, $bridge;
        
        $grandSubTotal = $bridge->grandTotal($arrayOfOrderItems);
        $flatShippingCost = $grandSubTotal * $settings["shippingcost"] / 100;
        $tax = $settings["taxes"];
        $taxAmount = $grandSubTotal* $tax/100;
        $total = $grandSubTotal+$taxAmount+$flatShippingCost;
        $token = $slydepayIntegrator->ProcessPaymentOrder($orderId, $grandSubTotal, $flatShippingCost, $taxAmount, $total, "cart orders", "", $arrayOfOrderItems);
        $checkpart = explode(" ",$token->ProcessPaymentOrderResult);
        if(sizeof($checkpart) == 1){
           $bridge->createOrder($orderId, $token->ProcessPaymentOrderResult, $productIds);
           $redirectUrl = $settings["api.slydepay.redirecturl"].$token->ProcessPaymentOrderResult;
           echo $redirectUrl;
           header("Location: $redirectUrl");
        } else {
			header("Location: index2.php");
        }
    }
    
    
    function GUID(){
        if (function_exists('com_create_guid') === true) {
                return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

?>