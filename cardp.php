<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/css/cardp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />
    <title>Store Website - Cart</title>
</head>
<body>
    <?php
    session_start();
    include "header.php";  // Ensure you have a header.php file to include
    require_once('includes/dbConn.inc.php');

    echo '<h2>Your Shopping Cart</h2>';
    echo '<section class="cart-container">';
    echo '<div class="cart-items">';

    $total = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productID => $quantity) {
            $stmt = $conn->prepare("SELECT ProductID, Name, Price, Picture FROM Product WHERE ProductID = ?");
            $stmt->bind_param("i", $productID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($product = $result->fetch_assoc()) {
                $subtotal = $product['Price'] * $quantity;
                $total += $subtotal;
                echo '<div class="cart-item">';
                echo '<div class="item-image"><img src="' . htmlspecialchars($product['Picture']) . '" alt="' . htmlspecialchars($product['Name']) . '"></div>';
                echo '<div class="item-details">';
                echo '<h3>' . htmlspecialchars($product['Name']) . '</h3>';
                echo '<p>Price: SR ' . number_format($product['Price'], 2) . '</p>';
                echo '<p>Quantity: ' . $quantity . '</p>';
                echo '<p>Subtotal: SR ' . number_format($subtotal, 2) . '</p>';
                echo '</div></div>';
            }
        }
        echo '</div>';  // Close cart-items
        echo '<div class="order-summary">';
        echo '<h2>ORDER SUMMARY</h2>';
        echo '<p>Total Price: SR ' . number_format($total, 2) . '</p>';
        echo '<button class="checkout-button" onclick="location.href=\'checkout.php\'">CHECKOUT NOW</button>';
        echo '</div>';  // Close order-summary
    } else {
        echo "<p>Your cart is empty.</p>";
    }

    echo '</section>';
    include "footer.php";  // Include your footer.php file
    ?>
</body>
</html>