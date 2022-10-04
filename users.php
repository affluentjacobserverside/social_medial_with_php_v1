<?php
require_once "getAllUsers.php";

$users = getAllUsers();
foreach($users as $user){

?>

<?php echo $user['username']; "<br>";?>

<?php
}
?>