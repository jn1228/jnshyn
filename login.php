```php
<?php
session_start();

// Hardcoded credentials
$admin_email = "Admin";
$admin_pass  = "admin123";

if (isset($_POST['login_btn'])) {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === $admin_email && $password === $admin_pass) {

        session_regenerate_id(true);

        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_name' => "Administrator",
            'user_email' => $admin_email,
        ];

        $_SESSION['message'] = "Welcome Administrator";

        header("Location: index.php");
        exit();

    } else {

        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: login.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #dbeafe, #e9d5ff, #fce7f3);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
        }

        .login-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(31, 41, 55, 0.18);
        }

        .card-header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            text-align: center;
            padding: 35px 25px;
            border: none;
        }

        .login-icon {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            border: 2px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 15px;
        }

        .card-header h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .card-body {
            padding: 32px;
        }

        .form-label {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            height: 48px;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .mb-3 {
            margin-bottom: 22px !important;
        }

        .btn-login {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            transition: 0.3s ease;
        }

        .btn-login:hover {
            color: white;
            background: linear-gradient(135deg, #4338ca, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(79, 70, 229, 0.25);
        }

        .login-footer {
            text-align: center;
            margin-top: 22px;
            color: #6b7280;
            font-size: 13px;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 25px 20px;
            }

            .card-header {
                padding: 28px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- Session Message -->
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-info" role="alert">'
            . htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')
            . '</div>';

        unset($_SESSION['message']);
    }
    ?>

    <div class="card login-card">

        <div class="card-header">
            <div class="login-icon">🔐</div>
            <h3>Admin Login</h3>
            <p>Student Management System</p>
        </div>

        <div class="card-body">

            <form action="" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Admin Username
                    </label>

                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter admin username"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button
                    type="submit"
                    name="login_btn"
                    class="btn btn-login"
                >
                    Login →
                </button>

            </form>

            <div class="login-footer">
                Student Management System © 2026
            </div>

        </div>
    </div>
</div>

</body>
</html>
