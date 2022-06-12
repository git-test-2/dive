<?php
session_start();
require_once ("functions.php");

$new_user_status = $_POST['status'];
$user_id = $_POST['user_id'];

$logged_user_id = $_SESSION['user_info']['id']; //кто в сессии залогинен, кто редактирует профиль
$edit_user_id = $_POST['user_id']; //id пользователя чей профиль редактируют

if ($_SESSION['user_info']['role'] === 'admin' or (is_author($logged_user_id, $edit_user_id))) {

$pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
$sql = "UPDATE users SET status = :status WHERE id=:id ";
$statement = $pdo->prepare($sql);
$statement->execute(['status'=>$new_user_status,'id'=>$user_id]);

set_flash_message('success','профиль успешно обновлен');
redirect_to('page_profile.php');

} else {
    set_flash_message('danger', 'можно редактировать только свой профиль');
    redirect_to('users.php');
}
