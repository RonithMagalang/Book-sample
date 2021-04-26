<?php 
require_once "./db_con.php";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $fetch = new query($mysqli);
  if(isset($_POST['saveinfo'])){
  $saveRes = array();
  $queryforId = "SELECT `id` from books where `id` = ?";
  $bookid = $fetch->randomstringcreate($queryforId, $mysqli, "BKK");

  $insertQuery =  "INSERT INTO books (`id`, `bookcode`, `bookname`, `author`) VALUES (?,?,?,?)";
  $bookcode = $_POST['bookcode'];
  $bookname = $_POST['bookname'];
  $author = $_POST['author'];
  $bookDB = $fetch->insertDeleteUpdateQuery($insertQuery, array(
    'id'=>$bookid,
    'bookcode'=>$bookcode,
    'bookname'=>$bookname,
    'author' =>$author
  ));
  if($bookDB){
    $saveRes = array(
      'code' => 200,
      'bookcode' => $bookcode,
      'bookname' => $bookname,
      'author' => $author
    );
  }else
  {
    $saveRes = array('code' => 400);
  }
  echo json_encode($saveRes);
  }
}

?>