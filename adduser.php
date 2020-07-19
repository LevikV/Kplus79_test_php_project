<?php //adduser.php

// Код PHP

$forename = $surname = $username = $password = $age = $email = "";

if (isset($_POST['forename'])) $forename = fixstring($_POST['forename']);
if (isset($_POST['surname'])) $surname = fixstring($_POST['surname']);
if (isset($_POST['username'])) $username = fixstring($_POST['username']);
if (isset($_POST['password'])) $password = fixstring($_POST['password']);
if (isset($_POST['age'])) $age = fixstring($_POST['age']);
if (isset($_POST['email'])) $email = fixstring($_POST['email']);

$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);

echo "<!doctype html>\n<html><head><title>Пример формы</title>";

//Если проверка формы прошла успешно
if ($fail==""){
    echo "</head><body>Проверка формы прошла успешно:<br>$forename, $surname, $username, $password, $age, $email</body></html>";
    //Здесь можно разместить код добавления данных пользователя в БД
    exit;
}
//Если при проверке формы произошли ошибки
echo <<<_END

    <style>
        .signup {
            border: 1px solid #999999;
            font: normal 14px helvetica;
            color: #444444;
        }
    </style>
    <script src="js/validate_functions.js"></script>
    <script>
        function validate(form) {
            fail = validateForename(form.forename.value)
            fail += validateSurname(form.surname.value)
            fail += validateUsername(form.username.value)
            fail += validatePassword(form.password.value)
            fail += validateAge(form.age.value)
            fail += validateEmail(form.email.value)

            if (fail == "") return true
            else {alert(fail); return false;}

        }
    </script>
</head>
<body>
    <table class="signup" border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
        <th colspan="2" align="center">Регистрационная форма</th>
        <tr>
            <td colspan="2">К сожалению в вашей форме <br> найдены ошибки: <p><font color="red"size="1"><i>$fail</i></font> </p></td>
        </tr>
        <form method="post" action="adduser.php" onsubmit="return validate(this)">
            <tr>
                <td>Имя</td><td><input type="text" maxlength="32" name="forename" value=$forename></td>
            </tr>
            <tr>
                <td>Фамилия</td><td><input type="text" maxlength="32" name="surname" value=$surname></td>
            </tr>
            <tr>
                <td>Пользовательское имя</td><td><input type="text" maxlength="16" name="username" value=$username></td>
            </tr>
            <tr>
                <td>Пароль</td><td><input type="text" maxlength="12" name="password" value=$password></td>
            </tr>
            <tr>
                <td>Возраст</td><td><input type="text" maxlength="3" name="age" value=$age></td>
            </tr>
            <tr>
                <td>Электронный адрес</td><td><input type="text" maxlength="64" name="email" value=$email></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Зарегистрироваться"></td>
            </tr>

        </form>
    </table>


</body>
</html>


_END;



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
    else if (!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field)) return "Пароль должен содержать символы верхнего и нижнего регистра и цифры.<br>";
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
