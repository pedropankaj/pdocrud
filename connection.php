<?php
class Database {
  private static $db_name = 'db_pdocrud';
  private static $db_host = 'localhost';
  private static $db_username = 'root';
  private static $db_password = '8902345jmcr';
  
  private static $conn = null;

  public function __construct() {
    die('Init function is not allowed');
  }

  public static function connect() {
    # One connection through whole application
    if (null == self::$conn):
      try {
        self::$conn = new PDO("mysql:host=" . self::$db_host . ";" . "dbname=" . self::$db_name, self::$db_username, self::$db_password);
      }
      catch(PDOException $e) {
        die($e->getMessage());
      }
    endif;
    return self::$conn;
  }

  public static function disconnect() {
    self::$conn = null;
  }
}
?>