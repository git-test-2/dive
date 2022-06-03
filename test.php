<?php
echo 1123;
$b = 1123; //юзер ввёл

//хеш с бд
$a = password_hash($b,PASSWORD_DEFAULT);
//echo $a;

var_dump( password_verify($b,$a));
