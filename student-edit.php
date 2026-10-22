```php
<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Edit</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #dbeafe, #e9d5ff, #fce7f3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 700px;
            padding: 30px 15px;
        }

        .card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 12px 35px rgba(31, 41, 55, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 24px 28px;
            border: none;
        }

        .card-header h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .card-body {
            padding: 30px;
        }

        .form-label,
        label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .mb-3 {
            margin-bottom: 22px !important;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 9px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #6d28d9);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            border: none;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .card-body h4 {
            color: #dc2626;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px 12px;
            }

            .card-header,
            .card-body {
                padding: 22px;
            }

            .card-header h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h4>
                        ✏️ Student Edit
                        <a href="index.php" class="btn btn-danger float-end">
                            ← BACK
                        </a>
                    </h4>
                </div>

                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {

                        $student_id = mysqli_real_escape_string(
                            $con,
                            $_GET['id']
                        );

                        $query = "SELECT * FROM students WHERE id='$student_id'";
                        $query_run = mysqli_query($con, $query);

                        if ($query_run && mysqli_num_rows($query_run) > 0) {

                            $student = mysqli_fetch_assoc($query_run);
                    ?>

                    <form action="code.php" method="POST">

                        <input
                            type="hidden"
                            name="student_id"
                            value="<?= htmlspecialchars($student['id']); ?>"
                        >

                        <div class="mb-3">
                            <label for="name">Student Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($student['name']); ?>"
                                class="form-control"
                                placeholder="Enter student name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email">Student Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars($student['email']); ?>"
                                class="form-control"
                                placeholder="Enter student email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="phone">Student Phone</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="<?= htmlspecialchars($student['phone']); ?>"
                                class="form-control"
                                placeholder="Enter phone number"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="course">Student Course</label>
                            <input
                                type="text"
                                id="course"
                                name="course"
                                value="<?= htmlspecialchars($student['course']); ?>"
                                class="form-control"
                                placeholder="Enter student course"
                                required
                            >
                        </div>

                        <div class="d-grid">
                            <button
                                type="submit"
                                name="update_student"
                                class="btn btn-primary"
                            >
                                💾 Update Student
                            </button>
                        </div>

                    </form>

                    <?php
                        } else {
                            echo '<h4>No Such ID Found</h4>';
                        }

                    } else {
                        echo '<h4>Student ID is missing.</h4>';
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
