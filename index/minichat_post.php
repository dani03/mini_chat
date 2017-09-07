<?php
session_start();
function secure($var){
$var = htmlspecialchars($var);
$var =stripslashes($var);
$var = trim($var);
 return $var;
}
if(isset($_POST['name'])){
    $_SESSION['name'] = secure($_POST['name']);
}

$name = $_POST['name'];
$message = $_POST['message'];
$nameError = "";
$messageError = "";
if(empty($name)){
  $nameError = "ajouter un nom";
}
if(empty($message)){
  $messageError = "ajouter un message";
}
try {
    $bdd = new PDO('mysql:host=localhost;dbname=miniChat;charset=utf8', 'phpmyadmin','root');
} catch (Exception $e) {

  die('erreur au niveau '.$e->getMessage());
}

// on insert les valeurs dans la base de donnée

    $req = $bdd->prepare('INSERT INTO users (name, message) VALUES (:name, :message)');
    $req->execute(array(
      'name' => $name,
      'message' => $message
    ));
     header("location: minichat.php");



 ?>
