<?php require_once("init.php"); ?>

<?php 

if($session->is_signed_in()) {
    redirect("index.php");
}

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database user

    User::verify_user($username,$password);

    if ($user_found) {
        $session -> login($found_user);
        redirect("index.php");
    } else {
        $the_message = "Your password or username are incorrect";
    }
} else {
    $username = "";
    $password = "";
}

?>