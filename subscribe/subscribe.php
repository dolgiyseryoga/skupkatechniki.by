<?php
$servername = "localhost";
$database = "sub";
$username = "root";
$password = "";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Создаем новое соединение с базой данных, используя PDO
try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
    echo "";
} catch (PDOException $error) {
    echo 'Ошибка базы данных: ' . $error->getMessage();
}

if (isset($_POST['submit_form'])) {
    $u_Name = $_POST["user_name"]; //Получаем имя пользователя из массива $_POST в переменную $name 
    $email = $_POST["email"]; // Получаем email пользователя из массива $_POST в переменную $email */

    $error_form = validate_inputs($u_Name, $email); /* вызываем функцию валидации формы*/
    if (!empty($error_form)) { /* если найдена ошибка */
        echo $error_form; /* выводим сообщение об ошибке */
    } else { /* иначе - вызываем подготовленный запрос */
        $u_Name = $_POST["user_name"]; //Получаем имя пользователя из массива $_POST в переменную $name 
        $email = $_POST["email"]; // Получаем email пользователя из массива $_POST в переменную $email */

        // Создаем переменную, которая вызывает методобъекта базы данных prepare()
        // Запрос SQL вводится как параметр, заполнители пишутся как :заполнитель_имя
        $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO subscribe (name,  email) VALUES (:u_name,  :email)");

        // Указываем скрипту, какая переменная ссылается на каждый заполнитель, чтобы использовать метод bindParam()
        // Первый параметр - это заполнитель в операторе выше, второй - переменная, на которую он должен ссылаться
        $my_Insert_Statement->bindParam(":u_name", $u_Name);
        $my_Insert_Statement->bindParam("email", $email);


        // Метод execute() возвращает TRUE, если он выполнен успешно, и FALSE, если нет. И выводим сообщение
        if ($my_Insert_Statement->execute()) {
            header('Location: /pages/ok.php');
        } else {
            echo "Невозможно подписаться, проверьте введенные данные";
        }
    }
}

function validate_name($data)
{
    $err = ""; /* присваиваем переменной $err пустую строку */
    if (strlen($data) < 2 || strlen($data) > 50) /* если длина переменной $data меньше 2 или больше 50 символов*/
        $err = "Длина имени должна быть от 2 до 50 символов";
    if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $data)) /* если в имени содержатся недопустимые символы */
        $err = $err . "<p>В написании имени допустимы только буквы латинского и русского алфавита,цифры, символ подчеркивания и пробел</p>";
    if (!empty($err))
        return ($err);
    else
        return 0;
}

function validate_email($data)
{
    $err = "";
    if (strlen($data) < 3 || strlen($data) > 50) /* если длина email меньше 3 и больше 50 */
        $err = "Email должен быть от 3 до 50 символов"; /*записываем в переменную $err сообщение об ошибке */
    if (!preg_match('#^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,}$#ui', $data)) /* если введенный адрес недопустимого формата */
        $err = $err . "<p>Недопустимый формат email-адреса</p>";  /*записываем в переменную $err сообщение об ошибке */
    if (!empty($err))
        return ($err);
    else
        return 0;
}

function validate_inputs($data_name, $data_email)
{
    $err = "";
    $err_name = validate_name($data_name); /* вызываем функцию валидации имени пользователя */
    $error_email = validate_email($data_email); /* вызываем функцию валидации email-адреса пользователя */
    if (!empty($err_name))
        $err = $err_name;
    if (!empty($error_email))
        $err = $err . $error_email;
    return $err;
}
