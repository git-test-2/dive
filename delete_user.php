<?php
session_start();
require_once ("functions.php");

$user_id = $_GET['id'];

if($_SESSION['user_info']['role'] == 'admin' or ($_SESSION['user_info']['id']) == $user_id) {

} else {
    set_flash_message('danger','можно редактировать только свой профиль');
    redirect_to('page_login.php');
}


function delete($user_id) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
    $sql = "DELETE FROM general_information WHERE id = :id; DELETE FROM social_networks WHERE id = :id; DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$user_id]);

    set_flash_message('success','пользователь удален');

    if($_SESSION['user_info']['id'] == $user_id) {
        logout();
        redirect_to('page_register.php');
    } else {
        redirect_to('users.php');
    }

}


delete($user_id);