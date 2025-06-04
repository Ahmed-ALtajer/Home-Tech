<?php
require_once('includes/dbConn.inc.php'); // Make sure the path is correct
$searchTerm = $_GET['search'] ?? ''; // Retrieve the search term from the URL

// SQL to search for products
$stmt = $conn->prepare("SELECT * FROM Product WHERE Name LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="' . htmlspecialchars($row['Picture']) . '" alt="' . htmlspecialchars($row['Name']) . '">';
        echo '<div>' . htmlspecialchars($row['Name']) . '</div>';
        echo '<div>SR ' . number_format($row['Price'], 2) . '</div>';
        echo '</div>';
    }
} else {
    echo 'No results found.';
}
$stmt->close();
?>
