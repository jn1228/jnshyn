```php
<?php
session_start();
require 'dbcon.php';

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    $_SESSION['message'] = "Please login to access the system";
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BSIS 3rd Year - Student Management</title>

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
            padding: 35px 0;
        }

        .container {
            max-width: 1250px;
        }

        .page-title {
            color: #312e81;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 12px 35px rgba(31, 41, 55, 0.13);
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
            padding: 28px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 9px 15px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: #ffffff;
            color: #4f46e5;
        }

        .btn-primary:hover {
            background: #eef2ff;
            color: #4338ca;
        }

        .btn-info {
            background: #0ea5e9;
            color: white;
        }

        .btn-info:hover {
            background: #0284c7;
            color: white;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: white;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
            min-width: 750px;
        }

        .table thead th {
            background: #eef2ff;
            color: #3730a3;
            padding: 16px 12px;
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
            border-bottom: 2px solid #c7d2fe;
        }

        .table tbody td {
            padding: 14px 12px;
            color: #374151;
            font-size: 14px;
        }

        .table tbody tr {
            transition: background 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f5f3ff;
        }

        .student-count {
            display: inline-block;
            background: #ede9fe;
            color: #5b21b6;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            padding: 7px 11px;
            font-size: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 35px 15px !important;
            color: #6b7280 !important;
        }

        .alert {
            border: none;
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            body {
                padding: 20px 0;
            }

            .card-header,
            .card-body {
                padding: 20px;
            }

            .card-header h4 {
                font-size: 19px;
            }

            .card-header .btn {
                font-size: 12px;
                padding: 8px 10px;
            }

            .page-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Page Heading -->
    <div class="mb-4">
        <h2 class="page-title">🎓 Student Management System</h2>
        <p class="page-subtitle">
            BSIS 3rd Year | Manage student information in one place.
        </p>
    </div>

    <!-- Session Messages -->
    <?php include('message.php'); ?>

    <div class="card">

        <div class="card-header">
            <h4>
                BSIS 3rd Year

                <a href="student-create.php" class="btn btn-primary float-end">
                    + Add Students
                </a>
            </h4>
        </div>

        <div class="card-body">

            <?php
            $query = "SELECT * FROM students ORDER BY id DESC";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                $total_students = mysqli_num_rows($query_run);
            ?>

            <div class="student-count">
                Total Students: <?= $total_students; ?>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    if ($total_students > 0) {
                        while ($student = mysqli_fetch_assoc($query_run)) {
                    ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars((string)$student['id']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['name']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['email']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['phone']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['course']); ?>
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a
                                        href="student-view.php?id=<?= urlencode((string)$student['id']); ?>"
                                        class="btn btn-info"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="student-edit.php?id=<?= urlencode((string)$student['id']); ?>"
                                        class="btn btn-success"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="code.php"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this student?');"
                                    >
                                        <button
                                            type="submit"
                                            name="delete_student"
                                            value="<?= htmlspecialchars((string)$student['id']); ?>"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="6" class="empty-state">
                                <h5>No Student Records Found</h5>
                                <p class="mb-0">
                                    Click the Add Students button to register a student.
                                </p>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <?php
            } else {
                echo '<div class="alert alert-danger">Unable to load students. Please check your database query.</div>';
            }
            ?>

        </div>
    </div>

    <p class="text-center mt-4 text-secondary small">
        Student Management System &copy; 2026
    </p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
