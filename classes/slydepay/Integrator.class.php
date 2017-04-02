<?php

/*

 */

/**
 * Description of Slydepay-php-Connector
 *
 * @author joseph kodjo-kuma Djomeda
 *
 */
class SlydepayConnector {

    private $slyde;

    function __construct($settings) {
		
		$ns = $settings["api.slydepay.namespace"];
		$wsdl = $settings["api.slydepay.wsdl"];
		$api_version = $settings["api.slydepay.version"];
		$merchant_email = $settings["api.slydepay.merchantEmail"];
		$merchant_secret_key = $settings["api.slydepay.merchantKey"];
		$service_type = $settings["api.slydepay.serviceType"];
		$integration_mode = $settings["api.slydepay.integrationmode"];

        // uncomment this if you are using a webproxy, fiddler or charlesproxy to see headers. Again this was usefull in develpment environment where I can connect to
        //Slydepay test server without any SSL certificate. On Live, with SSL ON, this is pretty much useless
        $proxySettings = array(

//            "trace" => 1,
//            "proxy_host" => "localhost",
//            "proxy_port" => 8888,
            );

        $this->slyde = new SoapClient($wsdl, $proxySettings);
        $this->buildHeader($ns, $api_version, $merchant_email, $merchant_secret_key, $service_type, $integration_mode);
    }

    /**
     * @param $ns
     * @param $api_version
     * @param $merchant_email
     * @param $merchant_secret_key
     * @param $service_type
     * @param $integration_mode
     */
    function buildHeader($ns, $api_version, $merchant_email, $merchant_secret_key, $service_type, $integration_mode) {
        $slydepayHeaders = array(
            "APIVersion" => $api_version,
            "MerchantEmail" => $merchant_email,
            "MerchantKey" => $merchant_secret_key,
            "SvcType" => $service_type,
            "UseIntMode" => $integration_mode
        );

        $headers = new SoapHeader($ns, "PaymentHeader", $slydepayHeaders);

        $this->slyde->__setSoapHeaders($headers);
    }


