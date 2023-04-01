<?php
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=data.sql");

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
    $sql_string = "INSERT INTO studentdata (id, name, age, city) VALUES ";
    foreach($result as $row){
        $sql_string .= "('" . $row['id'] . "','" . $row['name'] . "','" . $row['age'] . "','" . $row['city'] . "'),";
    }
    $sql_string = rtrim($sql_string, ",");
    $sql_string .= ";";
    echo $sql_string;
} else {
  echo json_encode(['msg' => 'No Data!', 'status' => false]);
}

Database::disconnect();

exit();

// https://localhost/sagar/php_programs/postman/fetchsql.php?from=2&to=4
?>
