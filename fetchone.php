<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

$student_id = $_GET['sid'];

include 'connect.php';

$PDO = Database::connect();
$sql = "select * from studentdata where id = $student_id";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$result = $stmt->Fetch(PDO::FETCH_ASSOC);
if (count($result) > 0) {
    $data = $result;
  echo json_encode($data);
} else {
  echo json_encode(['msg' => 'No Data!', 'status' => false]);
}

Database::disconnect();

// https://localhost/sagar/php_programs/postman/fetchone.php?sid=3
?>