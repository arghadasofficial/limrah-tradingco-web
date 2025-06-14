<?php
session_start();
require_once 'utils/db.php';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin-panel.php");
    exit;
}

// Login check
$loggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$loggedIn) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin_logged_in'] = true;
        $loggedIn = true;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Query Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-5">
  <h2 class="text-center mb-4">Admin Panel</h2>

  <?php if (!$loggedIn): ?>
    <div class="row justify-content-center">
      <div class="col-md-6 bg-light text-dark p-4 rounded">
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  <?php else: ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Submitted Queries</h4>
      <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM form_queries ORDER BY created_at DESC");
    if ($result && mysqli_num_rows($result) > 0):
    ?>
      <div class="table-responsive bg-light text-dark rounded">
        <table class="table table-bordered table-hover m-0">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Submitted At</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['subject']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                <td><?= $row['created_at'] ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-warning">No queries found.</div>
    <?php endif; ?>

  <?php endif; ?>
</div>

</body>
</html>
