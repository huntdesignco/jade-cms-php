<?php
class Database
{
  public $pdo, $host, $port, $db, $user, $pass, $charset;

  function __construct() {
    $this->host = constant('DB_HOST');
    $this->port = constant('DB_PORT');
    $this->db   = constant('DB_NAME');
    $this->user = constant('DB_USER');
    $this->pass = constant('DB_PASS');
    $this->charset = constant('DB_CHARSET');
  }

  function connect() {
    $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=$this->charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
      $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
  }
  function table($table) {
    return CONSTANT('DB_PREFIX') . $table;
  }

}

?>