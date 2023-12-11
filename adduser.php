<?php
session_start();

// Dummy admin data (replace with a database in a real scenario)
$admin = [
    'admin@example.com' => 'adminpassword',
];

// Dummy user data (replace with a database in a real scenario)
$users = [
    'admin@example.com' => [
        'password' => password_hash('adminpassword', PASSWORD_DEFAULT),
        'role' => 'Admin',
    ],
];

// Check if the admin is logged in
if (!isset($_SESSION['admin']) || !array_key_exists($_SESSION['admin'], $admin)) {
    // Redirect to the login page if not logged in as an admin
    header('Location: login.php');
    exit;
}

// Check if the new user form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];
    $newRole = $_POST['new_role'];

    // Validate and sanitize input fields
    $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
    $newRole = ($newRole === 'Admin') ? 'Admin' : 'Member';

    // Validate password using regular expressions
    $passwordPattern = '/^(?=.[A-Za-z])(?=.\d)(?=.*[A-Z]).{8,}$/';
    if (!preg_match($passwordPattern, $newPassword)) {
        $error = 'Password must have at least one number, one letter, one capital letter, and be at least 8 characters long.';
    } else {
        // Hash the password before storing in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Add the new user to the user array (replace with database insert in real scenario)
        $users[$newEmail] = [
            'password' => $hashedPassword,
            'role' => $newRole,
        ];

        // Provide feedback to the user
        $successMessage = 'New user added successfully!';
    }
}
?>`