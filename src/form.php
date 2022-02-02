<?php 
require "services/auth.php";
session_start();
ob_start();

$auth = new Auth();
$fileSystem = new FileSystem();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
}
if (isset($_GET['logout'])) {
    $auth->doLogout();
}
if (isset($_POST['form'])) {
    $name = formatName($_SESSION['name']);
    $fileName = "data/logs/{$_SESSION['nik']}-{$name}.csv";
    $date = $_REQUEST["date"];
    $hour = $_REQUEST["hour"];
    $location = $_REQUEST["location"];
    $temperature = $_REQUEST["temperature"];
    $data = $fileSystem->read_csv($fileName);
    $data[] = array($date, $hour, $location, $temperature);
    $fileSystem->write_csv($fileName, $data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    <title>Dashboard</title>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            padding-top: 5rem;
            margin-left: 5rem;
            margin-right: 5rem;
            background-color: #f5f5f5;
        }
        .nav-link {
            color: #000000;
            border-right: 1px solid #000000;
        }
        .nav-link:last-child {
            border-right: unset;
        }
        .nav-link.active {
            color: #0d6efd;
            background-color: unset;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
            <img src="https://via.placeholder.com/150" />
            </div>
            <div class="col-10">
                <h1>PEDULI DIRI</h1>
                <p>Catatan Perjalanan</p>
                <nav class="nav mb-3">
                    <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    <a class="nav-link" href="history.php">Catatan Perjalanan</a>
                    <a class="nav-link active" href="form.php">Isi Data</a>
                    <a class="nav-link" href="dashboard.php?logout=true">Logout</a>
                </nav>
                <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="date" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Jam</label>
                            <div class="col-sm-8">
                                <input name="hour" type="time" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Lokasi yang dikunjungi</label>
                            <div class="col-sm-8">
                                <input name="location" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Suhu Tubuh</label>
                            <div class="col-sm-8">
                                <input name="temperature" type="text" class="form-control">
                            </div>
                        </div>
                        <button name="form" type="submit" class="btn btn-primary">Simpan</button>
                    </form>                        
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>