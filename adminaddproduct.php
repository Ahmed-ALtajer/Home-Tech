<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/css/adminaddproduct.css">
    <title>Store Website</title>
</head>
<body>
<div class="header">
<a href="/project/homepage.php" class="logo"> <img src="/project/images/imagesnew.png" alt="Logo"></a>
        <div>
            <a href="/dashboard" class="button-link">Dashboard</a>
            <a href="/logout" class="button-link">Logout</a>
        </div>
    </div>

    <div class="form-container">
        <form id="addProductForm" action="includes/addproduct.php" method="POST" enctype="multipart/form-data" target="hiddenFrame">
            <div class="form-group">
                <label for="Name">Product Name:</label>
                <input type="text" id="Name" name="Name" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price:</label>
                <input type="number" id="productPrice" name="Price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="Discount">Discount (%):</label>
                <input type="number" id="Discount" name="Discount">
            </div>
            <div class="form-group">
                <label for="Image">Product Image:</label>
                <input type="file" id="Image" name="Image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="categoryID">Category:</label>
                <select id="categoryID" name="categoryID" required onchange="showOptions()">
                    <option value="">Select Category</option>
                    <option value="1">Electronics</option>
                    <option value="2">Appliances</option>
                    <option value="3">Kitchen Gadgets</option>
                    <option value="4">Television</option>
                </select>
            </div>
            <div class="form-group" id="brandGroup" style="display: none;">
                <label for="brand">Brand:</label>
                <select id="brand" name="Brand">
                    <option value="">Select Brand</option>
                    <option value="1">TCL</option>
                    <option value="2">SAMSUNG</option>
                    <option value="3">SKYWORTH</option>
                    <option value="4">LG</option>
                    <option value="5">Supreme</option>
                </select>
            </div>
            <div class="form-group" id="originGroup" style="display: none;">
                <label for="origin">Origin:</label>
                <select id="origin" name="Origin">
                    <option value="">Select Origin</option>
                    <option value="1">China</option>
                    <option value="2">Korea</option>
                </select>
            </div>
            <div class="form-group" id="displayGroup" style="display: none;">
                <label for="display">Display:</label>
                <select id="display" name="Display">
                    <option value="">Select Display</option>
                    <option value="1">OLED</option>
                    <option value="2">LED</option>
                    <option value="3">LCD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Stock Quantity:</label>
                <input type="number" id="stock" name="Stock" required>
            </div>
            <div class="form-group">
                <label for="Description">Product Description:</label>
                <textarea id="Description" name="Description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Add Product</button>
            </div>
        </form>
        <iframe id="hiddenFrame" name="hiddenFrame" style="display: none;"></iframe>
        <a href="/project/admineditproduct.php" class="button-link">View All Products</a>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Product added successfully!</p>
        </div>
    </div>

    <script>
        function showOptions() {
            var category = document.getElementById("categoryID").value;
            var brandGroup = document.getElementById("brandGroup");
            var originGroup = document.getElementById("originGroup");
            var displayGroup = document.getElementById("displayGroup");

            if (category === "4") { // Check if the selected category is "Television"
                brandGroup.style.display = "block";
                originGroup.style.display = "block";
                displayGroup.style.display = "block";
            } else {
                brandGroup.style.display = "none";
                originGroup.style.display = "none";
                displayGroup.style.display = "none";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName("close")[0];
    var form = document.getElementById('addProductForm');

    span.onclick = function() {
        modal.style.display = "none";
        form.reset(); // Reset form fields after closing the modal
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            form.reset(); // Reset form fields after closing the modal
        }
    };

    form.addEventListener('submit', function() {
        setTimeout(function() { 
            modal.style.display = "block";
        }, 500); // Adjust timing as needed
    });
});
    </script>
</body>
</html>
