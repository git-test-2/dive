<?php
session_start();
require_once("functions.php");

is_not_logged_in();


//почта что ввели для изменения
$new_email = $_POST['email'];
$user_id = $_POST['user_id'];

$logged_user_id = $_SESSION['user_info']['id']; //кто редактирует
$edit_user_id = $user_id; // id кого редактируем

$password = $_POST['password'];

if(!empty($password))
{
    $new_password_hash = password_hash($password,PASSWORD_DEFAULT);
}


//проверяем не занят ли новый email
function check_new_email($new_email) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $emails = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($emails as $old_email) {
        if($old_email['email'] === $new_email)
        {
            return true;
        }
    }
}



//проверка автор редактирует сакм себя или это админ. Если нет - редирект
if(is_author($logged_user_id,$edit_user_id) or ($_SESSION['user_info']['role'] === 'admin')) {

} else {
    set_flash_message('danger','зарегистрируйтесь, чтобы редактировать');
    redirect_to('users.php');
}





if(check_new_email($new_email)) {
    set_flash_message('danger','такая почта существует');
    redirect_to("security.php?id={$user_id}"); //если почта есть, то по id выводим данные юзера что хотим редактировать
} else {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
    $sql = "UPDATE users SET email = :email, password = :password WHERE id = :id ";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email'=>$new_email,'password' => $new_password_hash,'id'=>$user_id]);
    set_flash_message('success','профиль успешно обновлён');
    redirect_to("page_profile.php?id={$user_id}");
}

