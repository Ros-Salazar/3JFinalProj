<!--Development(Backend)-->
<?php
/*
    // Connect to database
    include 'database.php';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start user session
    session_start();

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Get data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check with database
        $email_sql = "SELECT * FROM users WHERE email = '$email'";
        $email_result = $conn -> query($email_sql);

        if ($email_result -> num_rows > 0) {
            $row = $email_result -> fetch_assoc();
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Store user information in session
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["full_name"] = $row["full_name"];
                $_SESSION["role"] = $row["role"];

                // Redirect based on user role
                if ($_SESSION['role'] == 'admin') {
                    header("Location: dashboard-admin.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                echo "<br>Incorrect password. Please try again.";
            }
        } else {
            echo "<br>User not found. Please register.";
        }
    }
*/?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/base.css" />
    <link rel="stylesheet" type="text/css" href="css/premium.css" />
    <script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
</head>
<body class="demo-4">
    <main>
        <div class="frame">
            <div class="frame__title-wrap">
                <h1 class="frame__title">Lotus Serenity Spa</h1>
            </div>

            <div class="frame__demos">
					<a href="index.php" class="frame__demo">Home</a>
					<a href="index.php#services-section" class="frame__demo">Services</a>
					<a href="booking.php" class="frame__demo">Booking</a>
					<a href="index.php#footer-premium" class="frame__demo">Contact</a>
            </div>

        </div>
        <div class="content content--canvas">
            <canvas id="canvas"></canvas>
        </div>

        
        <!-- Login Form -->
        <section class="cta-section">
            <div class="container">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-form text-center w-100">
                <h2>Login to Your Account</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" id="show-password">
                    <label class="form-check-label" for="show-password">Show Password</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger mt-3">
                    <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                </form>
                <p class="lead mt-4">Don't have an account? <a href="register.php" class="text-primary">Register</a></p>
            </div>
        </section>



    </main>
    <script src="js/noise.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/coalesce.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('show-password');

        showPasswordCheckbox.addEventListener('change', () => {
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>