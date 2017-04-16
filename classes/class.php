<?php

class ShoppingCart implements Iterator{
	
	//properties 
	//associative array that holds isbn and quantity
	$items = array($isbn => $quantity);
	
	//add to cart method
	public function add_to_cart($isbn, $quantity){
		$items[$isbn] = $quantity;
	}
	
	// Iterator methods
	public function valid(){
		$key = key($this->items);
		$var = ($key !== NULL && $key !== FALSE);
		return $var;
	}
	
	public function next(){
		$var = next($this->items);
		return $var;
	}
	
	public function key(){
		$var = key($this->items);
		return $var;
	}
	
	public function current(){
		$var = current($this->items);
		return $var;
	}
	
	public function rewind(){
		reset($this->items);
	}
	
}

//customer class
class Customer{
	
	//properties
	
	//customer id
	public $customer_id;
	
	//customer name
	public $customer_name;
	
	//database
	protected $database;
	
	//constructor
	function __construct($customer_id, $database){
		
		$this->customer_id = $customer_id;
		$this->database = $database;
		
		$sql = file_get_contents('sql/getCustomer.sql');
		$params = array(
			'customerid' => $customer_id
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$customers = $statement->fetchAll(PDO::FETCH_ASSOC);
			
		$customer = $customers[0];
		$this->customer_name = $customer['name'];
	}
}

?>