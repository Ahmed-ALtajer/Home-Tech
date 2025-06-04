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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the POST request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $originalPrice = $_POST['originalPrice'];
    $discount = $_POST['discount'];
    $stock = $_POST['stock'];
    $picture = $_POST['picture'];

    // Prepare SQL statement to update product
    $sql = "UPDATE product SET Name=?, Description=?, Price=?, OriginalPrice=?, Discount=?, Stock=?, Picture=? WHERE ProductID=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssddiisi", $name, $description, $price, $originalPrice, $discount, $stock, $picture, $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Product updated successfully.";
        } else {
            echo "No changes were made.";
        }
        $stmt->close();
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $conn->close();
    header("Location: /project/admineditproduct.php"); // Adjust the redirect location as needed
    exit();
} else {
    // Display the form
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $sql = "SELECT * FROM product WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }

    if (!$product) {
        echo "No product found";
        exit();
    } else {
        ?>
        <h1>Edit Product</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['ProductID']); ?>">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>"><br>
            <label>Description:</label><br>
            <textarea name="description"><?php echo htmlspecialchars($product['Description']); ?></textarea><br>
            <label>Price:</label><br>
            <input type="number" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>"><br>
            <label>Original Price:</label><br>
            <input type="number" name="originalPrice" value="<?php echo htmlspecialchars($product['OriginalPrice']); ?>"><br>
            <label>Discount (%):</label><br>
            <input type="number" name="discount" value="<?php echo htmlspecialchars($product['Discount']); ?>"><br>
            <label>Stock:</label><br>
            <input type="number" name="stock" value="<?php echo htmlspecialchars($product['Stock']); ?>"><br>
            <label>Picture:</label><br>
            <input type="text" name="picture" value="<?php echo htmlspecialchars($product['Picture']); ?>"><br>
            <button type="submit">Save Changes</button>
        </form>
        <?php
    }
}
?>
