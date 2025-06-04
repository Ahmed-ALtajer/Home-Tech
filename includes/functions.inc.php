<?php

function retrieveProducts($conn, $search = '') {
    $search = "%{$search}%";
    $excludedCategoryId = 4; // Category ID to exclude
    $stmt = $conn->prepare("SELECT *, (OriginalPrice - Price) / OriginalPrice * 100 AS DiscountPercentage, ProductID FROM Product WHERE Name LIKE ? AND CategoryID != ?");
    $stmt->bind_param("si", $search, $excludedCategoryId);
    $stmt->execute();
    $result = $stmt->get_result();

   
    while ($row = mysqli_fetch_assoc($result)) {
        // Each product card wrapped with a link to its specific product page
        $productID = $row['ProductID'];
        echo '<a href="/project/productspec.php?id=' . $productID . '" style="text-decoration:none;"> 
                <div class="product-card" style="border: solid;">
                    <img src="' . htmlspecialchars($row['Picture']) . '" alt="' . htmlspecialchars($row['Name']) . '" class="product-image">
                    <div class="product-info">
                        <div class="product-title">' . htmlspecialchars($row['Name']) . '</div>
                        <div class="product-price">SR ' . number_format($row['Price'], 2) . '</div>';
        if ($row['Price'] < $row['OriginalPrice']) { // Display only if there is a valid discount
            echo '<div class="product-original-price">SR ' . number_format($row['OriginalPrice'], 2) . '</div>
                  <div class="product-discount-tag">OFF ' . round($row['DiscountPercentage']) . '%</div>';
        }
        echo '      </div>
                </div>
              </a>';
    }
    
    $stmt->close();
}






function retrieveProductl($conn) {
    $sql = "SELECT *, (OriginalPrice - Price) / OriginalPrice * 100 AS DiscountPercentage FROM Product WHERE CategoryID = 4";

    $params = []; // Array to hold dynamic parameters for binding
    $types = '';  // String to hold the types of bind parameters
    
    $conditions = [];

    if (!empty($_POST['origin'])) {
        $origins = array_map(function($item) use ($conn) {
            return mysqli_real_escape_string($conn, $item);
        }, $_POST['origin']);
        $conditions[] = "Origin IN (" . str_repeat('?,', count($origins) - 1) . '?)';
        $params = array_merge($params, $origins);
        $types .= str_repeat('s', count($origins));
    }

    if (!empty($_POST['display'])) {
        $displays = array_map(function($item) use ($conn) {
            return mysqli_real_escape_string($conn, $item);
        }, $_POST['display']);
        $conditions[] = "Display IN (" . str_repeat('?,', count($displays) - 1) . '?)';
        $params = array_merge($params, $displays);
        $types .= str_repeat('s', count($displays));
    }

    if (!empty($_POST['brand'])) {
        $brands = array_map(function($item) use ($conn) {
            return mysqli_real_escape_string($conn, $item);
        }, $_POST['brand']);
        $conditions[] = "Brand IN (" . str_repeat('?,', count($brands) - 1) . '?)';
        $params = array_merge($params, $brands);
        $types .= str_repeat('s', count($brands));
    }

    if (!empty($conditions)) {
        $sql .= " AND " . implode(' AND ', $conditions);
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return;
    }
    
    // Bind parameters if there are conditions
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($result)) {
        // Each product card wrapped with a link to its specific product page
        $productID = $row['ProductID'];
        echo '<a href="/project/productspec.php?id=' . $productID . '" style="text-decoration:none;"> 
                <div class="product-card" style="border: solid;">
                    <img src="' . htmlspecialchars($row['Picture']) . '" alt="' . htmlspecialchars($row['Name']) . '" class="product-image">
                    <div class="product-info">
                        <div class="product-title">' . htmlspecialchars($row['Name']) . '</div>
                        <div class="product-price">SR ' . number_format($row['Price'], 2) . '</div>';
        if ($row['Price'] < $row['OriginalPrice']) { // Display only if there is a valid discount
            echo '<div class="product-original-price">SR ' . number_format($row['OriginalPrice'], 2) . '</div>
                  <div class="product-discount-tag">OFF ' . round($row['DiscountPercentage']) . '%</div>';
        }
        echo '      </div>
                </div>
              </a>';
    }

    $stmt->close();
}








?>


