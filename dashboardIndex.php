<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    
</head>
<body>
<div class="container3">
    <header>
        <div class = "container">
            <h1>Dolphin CRM</h1>
        </div>
    </header>


    <main>
        <div class = "container1">
            <h2>Dashboard</h2>
            <button id="addContactsBtn"> Add Contact</button>
        </div>
    </main>

    <section>
        <div class = "contained">
            <p>Filter BY:</p>
            <button id="allBtn">All</button>
            <button id="salesBtn">SalesLeads</button>
            <button id="supportBtn">Support</button>
            <button id="assignBtn">Assigned to me</button>
        </div>

        <div class = "container" id = "contactList">
            <!--Table should go here-->
        </div>
    </section>

    <aside>
        <div class = "side">
            <br><br>
            <a href="./dashboardIndex.php">Home</a>
            <br><br>
            <a href="./newContact.html">New Contact</a>
            <br><br>
            <a href="./userList.html">Users</a>
            <br><br>
        </div>
        <hr>
        <div>
            <button id="logoutBtn">Logout</button>
        </div>
    </aside>
</div>
<?php
// Start or resume the session
session_start();

// Check if the email is set in the session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    // If the email is not set, redirect back to the login page
    header("Location: loginIndex.php");
    exit();
}

?>
<script src="dashboard.js"></script>
</body>
</html>