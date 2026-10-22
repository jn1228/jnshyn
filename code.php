<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course' WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['save_student'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $query = "INSERT INTO students (name, email, phone, course) VALUES ('$name','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $student_id = mysqli_insert_id($con);

        // Handle subjects
        $codes = $_POST['subject_code'];
        $names = $_POST['subject_name'];
        $units = $_POST['units'];
       

        for ($i = 0; $i < count($codes); $i++) {
            $code = $codes[$i];
            $subname = $names[$i];
            $unit = $units[$i];
           

            $sub_query = "INSERT INTO student_subjects (student_id, subject_code, subject_name, units ) 
                          VALUES ('$student_id', '$code', '$subname', '$unit')";
            mysqli_query($con, $sub_query);
        }

        $_SESSION['message'] = "Student and subjects saved successfully!";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header("Location: create-student.php");
        exit(0);
    }
}
?>