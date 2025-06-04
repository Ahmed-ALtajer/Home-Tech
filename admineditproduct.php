<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Products</title>
    <link rel="stylesheet" href="/project/css/admineditproduct.css"> 
</head>
<body>
    <?php require_once('includes/dbConn.inc.php'); ?>

    <div class="header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin! Manage your products below.</p>
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search products..." class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="search-button">🔍</button>
            </form>
        </div>
    </div>

    <div class="product-container">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM product WHERE Name LIKE '%" . $conn->real_escape_string($search) . "%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="' . htmlspecialchars($row["Picture"]) . '" alt="' . htmlspecialchars($row["Name"]) . '" class="product-image">';
                echo '<div class="product-info">';
                echo '<h3>' . htmlspecialchars($row["Name"]) . '</h3>';
                echo '<p>Description: ' . htmlspecialchars($row["Description"]) . '</p>';
                echo '<p>Price: SR ' . htmlspecialchars($row["Price"]) . '</p>';
                if ($row["Discount"] !== null && $row["Discount"] > 0) {
                    echo '<p>Price before discount: SR ' . htmlspecialchars($row["OriginalPrice"]) . '</p>';
                    echo '<p>Price after discount: SR ' . number_format($row["OriginalPrice"] * (1 - $row["Discount"] / 100), 2) . '</p>';
                    echo '<p>Discount: ' . $row["Discount"] . '%</p>';
                }
                echo '<p>Stock: ' . $row["Stock"] . ' units</p>';
                echo '</div>';
                echo '<div class="product-actions">';
                echo '<button class="button edit" onclick="location.href=\'includes/edit.php?id=' . $row["ProductID"] . '\'">Edit</button>';
                echo '<button class="button delete" onclick="confirmDelete(' . $row["ProductID"] . ')">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results found.";
        }
        $conn->close();
        ?>
    </div>
    <script>
        function confirmDelete(id) {
            var modal = document.getElementById('myModal');
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            modal.style.display = "block"; // Show the modal

            // Confirm button inside the modal
            document.getElementById('confirmDelete').onclick = function() {
                performDelete(id);
            };
        }

        function performDelete(id) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'includes/delete.php?id=' + id, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.reload(); // Optionally reload the page or remove the deleted item from the DOM
                }
            }
            xhr.send();
        }
    </script>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to delete this product?</p>
            <button id="confirmDelete">Yes</button>
        </div>
    </div>

</body>
</html>
