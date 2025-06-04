<?php
// Include the database connection file
require_once('includes/dbConn.inc.php');

// Get the product ID from the URL query string
$productID = isset($_GET['id']) ? intval($_GET['id']) : die('Product ID not specified.');

// Prepare the SQL query to fetch the product data
$sql = "SELECT *, IF(Price < OriginalPrice, (OriginalPrice - Price) / OriginalPrice * 100, 0) AS DiscountPercentage FROM Product WHERE ProductID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productID);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die('Product not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/css/productspec.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= htmlspecialchars($product['Name']) ?> - Store Website</title>
</head>
<body>
    <?php include "header.php"; ?>

    <p style="position: relative; left: 80px; color: gray; font-size: 23px;">home > <?= htmlspecialchars($product['Name']) ?></p>
    
    <h1 style="position: relative; left: 100px; color: black; font-size: 30px; font-family: 'Times New Roman';"><?= htmlspecialchars($product['Name']) ?></h1>
    <div class="content-wrapper">
        <div class="product-image">
            <img src="<?= htmlspecialchars($product['Picture']) ?>" alt="<?= htmlspecialchars($product['Name']) ?>">
        </div>
        <div class="product-details">
            <?php if ($product['Price'] < $product['OriginalPrice']): ?>
                <h2 style="color: red;">SR <?= number_format($product['Price'], 2) ?> <span style="color: gray; text-decoration: line-through;">SR <?= number_format($product['OriginalPrice'], 2) ?></span></h2>
                <h3 style="color: green;">Save <?= round($product['DiscountPercentage']) ?>%</h3>
            <?php else: ?>
                <h2 style="color: red;">SR <?= number_format($product['Price'], 2) ?></h2>
            <?php endif; ?>
            <p>Delivery by 6 Working days approx.</p>
            <form action="addtocart.php" method="post">
                <input type="hidden" name="productID" value="<?= $product['ProductID'] ?>">
                <div class="quantity-add-to-cart">
                    <label for="quantity">Quantity</label>
                    <select id="quantity" name="quantity">
                        <?php for ($i = 1; $i <= $product['Stock']; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="submit" class="add-to-cart-btn">ADD TO CART</button>
                </div>
            </for>
            <div class="key-features">
                <h3>Description</h3>
                <p><?= htmlspecialchars($product['Description']) ?></p>
            </div>
        </div>
    </div>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>
