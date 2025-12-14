<?php
session_start();
include "koneksi.php"; // koneksi ke database

$error = "";

// Cek apakah form login dikirim
if(isset($_POST['login'])){
    // Ambil input user dengan aman
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Query ke database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

        // Pastikan kolom password ada di database
        if(isset($row['password']) && password_verify($password, $row['password'])){
            $_SESSION['admin'] = $row['username'];
            header("Location: index.html");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body { 
    background: linear-gradient(135deg, #ffdde1 0%, #ee9ca7 100%);
    font-family: 'Nunito', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-container { 
    width: 100%;
    max-width: 400px;
    animation: fadeIn 1s ease-in-out;
}
.card { 
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    background: #ffffffdd;
    padding: 2.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.25);
}
h3 {
    font-weight: 700;
    color: #d63384;
    text-align: center;
}
.form-control {
    border-radius: 15px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    border: 1px solid #f0c1d1;
    transition: 0.3s;
}
.form-control:focus {
    border-color: #d63384;
    box-shadow: 0 0 10px rgba(214, 51, 132, 0.2);
}
.btn-success {
    background: linear-gradient(45deg, #ff6fa3, #d63384);
    border: none;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 50px;
    padding: 0.75rem;
    transition: 0.3s;
}
.btn-success:hover {
    background: linear-gradient(45deg, #d63384, #b5175b);
    transform: scale(1.05);
}
.form-check-label {
    font-size: 0.9rem;
    color: #555;
}
.alert-danger {
    border-radius: 15px;
    font-weight: 500;
    text-align: center;
    background-color: #ffe3ed;
    color: #d63384;
    border: 1px solid #f5c6d1;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px);}
    to { opacity: 1; transform: translateY(0);}
}
@media(max-width: 576px){
    .card { padding: 2rem; }
}
</style>
</head>
<body>

<div class="login-container">
    <div class="card shadow">
        <h3>Login Admin</h3>

        <?php if($error != ""): ?>
            <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <div class="d-grid">
                <button type="submit" name="login" class="btn btn-success btn-lg">Login</button>
            </div>
        </form>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
