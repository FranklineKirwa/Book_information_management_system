<?php
session_start();
require_once '../Files/auth.php';
require_once '../Files/books.php';

$auth = new Auth();
$bookManager = new BookManager();

if (isset($_POST['login'])) {
    if ($auth->login($_POST['username'], $_POST['password'])) {
        header('Location: /Frontend/dashboard.php');
    } else {
        header('Location: /Frontend/login.php?error=1');
    }
}

if (isset($_POST['register'])) {
    if ($auth->register($_POST['username'], $_POST['password'])) {
        header('Location: /Frontend/login.php');
    } else {
        header('Location: /Frontend/register.php?error=1');
    }
}

if (isset($_GET['logout'])) {
    $auth->logout();
    header('Location: /Frontend/login.php');
}

if (isset($_POST['delete_book'])) {
    $bookManager->deleteBook($_POST['book_id'], $_SESSION['user_id']);
    header('Location: /Frontend/dashboard.php');
}

if (isset($_POST['update_book'])) {
    $bookManager->updateBook($_POST['book_id'], $_SESSION['user_id'],
        $_POST['title'], $_POST['author'], $_POST['year'], $_POST['recommendations']);
    header('Location: /Frontend/dashboard.php');
}