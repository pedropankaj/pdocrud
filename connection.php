<?php
# DATABASE CONFIGURATION FILE
include 'config.php';

# DATABASE CONNECTION STRING USES PDO.
class Database {
  // config variables
  private static $db_name = DB_NAME;
  private static $db_host = DB_HOST;
  private static $db_username = DB_USER;
  private static $db_password = DB_PASS;

  private static $conn = null;

  public function __construct() {
    die('Init function is not allowed');
  }

  // function connect
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

  // function disconnect
  public static function disconnect() {
    self::$conn = null;
  }
}
?>