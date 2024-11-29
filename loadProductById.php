<?php
include 'db_connection.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = [];

if ($product_id > 0) {
    // Prepare and call the stored procedure
    $sql = "CALL GetProductById(?)";
    $stmt = $conn->prepare($sql);

    // Bind the product ID as a parameter
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        // Fetch product details
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    // Close the statement
    $stmt->close();
} else {
    $data['error'] = 'Invalid product ID.';
}

// Close the connection
$conn->close();

// Output the data in JSON format
echo json_encode(['data' => $data]);
?>
