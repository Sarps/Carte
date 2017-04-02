<?php


/**
 * Description of dblayer
 *
 * @author Joseph Kodjo-Kuma Djomeda
 */
 
 require_once 'classes/activerecord/ActiveRecord.php';

date_default_timezone_set('Africa/Accra');

class DBSlydeLayer {
    //put your code here
    
    function __construct(array $options) {
        $username = $options['username'];
        $password = $options['password'] ? ':'.$options['password'] : '';
        $host = $options['host'];
        $database = $options['database'];
        
		$cfg = ActiveRecord\Config::instance();
		$cfg->set_model_directory('classes/tables');
		$cfg->set_connections(array(
			'development' => "mysql://{$username}{$password}@{$host}/{$database}"
		));
    }
    
    
    public function setFixtures(){
        $this->db->exec("insert into categories(id,name,description) values(1,'food','all sort of comestible item'),(2,'ninja tools','any sort of tool according to konoha classifications')");
        $this->db->exec("insert into products(id,category_id,product_id,name,price,in_stock, description) values(1,1,'ra_0001','ramen',30,20,''),(2,2,'we_0001','shuriken',120,100,''),(3,2,'we_0002','kunai',62,95,'')");
    }
    
    
    public function tearDown(){
		Product::all() -> delete();
		Order::all() -> delete();
        Vendor::all() -> delete();
    } 
    
    
    public function createOrder($orderId, $paymentToken, array $productIdList){
        //$this->db->beginTransaction();
        $order = new Order(array(
			'order_id' => $orderId,
			'payment_token' => $paymentToken,
			'date_created' => date('Y-m-d H:i:s')
			));
        $order -> save();
        
        //$order_product_map_query = $this->orderProductMapQueryBuilder($orderId, $productIdList);
        
        //$stmt2 = $this->db->prepare("insert into order_product_map values $order_product_map_query");
        //$stmt2->execute();
        //$this->db->commit();
        
    }
    
    public function updateOrder($orderId, $paymentTransactionId, $paymentStatus){
	   $order = Order::find_by_order_id($orderId);
	   $order -> order_status = $paymentStatus;
	   $order -> date_modified = date('Y-m-d H:i:s');
	   $order -> transaction_id = $paymentTransactionId;
       $order -> save();
    }

    
    private function orderProductMapQueryBuilder($orderId, $productIdList){
        $queryPartString = "";
        foreach ($productIdList as $productId) {
            $queryPartString .= "('$orderId','$productId'),"; 
        }
        
        if(!empty($queryPartString)){
            $queryPartString = rtrim($queryPartString,",");
        }
        
        return $queryPartString;
    }
    
    public function ValidateTransaction($paymentToken){ 
		$order = Order::find_by_payment_token_and_order_status($paymentToken, "PENDING");
		return $order -> order_id;
    }
	
	public function grandTotal(array $arrayOfOrderItems){
        $subTotal =0;
        foreach ($arrayOfOrderItems as $item) {
            $subTotal += $item->SubTotal;
        }
        return $subTotal;
    }
	
	public function signup($post) {
		
	}
	
	public function login($post) {
		$name =  $post ['name'];
		$email = $post['email'];
		$password = md5 ($post ['password']);
	}
	
}

?>