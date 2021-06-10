<?php

namespace PostgreSQLTutorial;

/**
 * Represent the Connection
 */
class StoreProc {
	public $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}
	public function insert_suppliers($supplier_name,$supplier_mobile) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.insert_suppliers(?,?);');
        $stmt->bindValue(1, $supplier_name, \PDO::PARAM_STR );
        $stmt->bindValue(2, $supplier_mobile, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
	public function update_suppliers($supplier_id,$supplier_name,$supplier_mobile) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.update_suppliers(?,?,?);');
        $stmt->bindValue(1, $supplier_id, \PDO::PARAM_INT );
        $stmt->bindValue(2, $supplier_name, \PDO::PARAM_STR );
        $stmt->bindValue(3, $supplier_mobile, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
	public function insert_ingredients($ingredients_name,$ingredients_quantity,$ingredients_price,$ingredients_location) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.insert_ingredients(?,?,?,?);');
        $stmt->bindValue(1, $ingredients_name, \PDO::PARAM_STR );
        $stmt->bindValue(2, $ingredients_quantity, \PDO::PARAM_STR );
        $stmt->bindValue(3, $ingredients_price, \PDO::PARAM_STR );
        $stmt->bindValue(4, $ingredients_location, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    public function update_ingredients($ingredients_id,$ingredients_name,$ingredients_quantity,$ingredients_price,$ingredients_location) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.update_ingredients(?,?,?,?,?);');
        $stmt->bindValue(1, $ingredients_id, \PDO::PARAM_INT );
        $stmt->bindValue(2, $ingredients_name, \PDO::PARAM_STR );
        $stmt->bindValue(3, $ingredients_quantity, \PDO::PARAM_STR );
        $stmt->bindValue(4, $ingredients_price, \PDO::PARAM_STR );
        $stmt->bindValue(5, $ingredients_location, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
	public function insert_pizza($pizza_name,$pizza_size,$pizza_price,$pizza_description) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.insert_pizza(?,?,?,?);');
        $stmt->bindValue(1, $pizza_name, \PDO::PARAM_STR );
        $stmt->bindValue(2, $pizza_size, \PDO::PARAM_STR );
        $stmt->bindValue(3, $pizza_price, \PDO::PARAM_STR );
        $stmt->bindValue(4, $pizza_description, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

	public function update_pizza($pizza_id,$pizza_name,$pizza_size,$pizza_price,$pizza_description) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.update_pizza(?,?,?,?,?);');
        $stmt->bindValue(1, $pizza_id, \PDO::PARAM_INT);
        $stmt->bindValue(2, $pizza_name, \PDO::PARAM_STR );
        $stmt->bindValue(3, $pizza_size, \PDO::PARAM_STR );
        $stmt->bindValue(4, $pizza_price, \PDO::PARAM_STR );
        $stmt->bindValue(5, $pizza_description, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }


    public function insert_order($pizza_id,$order_quantity,$order_price,$order_activity,$order_status,$have_ingredients) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('SELECT public.insert_order_id(?,?,?,?,?,?);');
        $stmt->bindValue(1, $pizza_id, \PDO::PARAM_INT );
        $stmt->bindValue(2, $order_quantity, \PDO::PARAM_INT );
        $stmt->bindValue(3, $order_price, \PDO::PARAM_INT );
        $stmt->bindValue(4, $order_activity, \PDO::PARAM_STR);
        $stmt->bindValue(5, $order_status, \PDO::PARAM_STR );
        $stmt->bindValue(6, $have_ingredients, \PDO::PARAM_STR );
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        // var_dump($stmt->fetchColumn('id'));
        // exit;
        return $stmt->fetchColumn(0);
    }
	public function add_order_ingredient($order_id,$ingredient_id) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.add_order_ingredient(?,?);');
        $stmt->bindValue(1, $order_id, \PDO::PARAM_INT);
        $stmt->bindValue(2, $ingredient_id, \PDO::PARAM_INT);
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    public function decrement_stock($value) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.decrement_stock(?);');
        $stmt->bindValue(1, $value, \PDO::PARAM_INT);
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    public function increment_stock($value) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.increment_stock(?);');
        $stmt->bindValue(1, $value, \PDO::PARAM_INT);
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    public function update_order($order_id, $status) {
    	// var_dump($value);
        // $stmt = $this->pdo->prepare('BEGIN;');
        $stmt = $this->pdo->prepare('CALL public.update_order(?,?);');
        $stmt->bindValue(1, $order_id, \PDO::PARAM_INT);
        $stmt->bindValue(2, $status, \PDO::PARAM_STR);
        // $stmt = $this->pdo->prepare('Commit;');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
}