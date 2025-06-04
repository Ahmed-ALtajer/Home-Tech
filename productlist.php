<?php
require_once('includes/dbConn.inc.php');
require_once('includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/css/productlist.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <title>Store Website</title>
</head>
<body>
<?php include "header.php"; ?>
<div>
    <p class="pph">Home > Televisions</p>
    <p class="ppp"><strong>Tv's</strong></p>
</div>
<br />

<section class="bc">
    <div class="container">
        <section class="filter-section">
            <form id="filterForm" action="productlist.php" method="POST">
                <details>
                    <summary>Tv display</summary>
                    <ul>
                        <li><input type="checkbox" name="display[]" value="OLED"><label>OLED TV</label></li>
                        <li><input type="checkbox" name="display[]" value="LED"><label>LED TV</label></li>
                        <li><input type="checkbox" name="display[]" value="LCD"><label>LCD TV</label></li>
                    </ul>
                </details>
                <details>
                    <summary>Tv Brands</summary>
                    <ul>
                        <li><input type="checkbox" name="brand[]" value="TCL"><label>TCL</label></li>
                        <li><input type="checkbox" name="brand[]" value="SAMSUNG"><label>SAMSUNG</label></li>
                        <li><input type="checkbox" name="brand[]" value="SKYWORTH"><label>SKYWORTH</label></li>
                        <li><input type="checkbox" name="brand[]" value="LG"><label>LG</label></li>
                        <li><input type="checkbox" name="brand[]" value="Supreme"><label>Supreme</label></li>
                    </ul>
                </details>
                <details>
                    <summary>Origin</summary>
                    <ul>
                        <li><input type="checkbox" name="origin[]" value="China"><label>China</label></li>
                        <li><input type="checkbox" name="origin[]" value="Korea"><label>Korea</label></li>
                    </ul>
                </details>
                <button type="submit" name="applyFilter">Apply Filter</button>
            </form>
        </section>

        <div class="product-container">
            <?php
            retrieveProductl($conn);
            ?>
        </div>
    </div>
</section>

<footer>
    <?php include "footer.php"; ?>
</footer>
</body>
</html>
