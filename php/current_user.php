<?php
if (!isset($_SESSION)) {
    session_start();
}

$user = '';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$data = mb_convert_encoding([$user], 'UTF-8', 'UTF-8');
echo json_encode($data);
?>