<?php
require_once 'functions.php';
//Connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dolphin_crm';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$email=$_GET['email'];




$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$contact;
$notesRetrieved;

if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{

    echo("Connected to Database");

    try{
        $stmt = $conn->prepare("SELECT * FROM Contacts WHERE email=?;");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        // Fetch the user from the database
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        $contactidNum=$contact['id'];

        
        //Data from Database
        $stmt1 = $conn->prepare("SELECT Users.firstname,Users.lastname,Notes.comment FROM Notes INNER JOIN Users ON Notes.created_by=Users.id WHERE contact_id=?;");
        $stmt1->bindParam(1, $contactidNum);
        $stmt1->execute();
        // Fetch the user from the database
        $notesRetrieved = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        echo("There was an error");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="contactDetails.css">
</head>
<body>
<div class="container5">
    <header>
        <h1>Dolphin CRM</h1>
    </header>

    <main>
        <div class="container">
            
            <p id="name"><?php echo($contact['title'] ." " . $contact['firstname'] ." ". $contact['lastname'] );?></p>
            
            <p id="createdOn"><?php echo($contact['created_at']);?></p>
            
            <p id="updatedOn"><?php echo($contact['updated_at']);?></p>
        </div>
        <div class="container1">
            <label for="Email">Email</label>
            <p id="email"><?php echo($contact['email']);?></p>
            <br>
            <label for="phone">Telephone</label>
            <p id="phone"><?php echo($contact['telephone']);?></p>
            <br>
            <label for="company">Company</label>
            <p id="company"><?php echo($contact['company']);?></p>
            <br>
            <label for="assignedTo">Assigned To</label>
            <p id="assignedTo"><?php echo($contact['assigned_to']);?></p>
            <br>
        </div>
        <div class="container2">
            <label for="tnotes">Notes</label>
            <br>
            <div id="notes">
            <?php 
            if(isset($notesRetrieved)){
                foreach ($notesRetrieved as $n){
                    echo ($n['firstname'] ." ". $n['lastname']);
                    echo ("<br>");
                    echo ($n['comment']);
                    echo ("<br>");
                }
            }
            else{
                echo(" No Notes Available");
                echo ("<br>");
            }
            
            ?>
            
            </div>
        </div>
        <br>
        <div>
            
            <form action="addNote.php" method="post">
                <label for="createNote">Add Note below</label>
                <input type="text" id="fixed" name="fixed" value="<?php echo($contact['email']);?>" readonly>
                <br>
                <input type="text" name="createNote" id="createNote">
                <input type="submit" id="submitNoteBtn" value="Submit">
            </form>
        </div>

        <div id="container3">
            
            <button id="assignBtn" type="button" value="<?php echo($contact['email']);?>">Assign To Me</button>
            <p id="assignResult"></p>
            <button id="switchBtn" type="button" value="<?php echo($contact['email']);?>">Switch <?php echo($contact['type']);?> </button>
            <p id="switchResult"></p>
            
        </div>

    </main>

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
<script src="contactDetails.js"></script>
</body>
</html>
    
    

