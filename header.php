<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px;
        }

        .logo img {
            width: 180px;
        }

        .search-bar {
    flex-grow: 1;
    display: flex;
    justify-content: center;
}

.search-bar input[type="text"] {
    width: 80%; 
    padding: 10px; 
    font-size: 16px; 
    border: 2px solid #ccc; 
    border-radius: 4px; 
}

.search-bar button {
    padding: 10px 20px; 
    cursor: pointer;
    background-color: #4CAF50; 
    color: white;
    border: none;
    border-radius: 4px; 
    margin-left: 5px; 
}


        .account {
            display: flex;
            align-items: center;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navigation-bar {
            background-color: black;
            overflow: auto;
            font-weight: 500;
            text-decoration: none;
            margin-left: 40px;
            font-family: Poppins-SemiBold;
        }

            .navigation-bar ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

                .navigation-bar ul li {
                    float: left;
                }

                    .navigation-bar ul li a {
                        display: block;
                        color: white;
                        text-align: center;
                        padding: 14px 16px;
                        text-decoration: none;
                    }

                        .navigation-bar ul li a:hover {
                            background-color: #ffA500;
                                    }
                            .hs{
                                background-color: wheat;
                            }
        </style>
</head>
<body>
<header class="hs">
        <div class="header-container">
            <div class="logo">
                <a href="/project/homepage.php"> <img src="/project/images/imagesnew.png" alt="Logo"></a>
            </div>
            <form action="/project/homepage.php" method="GET">
    <div class="search-bar">
        <input type="text" name="search" placeholder="What are you looking for?" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">🔍</button>
    </div>
</form>

            <div class="account">
                <div class="cart">
                    <a href="/project/cardp.php"><i class="fa-solid fa-cart-shopping"></i>Cart |</a>
                </div>
                <div class="user-account">
                    <div class="dropdown">
                        <button class="dropbtn">My Account ▼</button>
                        <div class="dropdown-content">
                            <a href="sign in page.html">Login/Signup</a>
                            <a href="order page.html">order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="navigation-bar">
        <ul>
            <li><a href="/project/productlist.php">TVs & Entertainment</a></li>
            <li><a href="#">Air Conditioners</a></li>
            <li><a href="#">Large Appliances</a></li>
            <li><a href="#">Small Appliances</a></li>
            
        </ul>
    </nav>
</body>
</html>