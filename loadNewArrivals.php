<?php
include 'db_connection.php';

$data = [];
$sql = "CALL GetNewArrivals()";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode(['data' => $data]);
?>
