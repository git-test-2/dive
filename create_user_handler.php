<?php
session_start();

require_once "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];
$status = $_POST['status'];


$image = $_FILES['image'];


$username = $_POST['username'];
$job_title = $_POST['job_title'];
$tel = $_POST['tel'];
$address = $_POST['address'];

$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];



//get_user_by_email($email);
if(get_user_by_email($email)) {
    set_flash_message('danger','такая почта уже существует');
    redirect_to('create_user.php');
    exit();
}



//$user_id  - id последнего пользователя сохраняем в переменную, чтобы потом передать другим ф-ям
$user_id = add_user($email,$password); //создаём пользователя, и ф-я возвращает id последнего пользователя -  return $pdo->lastInsertId();

set_status($user_id, $status);

edit($user_id,$username,$job_title,$tel,$address);

social($user_id,$vk,$telegram,$instagram);

upload_avatar($user_id, $image);

set_flash_message('success','новый пользователь добавлен');
redirect_to('create_user.php');









//
//function add_user($email) {
//
//    $pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
//    $sql = "SELECT * FROM users WHERE email = :email";
//    $statement = $pdo->prepare($sql);
//    $statement->execute(['email'=> $email]);
//    $statement->fetch(PDO::FETCH_ASSOC);
//
//}





