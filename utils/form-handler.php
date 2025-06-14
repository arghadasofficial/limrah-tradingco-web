<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name    = mysqli_real_escape_string($conn, trim($_POST['name'] ?? ''));
  $email   = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
  $phone   = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));
  $subject = mysqli_real_escape_string($conn, trim($_POST['subject'] ?? ''));
  $message = mysqli_real_escape_string($conn, trim($_POST['message'] ?? ''));

  if (empty($name) || empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Name and Email are required.']);
    exit;
  }

  $query = "INSERT INTO form_queries (name, email, phone, subject, message)
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";

  if (mysqli_query($conn, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Thank you! Your query has been submitted.']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again.']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
