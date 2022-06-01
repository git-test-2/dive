<?php

//Parameters: string - email, Description: поиск польз. по эл. адрусу, Return value: array
function get_user_by_email($email)
{
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;

}


// Parameters: string - $email, string - $password, Description: добавить польз. В БД, Return value: int (user_id)
function add_user($email, $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

    return $pdo->lastInsertId(); //возвращем id пользователя
}


//Parameters: string- $name(ключ), string - $message(значение, текст сообщения) Description: подготовить флэш сообщение, Return value: null
function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;
    //Return value: null - любая ф-я по умочланию возвращает нам NULL
}


//Parameters: string - name(ключ), Description: вывести флэш сообзение, Return value: null
function display_flash_message($name)
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }

}


//Parameters: string - $path, Description: перенапраляет на другую страницу, Return value: null
function redirect_to(string $path)
{
    //header('Location:' . $path);
    header("Location: {$path}");
    exit();
}

////////////////////2 - Авторизация
//Parameters: string - $email, string - $password, Description: авторизировать пользователя, Return value: boolean
function login($email, $password) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);


    if (!empty($user)) {
        if (password_verify($user['password'], password_hash($password, PASSWORD_DEFAULT))) {
            return true;
        } else { return false;}
    }

}
