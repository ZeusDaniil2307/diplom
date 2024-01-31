 <?php 
function get_user_by_email($email) {
   $pdo = new PDO("mysql:host=localhost;dbnamy=myha", "root", "");

   $sql = "SELECT * FROM soskaigla WHERE email=:email";

   $statement = $pdo->prepare($sql);
   $statement->execute(["email" => $email]);
   $soskaigla = $statement->fetch(PDO::FETCH_ASSOC);
   return $soskaigla;
}
function set_flash_message($name, $message) {
   $_SESSION[$name] = $message;
}
function redirect_to($path) {
    header("Location: {$path}");
    exit;
}
function odd_user($email, $password) {
    $pdo = new PDO("mysql:host=localhost;dbname=myha", "root", "");
    $sql = "INSERT INTO soskaigla (email, password) VALUES (:email, :password)";

 $statement = $pdo->prepare($sql);
 $result = $statement->execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)
 ]);
}
function display_flash_message($name) {
   if(isset($_SESSION[$name])) {
      echo "<div class=\"alert alert-{$name} text-dark\" role-\"alert\">{$_SESSION[$name]}</div>";
      unset($_SESSION[$name]);
   }
} 