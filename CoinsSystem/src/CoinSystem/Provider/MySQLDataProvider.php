<?php
/**
 * Created by PhpStorm.
 * User: McpeBooster
 * Date: 09.02.2018
 * Time: 17:28
 */

namespace CoinSystem\Provider;


use CoinSystem\CoinSystem;

class MySQLDataProvider {

    private $plugin;
    public $database;

    public function __construct($host, $username, $password, $database){
        $this->plugin = CoinSystem::getInstance();
        $this->database = new \mysqli($host, $username, $password, $database);

        if ($this->database->connect_error) {
            $this->plugin->getLogger()->critical("Couldn't connect to MySQL: " . $this->database->connect_error);
            return false;
        }

        $this->database->query("CREATE TABLE IF NOT EXISTS `coinsystem` (
            name VARCHAR(64) PRIMARY KEY,
			coins INT(32) NOT NULL
		)");
    }

    public function close() {
        $this->database->close();
    }
}