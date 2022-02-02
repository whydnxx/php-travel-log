<?php 
require "services/auth.php";
session_start();
ob_start();
$auth = new Auth();

// Check apakah sudah login
if (isset($_SESSION['name'])) {
    redirect("dashboard.php");
}

// check if payload is to do register
if (isset($_POST['register'])) {
    # Call register on /services/login.php
    $auth->doRegister($_REQUEST["nik"], $_REQUEST["name"]);
    // Set session to notify user logged in
    $_SESSION['name'] = $_REQUEST["name"];
    $_SESSION['nik'] = $_REQUEST["nik"];
    alert("Selamat Bergabung");
    redirect("dashboard.php");
}
// check if payload is to do login
elseif (isset($_POST['login'])) {
    # Call login on /services/login.php
    $isSuccess = $auth->doLogin($_REQUEST["nik"], $_REQUEST["name"]);
    // Call function alert from core/init.inc.php
    if ($isSuccess) {
        $_SESSION['name'] = $_REQUEST["name"];
        $_SESSION['nik'] = $_REQUEST["nik"];
        alert("Selamat Datang");
       redirect("dashboard.php");
    } else {
        alert("NIK / Nama lengkap salah");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
    <title>Travel Log</title>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

    </style>
</head>
<body>
    <form class="form-signin" action="index.php" method="POST">
        <div class="mb-3">
            <input name="nik" type="text" class="form-control" placeholder="NIK">
        </div>
        <div class="mb-3">
            <input name="name" type="text" class="form-control" placeholder="Nama Lengkap">
        </div>
        <button name="register" type="submit" class="btn btn-primary">Saya Pengguna Baru</button>
        <button name="login" type="submit" class="btn btn-primary">Masuk</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>