    /**
     * @param $pay_token
     * @param $transaction_id
     * @return mixed
     */
    function ConfirmTransaction($pay_token, $transaction_id) {

        try {

            $params = array(
                'payToken' => $pay_token,
                'transactionId' => $transaction_id,
            );
            $return = $this->slyde->ConfirmTransaction($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }

    /**
     * @param $pay_token
     * @param $transaction_id
     * @return mixed
     */
    function CancelTransaction($pay_token, $transaction_id) {

        try {

            $params = array(
                'payToken' => $pay_token,
                'transactionId' => $transaction_id,
            );
            $return = $this->slyde->CancelTransaction($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }

    /**
     * @param $amount
     * @param $cust_ref
     * @param $comment1
     * @param $comment2
     * @param $unit_price
     * @param $quantity
     * @param $item
     * @param $use_token
     * @param $use_int_mode
     * @return mixed
     */
    function ProcessOrder($amount, $cust_ref, $comment1, $comment2, $unit_price, $quantity, $item, $use_token, $use_int_mode) {

        try {

            $params = array(
                'amount' => $amount,
                'custRef' => $cust_ref,
                'comment1' => $comment1,
                'comment2' => $comment2,
                'unitPrice' => $unit_price,
                'quantity' => $quantity,
                'item' => $item,
                'useToken' => $use_token,
                'useIntMode' => $use_int_mode,
            );
            $return = $this->slyde->ProcessOrder($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $order_id
     * @param $amount
     * @param $comment1
     * @param $comment2
     * @param array $order_items
     * @return mixed
     */
    function ProcessPaymentJSON($order_id, $amount, $comment1, $comment2, array $order_items) {
        try {

            $params = array(
                'orderId' => $order_id,
                'amount' => $amount,
                'comment1' => $comment1,
                'comment2' => $comment2,
                'orderItems' => $order_items,
            );
            $return = $this->slyde->ProcessPaymentJSON($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $order_id
     * @param $provider_name
     * @param $provider_type
     * @return mixed
     */
    function CheckPaymentStatus($order_id, $provider_name, $provider_type) {


        try {
 
            $params = array(
                'orderId' => $order_id,
                'providerName' => $provider_name,
                'providerType' => $provider_type,
            );
            $return = $this->slyde->checkPaymentStatus($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $order_id
     * @param $sub_total
     * @param $shipping_cost
     * @param $tax_amount
     * @param $total
     * @param $comment1
     * @param $comment2
     * @param array $order_items
     * @return mixed
     */
    function ProcessPaymentOrder($order_id, $sub_total, $shipping_cost, $tax_amount, $total, $comment1, $comment2, array $order_items) {

        try {

            $params = array(
                'orderId' => $order_id,
                'subtotal' => $sub_total,
                'shippingCost' => $shipping_cost,
                'taxAmount' => $tax_amount,
                'total' => $total,
                'comment1' => $comment1,
                'comment2' => $comment2,
                'orderItems' => $order_items,
            );
            $return = $this->slyde->ProcessPaymentOrder($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $order_id
     * @param $sub_total
     * @param $shipping_cost
     * @param $tax_amount
     * @param $total
     * @param $comment1
     * @param $comment2
     * @param array $order_items
     * @param $payer_name
     * @param $payer_mobile
     * @param $provider_name
     * @param $provider_type
     * @return mixed
     */
    function GeneratePaymentCode($order_id, $sub_total, $shipping_cost, $tax_amount, $total, $comment1, $comment2, Array $order_items, $payer_name, $payer_mobile, $provider_name, $provider_type) {

        try {

            $params = array(
                'orderId' => $order_id,
                'subtotal' => $sub_total,
                'shippingCost' => $shipping_cost,
                'taxAmount' => $tax_amount,
                'total' => $total,
                'comment1' => $comment1,
                'comment2' => $comment2,
                'orderItems' => $order_items,
                'payerName' => $payer_name,
                'payerMobile' => $payer_mobile,
                'providerName' => $provider_name,
                'providerType' => $provider_type,
            );
            $return = $this->slyde->generatePaymentCode($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }

    /**
     * @param $order_id
     * @param $sub_total
     * @param $shipping_cost
     * @param $tax_amount
     * @param $total
     * @param $comment1
     * @param $comment2
     * @param array $order_items
     * @return mixed
     */
    function MobilePaymentOrder($order_id, $sub_total, $shipping_cost, $tax_amount, $total, $comment1, $comment2, Array $order_items) {

        try {

            $params = array(
                'orderId' => $order_id,
                'subtotal' => $sub_total,
                'shippingCost' => $shipping_cost,
                'taxAmount' => $tax_amount,
                'total' => $total,
                'comment1' => $comment1,
                'comment2' => $comment2,
                'orderItems' => $order_items,
            );
            $return = $this->slyde->mobilePaymentOrder($params);
            return $return;

        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $order_id
     * @return mixed
     */
    function VerifyMobilePayment($order_id) {


        try {
              $params = array(
                'orderId' => $order_id,
            );
            $return = $this->slyde->verifyMobilePayment($params);
            return $return;
        } catch (Exception $e) {
            echo "Exception occured: " . $e;
        }
    }


    /**
     * @param $item_code
     * @param $item_name
     * @param $unit_price
     * @param $quantity
     * @param $sub_total
     * @return stdClass
     */
    function buildOrderItem($item_code, $item_name, $unit_price, $quantity, $sub_total) {
        $order = new stdClass();
        $order->ItemCode = $item_code;
        $order->ItemName = $item_name;
        $order->UnitPrice = $unit_price;
        $order->Quantity = $quantity;
        $order->SubTotal = $sub_total;
        
        return $order;
    }

}
