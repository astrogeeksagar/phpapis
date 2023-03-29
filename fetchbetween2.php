<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

$first = $_GET['from'];
$second = $_GET['to'];

include 'connect.php';

$PDO = Database::connect();
$sql = "SELECT * FROM studentdata WHERE id BETWEEN $first AND $second";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) > 0) {
    $data = $result;
  echo json_encode($data);
} else {
  echo json_encode(['msg' => 'No Data!', 'status' => false]);
}

Database::disconnect();

// https://localhost/sagar/php_programs/postman/fetchbetween2.php?from=2&to=4
?>