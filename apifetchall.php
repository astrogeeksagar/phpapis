it<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'connect.php';

$PDO = Database::connect();
$sql = "select * from studentdata";
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
?>