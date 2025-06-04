<?php
$serverName = "localhost:3307";
$dbName = "hstore";
$userName = "root";
$password = "";

// Connect to the database
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the product ID is received
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE ProductID = ?";

    // Prepare the SQL statement for execution
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . mysqli_error($conn));
    }

    // Bind the integer ID to the prepared statement
    $stmt->bind_param("i", $id);
    // Execute the statement
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        $message = "Product deleted successfully!";
    } else {
        $message = "Error deleting record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the specified path with a message parameter
    header("Location: /project/admineditproduct.php?message=" . urlencode($message));
    exit();
} else {
    // Redirect back if no product ID provided
    header("Location: /project/admineditproduct.php?message=" . urlencode("No product ID provided."));
    exit();
}
?>
