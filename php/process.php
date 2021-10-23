<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'harry_potter_db') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nume = '';
$prenume = '';
$facultate = '';

if (isset($_POST['save'])){
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $facultate = $_POST['facultate'];

    $mysqli->query("INSERT INTO studenti (nume, prenume, facultate) VALUES('$nume','$prenume', '$facultate')") or
             die($mysqli->error);
    
    $_SESSION['message'] = "Datele au fost salvate cu succes!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM studenti WHERE id_st=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Datele au fost sterse!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM studenti WHERE id_st=$id") or die($mysqli->error());
    if ($result==true){
        $row = $result->fetch_array();
        $nume = $row['nume'];
        $prenume = $row['prenume'];
        $facultate = $row['facultate'];
    }
   
}

if (isset($_POST['update'])){
    $id = $_POST['id_st'];
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $facultate = $_POST['facultate'];

    $mysqli->query("UPDATE studenti SET nume='$nume', prenume='$prenume', facultate='$facultate' WHERE id_st=$id") or die($mysqli->error());

    $_SESSION['message'] = "Actualizare cu succes!!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}