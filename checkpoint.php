<?php
header('Content-type:text/json');
$arr = array('status' => 0, 'msg' => 'OK', 'server' => 'YashiBJ1', 'host' => $_SERVER['HTTP_HOST']);
if (isset($_POST["source"])) {
    $arr["source"] = $_POST["source"];
}
if (isset($_GET["source"])) {
    $arr["source"] = $_GET["source"];
}
echo json_encode($arr);
?>