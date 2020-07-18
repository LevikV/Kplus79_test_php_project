<?php //adduser.php

// Код PHP

$forename = $surname = $username = $password = $age = $email = "";

if (isset($_POST['forename'])) $forename = fixstring($_POST['forename']);
if (isset($_POST['surname'])) $surname = fixstring($_POST['surname']);
if (isset($_POST['username'])) $username = fixstring($_POST['user']);
if (isset($_POST['password'])) $password = fixstring($_POST['password']);
if (isset($_POST['age'])) $age = fixstring($_POST['age']);
if (isset($_POST['email'])) $email = fixstring($_POST['email']);

$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);


// Функции PHP

function fixstring($string){
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities($string);
    }

function validate_forename($field){
    return ($field=="") ? "Не введено имя.<br>" : "";
}
function validate_surname($field) {
    return ($field=="") ? "Не введена фамилия.<br>" : "";
}
function validate_username($field) {
    if ($field=="") return "Не введено имя пользователя.<br>";
    else if (strlen($field)<5) return "В имени пользователя должно быть не менее 5 символов.<br>";
    else if (preg_match("/[^a-zA-Z0-9_-]/", $field)) return "В имени пользователя разрешены только a-z, A-Z, 0-9, _ и -.<br>";
    return "";
}
function validate_password($field) {
    if ($field=="") return "Не введен пароль.<br>";
    else if (strlen($field)<6) return "В пароле должно быть не менее 6 символов.<br>";
    else if (!preg_match("/[a-z]", $field) || !preg_match("/[A-Z]", $field) || !preg_match("/[0-9]", $field)) return "Пароль должен содержать символы верхнего и нижнего регистра и цифры.<br>";
    return "";
}
function validate_age($field) {
    if ($field=="") return "Не введен возраст.<br>";
    else if ($field<18 || $field>110) return "Возраст должен быть от 18 до 110.<br>";
    return "";
}
function validate_email($field) {
    if ($field=="") return "Не введен email.<br>";
    else if (!((strpos($field, ".")>0) && (strpos($field, "@")>0)) || preg_match("/[^a-zA-Z0-9.@-_]/", $field)) return "Электронный адрес имеент неверный формат.<br>";
    return "";
}

?>
