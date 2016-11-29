<?php

// parse data into db

define('HOST', 'localhost');
define('USER', 'vagrant');
define('PASSWD', 'vagrant');
define('DB_NAME', 'geography');

class ParseData{

	private $dbLocal;

	private function createDb(){
		try {
			$dbh = new PDO("mysql:host=" . HOST, USER, PASSWD);
			$dbh->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . ";");
			printf("Creation successful\n");
		} 
		catch (PDOException $e) {
			printf("Creation failed %s\n", $e->getMessage());
		}
	}

	private function connectDb(){
		try{
			$this->dbLocal = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASSWD);
			$this->dbLocal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->dbLocal->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->dbLocal->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

			printf("Connection successful\n");
		}
		catch(PDOException $e){
			printf("Connection failed %s\n", $e->getMessage());
		}	
	}

	private function createTableRegion(){
		$stmt = $this->dbLocal->prepare(<<<SQL
		
CREATE TABLE IF NOT EXISTS region(
	id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	area INT NOT NULL DEFAULT 0,
	population INT NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
	)
SQL
			);

		if(!$stmt->execute()){
			throw new Exception("Could not create 'region' table.\n");
		}
	}

	private function createTableDepartment(){
		$stmt = $this->dbLocal->prepare(<<<SQL

CREATE TABLE IF NOT EXISTS department(
	id VARCHAR(3) NOT NULL,
	name VARCHAR(50) NOT NULL,
	population INT NOT NULL DEFAULT 0,
	area INT NOT NULL DEFAULT 0,
	reg_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (reg_id) REFERENCES region(id) 
	)
SQL
			);

		if(!$stmt->execute()){
			throw new Exception("Could not create 'department' table.\n");
		}
	}

	private function createTableCity() {
		$stmt = $this->dbLocal->prepare(<<<SQL

CREATE TABLE IF NOT EXISTS city(
	id INT NOT NULL AUTO_INCREMENT,
	dept_id VARCHAR(3) NOT NULL DEFAULT 1,
	reg_id INT NOT NULL DEFAULT 1,
	name VARCHAR(50) NOT NULL,
	population INT NOT NULL DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY (dept_id) REFERENCES department(id),
	FOREIGN KEY (reg_id) REFERENCES region(id) 
	)
SQL
			);

		if(!$stmt->execute()) {
			throw new Exception("Could not create 'city' table.\n");
		}
	}

	public function main() {
		$this->createDb();
		$this->connectDb();
		
		$this->createTableRegion();
		$this->createTableDepartment();
		$this->createTableCity();
		return 0;
	}
}

$parse_date = new ParseData();
$parse_date->main();

?>
