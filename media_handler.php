<?php
session_start();
require_once ("functions.php");

$user_id = $_POST['user_id_for_image'];

$image = $_FILES['image']["tmp_name"];

if($_SESSION['user_info']['role'] == 'admin' or ($_SESSION['user_info']['id']) == $user_id) {

} else {
    set_flash_message('danger','зарегистрируйтесь, чтобы менять аватар');
    redirect_to('page_login.php');
}


upload_avatar($user_id,$image);
set_flash_message('success','профиль успешно обновлен');
redirect_to('page_profile.php?id='.$user_id);

                                                    //делал для себя
//var_dump($_POST['user_id_for_image']);
//var_dump($_FILES);
//$file = $_FILES['image']["name"]; // ["tmp_name"]
//$file_tmp = $_FILES['image']['tmp_name'];
//var_dump($file);
//
//echo "<br>";
//echo "<br>";
//
//$image_info = pathinfo($file);
//var_dump($image_info);
//echo "<br>";
//
//$image_suffix = $image_info["extension"]; //взяли расширение
//echo $image_name = uniqid(). '.' .$image_suffix; //уникальное имя картинки
//
////        move_uploaded_file($tmp_name, "$uploads_dir/$name");
//move_uploaded_file($file_tmp,'upload/'.$image_name); //загружаем картинку из временного хранилища в папку с уникальным именем



