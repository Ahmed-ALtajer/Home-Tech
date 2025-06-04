<?php

// Database connection parameters
$serverName = "localhost:3307";
$dbName = "hstore";
$userName = "root";
$password = "";

// Create connection
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $prodName = $conn->real_escape_string($_POST['Name']);
    $productPrice = (float)$_POST['Price'];
    $productDiscount = isset($_POST['Discount']) && $_POST['Discount'] !== "" ? (float)$_POST['Discount'] : NULL;
    $categoryID = (int)$_POST['categoryID'];
    $stockQuantity = (int)$_POST['Stock'];
    $productDescription = $conn->real_escape_string($_POST['Description']);

    // Calculate the original price before discount
    $originalPrice = NULL; // Default to NULL if no discount is applied
    if ($productDiscount !== NULL) {
        $originalPrice = $productPrice - ($productPrice * ($productDiscount / 100));
    }

    // Handle file upload
    $targetDir = "/project/images/";
    $fileName = basename($_FILES["Image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Create the directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Validate file type
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFilePath)) {
            $brand = $origin = $display = '';  // Initialize for optional fields

            if ($categoryID == 4) {  // Handling for category "Television"
                $brand = $conn->real_escape_string($_POST['Brand']);
                $origin = $conn->real_escape_string($_POST['Origin']);
                $display = $conn->real_escape_string($_POST['Display']);
            }

            // Prepare SQL statement
            $sql = "INSERT INTO Product (Name, Price, OriginalPrice, Discount, Picture, CategoryID, Stock, Description, Brand, Origin, Display)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sddississss', $prodName, $originalPrice, $productPrice, $productDiscount, $targetFilePath, $categoryID, $stockQuantity, $productDescription, $brand, $origin, $display);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                echo "<script>parent.localStorage.setItem('added', 'true');</script>";
            } else {
                echo "<script>parent.alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>parent.alert('Error uploading file.');</script>";
        }
    } else {
        echo "<script>parent.alert('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
    }
}

// Close connection
$conn->close();
?>
