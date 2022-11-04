<?php

// namespace App\Model;

class Database
{
  private string $host_server = "localhost";
  private string $host_user = "root";
  private string $host_pass = "osotech";
  private string $db_name = "agos_hotel"; //"agos_hotel";
  private string $db_charset = "utf8mb4";
  private string $db_driver = "mysql";
  private PDO $dbh;

  function __construct()
  {
    $this->osotech_connect();
  }
  public function osotech_connect(): PDO
  {
    try {
      $dsn = $this->db_driver . ":host=" . $this->host_server . ";dbname=" . $this->db_name . ";charset=" . $this->db_charset;
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_PERSISTENT => false
      ];
      $this->dbh = new PDO($dsn, $this->host_user, $this->host_pass, $options);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    return $this->dbh;
  }
}