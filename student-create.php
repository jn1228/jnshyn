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

    <title>Create Student</title>

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
            padding: 30px 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #dbeafe, #e9d5ff, #fce7f3);
        }

        .container {
            max-width: 850px;
        }

        .card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
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

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 600;
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

        hr {
            margin: 30px 0 22px;
            border-color: #e5e7eb;
        }

        .section-title {
            color: #4f46e5;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .subject-field {
            background: #f9fafb;
            padding: 15px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin: 0 0 15px;
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

        .btn-success {
            background: #10b981;
            border: none;
        }

        .btn-success:hover {
            background: #059669;
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

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
        }

        .subject-field .form-control {
            background: white;
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 12px;
            }

            .card-header,
            .card-body {
                padding: 22px;
            }

            .card-header h4 {
                font-size: 20px;
            }

            .subject-field [class*="col-"] {
                margin-bottom: 8px;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <?php include('message.php'); ?>

    <div class="card">

        <div class="card-header">
            <h4>
                🎓 Add Student
                <a href="index.php" class="btn btn-danger float-end">
                    ← BACK
                </a>
            </h4>
        </div>

        <div class="card-body">

            <form action="code.php" method="POST">

                <!-- Student Details -->
                <h5 class="section-title">👤 Student Information</h5>

                <div class="mb-3">
                    <label for="name">Student Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Enter full name"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email">Student Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter email address"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="phone">Student Phone</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
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
                        class="form-control"
                        placeholder="Enter course"
                        required
                    >
                </div>

                <hr>

                <!-- Subjects -->
                <h5 class="section-title">📚 Student Subjects</h5>

                <div id="subjects-area">

                    <div class="row g-2 subject-field">

                        <div class="col-md-4">
                            <label>Subject Code</label>
                            <input
                                type="text"
                                name="subject_code[]"
                                class="form-control"
                                placeholder="e.g. IT101"
                                required
                            >
                        </div>

                        <div class="col-md-5">
                            <label>Subject Name</label>
                            <input
                                type="text"
                                name="subject_name[]"
                                class="form-control"
                                placeholder="Enter subject name"
                                required
                            >
                        </div>

                        <div class="col-md-3">
                            <label>Units</label>
                            <input
                                type="number"
                                name="units[]"
                                class="form-control"
                                placeholder="Units"
                                min="1"
                                required
                            >
                        </div>

                    </div>

                </div>

                <div class="form-actions">

                    <button
                        type="button"
                        class="btn btn-success"
                        onclick="addSubject()"
                    >
                        + Add Subject
                    </button>

                    <button
                        type="submit"
                        name="save_student"
                        class="btn btn-primary"
                    >
                        💾 Save Student
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
function addSubject() {
    const div = document.createElement('div');

    div.className = 'row g-2 subject-field';

    div.innerHTML = `
        <div class="col-md-4">
            <label>Subject Code</label>
            <input
                type="text"
                name="subject_code[]"
                class="form-control"
                placeholder="e.g. IT102"
                required
            >
        </div>

        <div class="col-md-5">
            <label>Subject Name</label>
            <input
                type="text"
                name="subject_name[]"
                class="form-control"
                placeholder="Enter subject name"
                required
            >
        </div>

        <div class="col-md-3">
            <label>Units</label>
            <input
                type="number"
                name="units[]"
                class="form-control"
                placeholder="Units"
                min="1"
                required
            >
        </div>

        <div class="col-12 text-end mt-2">
            <button
                type="button"
                class="btn btn-danger btn-sm"
                onclick="this.closest('.subject-field').remove()"
            >
                ✖ Remove Subject
            </button>
        </div>
    `;

    document.getElementById('subjects-area').appendChild(div);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
