<?php
session_start();
require_once('includes/dbConn.inc.php');

$productID = isset($_POST['productID']) ? intval($_POST['productID']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($productID == 0) {
    die("Product ID is not specified or invalid.");
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Debugging output
echo "Adding Product ID: $productID with Quantity: $quantity<br>";

// Check if the product already exists in the cart
if (isset($_SESSION['cart'][$productID])) {
    $_SESSION['cart'][$productID] += $quantity;
} else {
    $_SESSION['cart'][$productID] = $quantity;
}

echo "Current Cart: ";
print_r($_SESSION['cart']);

// Redirect or link back to product page or cart page
header('Location: cardp.php');
exit;
?>
