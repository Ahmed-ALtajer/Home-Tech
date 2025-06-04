<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, input, button { font-family: 'Poppins', sans-serif; }
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #1f2533; color: #fff; }
        form { background: #2c3445; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input, button { width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 2px solid white; }
        button { background: #4CAF50; color: white; cursor: pointer; }
        input[type="checkbox"] { width: auto; }
        a { color: #FFA500; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .success-message { color: #4CAF50; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <?php
    require_once 'signup.inc.php';
    $message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
    unset($_SESSION['success_message']);
    ?>
    <form action="newsignupphp.php" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Re-enter password" required>
        <input type="text" name="mobile" placeholder="Mobile (e.g., 05XXXXXXXX)" required>
        <input type="text" name="address" placeholder="Address" required>
        <div>
            <input type="checkbox" id="updates">
            <label for="updates">Receive updates about our products via email.</label>
        </div>
        <div>
            <input type="checkbox" id="terms" required>
            <label for="terms">Agree to terms and conditions.</label>
        </div>
        <button type="submit" name="submit">Sign Up</button>
        <p>Already have an account? <a href="/project/signin.html">Login here</a></p>
        <?php if (!empty($message)): ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
