<?php
session_start();
require_once ("functions.php");

$email = $_POST['email'];
$password =  $_POST['password'];


if (login($email,$password)) {
    redirect_to('users.php');
}

if(!login($email,$password)){
    set_flash_message('danger','Не верный логин или пароль');
    redirect_to('page_login.php');
}