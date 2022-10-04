<?php
require_once "config.php";
function getAllUsers(){
    global $mysqli;
   $sql = "SELECT id, username, created_at FROM users";
   $result = mysqli_query($mysqli, $sql);
   if($result == false){
    return false;
   }
   $rows = array();
   while($row = mysqli_fetch_array($result)){
    $rows[] = $row;
   }
   // return as json
   // return json_encode($rows);
   // return as array of object
   return $rows;
}











?>