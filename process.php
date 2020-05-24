<?php

session_start();

//prisijungimas prie DB
$mysqli = new mysqli('localhost', 'root', 'mysql', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$project = '';

//duomenu idejimas
if (isset($_POST['save'])){
    $name = $_POST['name'];
    $project = $_POST['project'];

    $mysqli->query("INSERT INTO data (name, project) VALUES('$name', '$project')") or
        die($mysqli->error());

//pranesimas apie duomenu irasyma
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php"); //redirectinam i main page
}
//duomenu istrinimas
if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

// pranesimas apie istrinima
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php"); //redirectinam i pagrindini page
}
//duomenu atvaizdavimas kuomet editinam
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $name = $row['name'];
        $project = $row['project'];
    }
        
}
//update logic
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $project = $_POST['project'];

    $mysqli->query("UPDATE data SET name='$name', project= '$project' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}

?>