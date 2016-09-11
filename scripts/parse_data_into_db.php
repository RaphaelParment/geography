<?php
// parse data into db

define('HOST', 'localhost');
define('USER', 'vagrant');
define('PASSWD', 'vagrant');
define('DB_NAME', 'geography');
define('PATH_TO_FILE', '/home/vagrant/workspace/geographie-bundle/files/csv/departements-france.csv');

class ParseData{

	private $db_local;

	private function create_db(){
		try {
			$dbh = new PDO("mysql:host=" . HOST, USER, PASSWD);
			$dbh->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . ";");
			printf("Creation successful\n");
		} catch (PDOException $e) {
			printf("Creation failed %s\n", $e->getMessage());
		}
	}

	private function connect_db(){
		try{
			$this->db_local = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASSWD);
			$this->db_local->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db_local->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->db_local->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

			printf("Connection successful\n");
		}
		catch(PDOException $e){
			printf("Connection failed %s\n", $e->getMessage());
		}	
	}

	private function create_table_region(){
		$stmt = $this->db_local->prepare(<<<SQL

CREATE TABLE IF NOT EXISTS region(
	id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	capital_id INT NOT NULL,
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

	private function create_table_department(){
		$stmt = $this->db_local->prepare(<<<SQL

CREATE TABLE IF NOT EXISTS department(
	id INT,
	name VARCHAR(50) NOT NULL,
	population INT NOT NULL DEFAULT 0,
	area INT NOT NULL DEFAULT 0,
	prefecture_id INT NOT NULL,
	region_id INT NOT NULL,
	PRIMARY KEY(id)
	)
SQL
			);

		if(!$stmt->execute()){
			throw new Exception("Could not create 'department' table.\n");
		}
	}

	private function create_table_city(){
		$stmt = $this->db_local->prepare(<<<SQL

CREATE TABLE IF NOT EXISTS city(
	id INT NOT NULL COMMENT "Denotes the unique id, and the departement number",
	name VARCHAR(50) NOT NULL,
	population INT NOT NULL DEFAULT 0,
	department_id INT NOT NULL,
	PRIMARY KEY(id)
	)
SQL
			);

		if(!$stmt->execute()){
			throw new Exception("Could not create 'city' table.\n");
		}
	}

	public function main(){
		$this->create_db();
		$this->connect_db();
		$this->create_table_region();
		$this->create_table_department();
		$this->create_table_city();
		return 0;
	}
}

$parse_date = new ParseData();
$parse_date->main();

?>