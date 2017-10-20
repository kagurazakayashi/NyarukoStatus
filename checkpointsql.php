<?php
header('Content-type:text/json');
$arr = array('status' => 0, 'msg' => 'OK', 'server' => 'YashiBJ1', 'host' => $_SERVER['HTTP_HOST']);
if (isset($_POST["source"])) {
    $arr["source"] = $_POST["source"];
}
if (isset($_GET["source"])) {
    $arr["source"] = $_GET["source"];
}
$con = new mysqli("127.0.0.1","user","password","dbname");
if (mysqli_connect_errno($con))
{
    $arr["msg"] = mysqli_connect_error();
    $arr["status"] = 1;
}
$result = mysqli_query($con,"SELECT * FROM `checkpoint`");
if ($result instanceof mysqli_result) {
    if ($result->num_rows != 1) {
        $arr["msg"] = $result->num_rows;
        $arr["status"] = 3;
    }
} else {
    $arr["msg"] = "result!=mysqli_result";
    $arr["status"] = 2;
}
mysqli_close($con);
echo json_encode($arr);
?>