<?php
session_start();
require_once('functions.php');

$email = $_POST['email'];
$password = $_POST['password'];

$user = get_user_by_email($email);

if (!empty($user)) {
    set_flash_message('danger', 'Этот електронный адрес занят');
    redirect_to("page_register.php");
}

add_user($email, $password);
set_flash_message('success', 'Регистрация успешна');
redirect_to("page_login.php");

////Parameters: string - email, Description: поиск польз. по эл. адрусу, Return value: array
//function get_user_by_email($email)
//{
//    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
//    $sql = "SELECT * FROM users WHERE email=:email";
//    $statement = $pdo->prepare($sql);
//    $statement->execute(['email' => $email]);
//    $result = $statement->fetch(PDO::FETCH_ASSOC);
//
//    if ($result) {
//        return $result;
//    }
//}
//
//
//
//// Parameters: string - $email, string - $password, Description: добавить польз. В БД, Return value: int (user_id)
//function add_user($email, $password_hash)
//{
//    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
//    $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
//    $statement = $pdo->prepare($sql);
//    $result = $statement->execute(['email' => $email, 'password' => $password_hash]);
//
//    if ($result) {
//        $sql = "SELECT * FROM users WHERE email=:email";
//        $statement = $pdo->prepare($sql);
//        $statement->execute(['email' => $email]);
//        $user_id = $statement->fetch(PDO::FETCH_ASSOC);
//        return $user_id['id'];
//    }
//}
//
//
////Parameters: string- $name(ключ), string - $message(значение, текст сообщения) Description: подготовить флэш сообщение, Return value: null
//function set_flash_message($name, $message)
//{
//    $_SESSION[$name] = $message;
//    //Return value: null - любая ф-я по умочланию возвращает нам NULL
//}
//
//
////Parameters: string - name(ключ), Description: вывести флэш сообзение, Return value: null
//function display_flash_message($name)
//{
//    if (isset($name)) { //проверять наличие переменных перед их выводом
//         $_SESSION[$name];
//    }
//}
//
////Parameters: string - $path, Description: перенапраляет на другую страницу, Return value: null
//function redirect_to(string $path)
//{
//    header('Location:' . $path);
//    die();
//}


//чтоб код выглядел ровно, используй комбинацию клавиш ctrl+alt+L в шторме
//вынеси подключение в отдельную функцию - и кстати, тебе не нужно при каждом шаге заново подключать к бд


//мой код
//$pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
////$sql = "SELECT * FROM users WHERE email = :email, password = :password";
//$sql = "SELECT * FROM users WHERE email=:email";
//
//$statement = $pdo->prepare($sql);
//$statement->execute(['email'=>$email]);
//$result = $statement->fetch(PDO::FETCH_ASSOC);
//
//
//
//if($result) {
//    $_SESSION['danger'] = "такая почта уже занята";
//    header("Location: page_register.php");
//    exit();
//} else {
//
//    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
//    $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
//    $statement = $pdo->prepare($sql);
//    $statement->execute(['email'=>$email,'password'=>$password_hash]);
//
//    $_SESSION['success'] = "Вы регистрировались";
//    header("Location: page_login.php");
//}




