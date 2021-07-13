<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$title = '';
$author = '';

if (isset($_POST['save'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];

  $_SESSION['message'] = "Запись сохранена!";
  $_SESSION['msg_type'] = "success";

  header("location: index.php");

  $mysqli->query("INSERT INTO books (title, author) VALUES ('$title', '$author')") or die($mysqli->error);
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM books WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = "Запись удалена!";
  $_SESSION['msg_type'] = "danger";

  header("location: index.php");
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM books WHERE id=$id") or die($mysqli->error);
  if($result->num_rows){
    $row = $result->fetch_array();
    $title = $row['title'];
    $author = $row['author'];
  }
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $author = $_POST['author'];

  $mysqli->query("UPDATE books SET title='$title', author='$author' WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = "Запись обновлена!";
  $_SESSION ['msg_type'] = "warning";

  header('location: index.php');
}