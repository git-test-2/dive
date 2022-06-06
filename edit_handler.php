<?php
session_start();
require_once ("functions.php");

//гооврит автор ли текущий авторизованный пользователь, $logged_user_id - id текущего залогиненого юзера,
//$edit_user_id - id текущего профиля, чей профиль который мы хотим редакторовать
//если false то - формируем сообщение - можно редактировать только свой профиль


//id пользователя кого редактируем
    $user_id = $_POST['user_id'];

    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];

/////////////
    $logged_user_id = $_SESSION['user_info']['id']; //кто в сессии залогинен, кто редактирует профиль
    $edit_user_id = $_POST['user_id']; //id пользователя чей профиль редактируют

    if ($_SESSION['user_info']['role'] === 'admin' or (is_author($logged_user_id, $edit_user_id))) {

//получить все данные из таблицы пользователя по id кого редактируем
        get_user_by_id($user_id);

//редактировать общую информацию
        edit_info($user_id, $username, $job_title, $tel, $address);

        set_flash_message('success', 'профиль успешно обновлён');

        redirect_to("page_profile.php?id=" . $user_id);

    } else {
        set_flash_message('danger', 'можно редактировать только свой профиль');
        redirect_to('users.php');
    }


