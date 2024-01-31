<?php 
session_start();
require "functions.php";


$email = $_POST["email"];
$password = $_POST["password"];

$soskaigla = get_user_by_email($email);

$pdo = new PDO ("mysql:host=localhost;dbname=myha", "root", "");

$sql = "SELECT * FROM soskaigla WHERE email=:email";

$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email]);
$soskaigla = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($soskaigla)) {   
   $_SESSION["danger"] = "Эта эл. почта приняла удар другим пользователем.";
    header("Location: /page_register.php");
   exit;
} 


$sql = "INSERT INTO soskaigla (email, password) VALUES (:email, :password)";

$statement = $pdo->prepare($sql);
$statement->execute([
   "email" => $email,
   "password" => password_hash($password, PASSWORD_DEFAULT)
]);


$_SESSION["success"] = "Вы вошли успешно в море";
header("Location: /page_login.php");
exit;