<?php
include '../components/connection.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT DISTINCT cuisine_type FROM products WHERE cuisine_type LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $suggestions = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode($suggestions);
}
?>
