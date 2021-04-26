<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('DB_NAME', 'forsampling');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

// Create connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


class query
{
  private $conn;
  private $bind;
  function __construct($db)
  {
      $this->conn=$db;
  }

  private function santizeInput($input){
    foreach ($input as $key => $value) {
        $input[$key] = $this->conn->real_escape_string(trim(htmlspecialchars(strip_tags($input[$key]))));
    }
    return $input;
  }
  private function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
  }
  public function randomPassword() {
    $randomitem = true;
    while($randomitem == true)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $tempItemid = rand(1,999). $randomString;
        $randomitem = false;
    }
    return $tempItemid;
  }
  public function randomID($queryrandom = "", $mysqli = null) {
    $randomitem = true;
    while($randomitem == true)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $tempItemid = rand(1,999). $randomString ."-". date('Y');
        $sqlgetID = $queryrandom;
        if($stmt = $mysqli->prepare($sqlgetID))
        {
          $stmt->bind_param("s", $tempItemid);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($thisItemid);
          $stmt->fetch();
          $stmt->close();
        }
              if($thisItemid == $tempItemid){
                $randomitem = true;
              }else {
                $mainItemid = $tempItemid;
                $randomitem = false;
              }
    }
    return $mainItemid;
  }
  public function randomstringcreate($queryrandom = "", $mysqli = null, $concat) {
    $randomitem = true;
    while($randomitem == true)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 2; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $tempItemid = $concat. "-" .rand(1,999). $randomString ."-". date('Y');
        $sqlgetID = $queryrandom;
        if($stmt = $mysqli->prepare($sqlgetID))
        {
          $stmt->bind_param("s", $tempItemid);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($thisItemid);
          $stmt->fetch();
          $stmt->close();
        }
              if($thisItemid == $tempItemid){
                $randomitem = true;
              }else {
                $mainItemid = $tempItemid;
                $randomitem = false;
              }
    }
    return $mainItemid;
  }
  public function selectQuery($query, $params=null, $santize=false)
  {
    /*
    params  = assoc array
    params format for input:
    $param = array(key =>value)
    */
    if($santize){
      $params = $this->santizeInput($params);
    }
    if($stmt = $this->conn->prepare($query)){
      if(!is_null($params)){
        $types = '';
        foreach($params as $key =>$param) {
          if(is_int($param)) {
              $types .= 'i';              //integer
          } elseif (is_float($param)) {
              $types .= 'd';              //double
          } elseif (is_string($param)) {
              $types .= 's';              //string
          } else {
              $types .= 'b';              //blob and unknown
          }
        }
        array_unshift($params, $types);
        call_user_func_array(array($stmt,'bind_param'),$this->refValues($params));
      }
      $stmt->execute();
      $meta = $stmt->result_metadata();
      $data = $stmt->get_result();
      $rows = array();
      if($data->num_rows>0)
      {
        while($row = $data->fetch_assoc()){
          array_push($rows, $row);
        }
      }
      return $rows;
      $stmt->close();
    }
  }
  public function insertDeleteUpdateQuery($query, $params=null, $sanitize = false, $getLastId = false)
  {
    /*
    params = assoc array
    params format for input:
    $param = array(key =>value)

    $sanitized- sanitized $params
    $getLastId - Get the AUTO GENERATED/AI id used in the query

    */
    if($sanitize){
      $params = $this->santizeInput($params);
    }
    if($stmt = $this->conn->prepare($query)){
      if(!is_null($params)){
        $types = '';
        foreach($params as $key =>$param) {
          if(is_int($param)) {
              $types .= 'i';              //integer
          } elseif (is_float($param)) {
              $types .= 'd';              //double
          } elseif (is_string($param)) {
              $types .= 's';              //string
          } else {
              $types .= 'b';              //blob and unknown
          }
        }
        array_unshift($params, $types);
        call_user_func_array(array($stmt,'bind_param'),$this->refValues($params));
      }
      $stmt->execute();
      if($stmt->affected_rows>0){
        if($getLastId){
          return $stmt->insert_id; //return the query AUTO GENERATED/AI id
        }else{
          return true;
        }
      }else{
        return false;
      }
      $stmt->close();
    }
  }
}


?>
