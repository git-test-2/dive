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


    //1 - ввёл юзер (123), 2 - хеш с бд ($2y$10$hhNE5ODyW1iwC5Ms7RG4kuKq0pzDIrf20WiDNSNIf9OUORNU0eeCm)
    if (!empty($user)) {
        if (password_verify($password,$user['password'])) {
            $_SESSION['login'] = true;


            //добавили для 3 - Список пользователей, чтобы узнать админ ли человек, после того как он залогинился
            //   var_dump($_SESSION['user_info']['role']);
            $sql = "SELECT * FROM users WHERE email=:email";
            $statement = $pdo->prepare($sql);
            $statement->execute(['email' => $email]);
            $_SESSION['user_info'] = $statement->fetch(PDO::FETCH_ASSOC);


            return true;
        } else { return false;}
    }

}


                                            // 3 - Список пользователей
function is_logged_in() {
    if($_SESSION['login']) {

        echo 'Вы авторизованы';
    }
}


function is_not_logged_in() {
    if(!$_SESSION['login']) {
        set_flash_message('danger','Пройдите авторизацию, чтобы посмотреть пользователей');
        redirect_to("page_login.php");
    }
}


                                            // 4 - Добавить пользователя

//Как только создали пользователя вызываем ф-ю редактировать его информацию.
//Недостоющим ингридиентом для других ф-ций будет id пользователя (который мы получаем через return $pdo->lastInsertId() и где-то храним)
//Parameters - string, Description: редактировать профиль, Return value: boolean
function edit($user_id, $username, $job_title, $tel, $address) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "INSERT INTO general_information (id,username,job_title,tel,address) VALUES (:id,:username,:job_title,:tel,:address)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$user_id,'username'=> $username,'job_title'=>$job_title,'tel'=>$tel,'address'=>$address]);
}


function social($user_id,$vk,$telegram,$instagram) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "INSERT INTO social_networks (id, vk, telegram, instagram) VALUES (:id, :vk,:telegram, :instagram)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$user_id,'vk'=>$vk,'telegram'=>$telegram,'instagram'=>$instagram]);
}



function set_status($user_id, $status) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "UPDATE users SET status = :status WHERE id = :id"; //как сделать с INSERT не знаю
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$user_id,'status'=>$status]);
}

function upload_avatar($user_id,$image) {
    if(!empty($_FILES['image']["tmp_name"]))
    {
        $tmp_name = $_FILES["image"]["tmp_name"]; //путь к файлу где временно храниться картинка
        //$_FILES["image"] - где искать , ["name"] - имя конкретной картинки
        $path_parts = pathinfo($_FILES["image"]["name"]); //получаем массив из информации про файл (имя, разширение и тд)
        $suffix = $path_parts['extension']; //из массива получаем окончание файла - .jpg

        $image_name = 'upload/'.uniqid().'.'.$suffix; //подготовили путь к картинке, чтобы записать в БД
        //берём с временного хранилища, загружаем в папку images/ с уникальныи именем
        move_uploaded_file($tmp_name,$image_name);

        //var_dump($image_name); //string(24) "upload/628e600b04f3b.png"

        $pdo = new PDO("mysql:host=localhost;dbname=dave_db","root","");
        $sql = "UPDATE users  SET image = :image WHERE id = :id"; //как сделать с INSERT не знаю
        $statement = $pdo->prepare($sql);
        $statement->execute(['id'=>$user_id,'image'=>$image_name]);
    }
}

                                        // 5 - Редактировать пользователя
//получить всю информацию с таблицы пользователя по id
function get_user_by_id($id) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "SELECT * FROM general_information WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}


//редактировать общую информацию
// 4 параметра в функцию это нормально, больше это уже много
function edit_info($user_id, $username, $job_title, $tel, $address) {
    $pdo = new PDO("mysql:host=localhost;dbname=dave_db", "root", "");
    $sql = "UPDATE general_information SET username = :username, job_title = :job_title, tel = :tel, address = :address WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=>$user_id,'username'=>$username,'job_title'=>$job_title,'tel'=>$tel,'address'=>$address]);
}

//
function is_author($logged_user_id, $edit_user_id) {
    if ($logged_user_id === $edit_user_id) {
        return true;
    }
}



