<?php 
session_start();
include 'conn.php';
use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\StoreProc as StoreProc;
$error = '';
$_SESSION['error'] = $error;
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $storeProc = new StoreProc($pdo);
    // echo $result;
    
} catch (\PDOException $e) {
    echo $e->getMessage();
  	exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['ADD_SUPPLIER'])){
		// SAve the Supplier
		$supplier_name = $_POST['supplier_name'];
		$supplier_mobile = $_POST['supplier_mobile'];
		if(isset($supplier_name) and $supplier_name != '' and isset($supplier_mobile) and $supplier_mobile != ''){
			// insert the record and reload the page
			var_dump($supplier_mobile);
			// exit();

			try {
			    $result = $storeProc->insert_suppliers($supplier_name,$supplier_mobile);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Inserted successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['UPDATE_SUPPLIER'])){
		$supplier_id = $_POST['supplier_id'];
		$supplier_name = $_POST['supplier_name'];
		$supplier_mobile = $_POST['supplier_mobile'];
		if(isset($supplier_name) and $supplier_name != '' and isset($supplier_mobile) and $supplier_mobile != ''){
			try {

			    $result = $storeProc->update_suppliers($supplier_id,$supplier_name,$supplier_mobile);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Updated successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['ADD_INGREDIENTS'])){
		$ingredients_name=$_POST['ingredients_name'];
		$ingredients_quantity =$_POST['ingredients_quantity'];
		$ingredients_price =$_POST['ingredients_price'];
		$ingredients_location =$_POST['ingredients_location'];

		if(isset($ingredients_name) and $ingredients_name != '' and isset($ingredients_quantity) and $ingredients_quantity != '' and isset($ingredients_price) and $ingredients_price != '' and isset($ingredients_location) and $ingredients_location != ''){
			// insert the record and reload the page
			
			try {
			    $result = $storeProc->insert_ingredients($ingredients_name,$ingredients_quantity,$ingredients_price,$ingredients_location);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Inserted successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['UPDATE_INGREDIENTS'])){
		$ingredients_id = $_POST['ingredients_id'];
		$ingredients_name=$_POST['ingredients_name'];
		$ingredients_quantity =$_POST['ingredients_quantity'];
		$ingredients_price =$_POST['ingredients_price'];
		$ingredients_location =$_POST['ingredients_location'];
		if(isset($ingredients_name) and $ingredients_name != '' and isset($ingredients_quantity) and $ingredients_quantity != '' and isset($ingredients_price) and $ingredients_price != '' and isset($ingredients_location) and $ingredients_location != ''){
			// insert the record and reload the page
			
			try {

			    $result = $storeProc->update_ingredients($ingredients_id,$ingredients_name,$ingredients_quantity,$ingredients_price,$ingredients_location);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Updated successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['ADD_PIZZA'])){
		// SAve the Supplier
		$pizza_name=$_POST['pizza_name'];
		$pizza_size =$_POST['pizza_size'];
		$pizza_price =$_POST['pizza_price'];
		$pizza_description =$_POST['pizza_description'];

		if(isset($pizza_name) and $pizza_name != '' and isset($pizza_size) and $pizza_size != '' and isset($pizza_price) and $pizza_price != '' and isset($pizza_description) and $pizza_description != ''){
			// insert the record and reload the page
			
			try {
			    $result = $storeProc->insert_pizza($pizza_name,$pizza_size,$pizza_price,$pizza_description);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Inserted successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['UPDATE_PIZZA'])){
		$pizza_id = $_POST['pizza_id'];
		$pizza_name=$_POST['pizza_name'];
		$pizza_size =$_POST['pizza_size'];
		$pizza_price =$_POST['pizza_price'];
		$pizza_description =$_POST['pizza_description'];
		if(isset($pizza_name) and $pizza_name != '' and isset($pizza_size) and $pizza_size != '' and isset($pizza_price) and $pizza_price != '' and isset($pizza_description) and $pizza_description != ''){
			// insert the record and reload the page
			try {

			    $result = $storeProc->update_pizza($pizza_id,$pizza_name,$pizza_size,$pizza_price,$pizza_description);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Updated successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['CHECKOUT'])){
		$pizza_id = $_POST['pizza_id'];
		$order_quantity = $_POST['order_quantity'];
		$order_price = $_POST['order_price'];
		$order_activity = date("D M d, Y G:i");
		$have_ingredient = 0;
		if(isset($_POST['order_ingredient']) and count($_POST['order_ingredient']) > 0){
			$have_ingredient = 1;
		}
		// var_dump($order_activity);die();
		if(isset($pizza_id) and $pizza_id != '' and isset($order_quantity) and $order_quantity != '' and isset($order_price) and $order_price != ''){
			// insert the record and reload the page
			try {

			    $order_id = $storeProc->insert_order($pizza_id,$order_quantity,$order_price,$order_activity,'P',$have_ingredient);
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
	   	    if($have_ingredient and $order_id){
		   	  	  foreach ($_POST['order_ingredient'] as $key => $value) {
			   	  		$value = (int)$value;
			   	  		# code...
			   	  		try {

						    $storeProc->add_order_ingredient($order_id,$value);
						    $result = $storeProc->decrement_stock($value);
						    // echo $result;
						    
						} catch (\PDOException $e) {
						    echo $e->getMessage();
					      	exit();
						}
		   	  	  }
	   	    }
	        $_SESSION['success'] = "Thank you! Order Placed successfully.\n";
	        header("Location: purchases.php");
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['ASSIGN_SUPPLIER'])){
		$order_id = $_POST['order_id'];
		$supplier_id=$_POST['supplier_id'];
		if(isset($order_id) and $order_id != '' and isset($supplier_id) and $supplier_id != '' ){
			// insert the record and reload the page
			
			$sql ="UPDATE orders set supplier_id = '".$supplier_id."',status='S' where ID=".$order_id;

			   $ret = pg_query($db, $sql);
			   if(!$ret) {
			      echo pg_last_error($db);
			      exit();
			   } else {
			      $_SESSION['success'] = "Records Updated successfully\n";
			   }
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['ORDER_COMPLETE'])){
		$order_id = $_POST['order_id'];
		if(isset($order_id) and $order_id != '' ){
		  	try {

			    $storeProc->update_order($order_id,'C');
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Updated successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	elseif(isset($_POST['ORDER_CANCEL'])){
		$order_id = $_POST['order_id'];
		if(isset($order_id) and $order_id != '' ){
			// insert the record and reload the page
			$sql1 = "SELECT i.id from ingredients i left join order_ingredient oi on oi.ingredient_id = i.id where order_id = $order_id";
			$order_ingredients = pg_query($db, $sql1);
			if(!$order_ingredients) {
		      echo pg_last_error($db);
		      exit();
		   	}
		   	// update quantity on cancelation of order bacause ingredient is not used.
			while($order_ingredient = pg_fetch_row($order_ingredients)){
				$value = (int)$order_ingredient[0];
	   	  		# code...
	   	  		try {

				    $result = $storeProc->increment_stock($value);
				    // echo $result;
				    
				} catch (\PDOException $e) {
				    echo $e->getMessage();
			      	exit();
				}
			}
			try {

			    $storeProc->update_order($order_id,'D');
			    // echo $result;
			    
			} catch (\PDOException $e) {
			    echo $e->getMessage();
		      	exit();
			}
		    $_SESSION['success'] = "Records Updated successfully\n";
   
		}
		else{
			$error = 'Please Fill the form!!';
		}
	}
	else{
		$error = 'undetermined request!!';
	}
}
$_SESSION['error'] = $error;

// redirect
// var_dump($_SERVER);
header("Location: ".$_SERVER['HTTP_REFERER']);

