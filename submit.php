<?php
$servername = "localhost"; // или ваш сервер
$username = "username"; // ваше имя пользователя
$password = "password"; // ваш пароль
$dbname = "collaboration_db";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Подготавливаем и связываем
$stmt = $conn->prepare("INSERT INTO applications (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Выполняем запрос
if ($stmt->execute()) {
    echo "Заявка успешно отправлена!";
} else {
    echo "Ошибка: " . $stmt->error;
}

// Закрываем соединение
$stmt->close();
$conn->close();
?>