<?php 
function alert($message) {
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function redirect($url, $statusCode = 303) {
   header('Location: ' . $url, true, $statusCode);
   exit();
}

function formatName($name) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
}
?>