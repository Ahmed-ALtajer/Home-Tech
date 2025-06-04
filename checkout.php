<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/project/css/checkout.css">
</head>
<body>
<?php
session_start();
include "header.php";
require_once('includes/dbConn.inc.php');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $quantity) {
        $stmt = $conn->prepare("SELECT Price FROM Product WHERE ProductID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $total += $row['Price'] * $quantity;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare to insert the order into the database
        $stmt = $conn->prepare("INSERT INTO `order` (CartID, TotalPrice, CheckoutDate) VALUES (?, ?, CURDATE())");
        $cartID = $_SESSION['cartID'] ?? null; // Assuming you manage cart IDs in your session
        $stmt->bind_param("id", $cartID, $total);
        if ($stmt->execute()) {
            // Clear the cart after successful checkout
            unset($_SESSION['cart']);
            echo "<p>Thank you for your purchase! Your order has been placed.</p>";
        } else {
            echo "<p>Error processing your order.</p>";
        }
    }
}
?>
        <br />
        <section>
            <h2 style="color:blue;">Checkout</h2>
            <div class="row">
                <div class="col-75">
                    <div class="container">
                        <form action="checkout.php" method="post">
                            <div class="row">
                                <div class="col-50">
                                    <h3>Billing Address</h3>
                                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                    <input type="text" id="fname" name="name" placeholder="John Doe">
                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                    <input type="text" id="email" name="email" placeholder="john@example.com">
                                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city" placeholder="New York">
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="state">State</label>
                                            <input type="text" id="state" name="state" placeholder="NY">
                                        </div>
                                        <div class="col-50">
                                            <label for="zip">Zip</label>
                                            <input type="text" id="zip" name="zip" placeholder="10001">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-50">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <select id="payment" name="mc" required>
                                        <option value="Master Card">Master Card</option>
                                        <option value="Mada">Mada</option>
                                        <option value="Visa">Visa</option>
                                        <option value="American Express">American express</option>
                                    </select>
                                    <label for="cname">Name on Card</label>
                                    <input type="text" id="cname" name="nc" placeholder="John More Doe">
                                    <label for="ccnum">Credit card number</label>
                                    <input type="text" id="ccnum" name="cn" placeholder="1111-2222-3333-4444">
                                    <label for="expmonth">Exp Month</label>
                                    <input type="text" id="expmonth" name="em" placeholder="September">
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="expyear">Exp Year</label>
                                            <input type="text" id="expyear" name="ey" placeholder="2028">
                                        </div>
                                        <div class="col-50">
                                            <label for="cvv">CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="352">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                            <input type="submit" value="checkout" class="btn" name="submit">
                        </form>
                    </div>
                </div>
                <div class="col-25">
                    <div class="container">
                        <p>Total <span class="price" style="color:black"><b><?php echo $total; ?> SR</b></span></p>
                    </div>
                </div>
            </div>
        </section>
        <?php include "footer.php"; ?>
    </body>
    </html>
