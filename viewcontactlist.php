<?php

// Connect to database
$db = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');

// Get the contact ID from the URL
$contactId = $_GET['contact_id'];

// Get the contact details from the database
$sql = 'SELECT * FROM contacts WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $contactId);
$stmt->execute();
$contact = $stmt->fetch();

// Get the contact notes from the database
$sql = 'SELECT * FROM contact_notes WHERE contact_id = :id ORDER BY created_at DESC';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $contactId);
$stmt->execute();
$contactNotes = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Details</title>
</head>
<body>

<h1>Contact Details</h1>

<table border="1">
  <tr>
    <th>Title</th>
    <td><?php echo $contact['title']; ?></td>
  </tr>
  <tr>
    <th>Full Name</th>
    <td><?php echo $contact['full_name']; ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php echo $contact['email']; ?></td>
  </tr>
  <tr>
    <th>Company</th>
    <td><?php echo $contact['company']; ?></td>
  </tr>
  <tr>
    <th>Telephone</th>
    <td><?php echo $contact['telephone']; ?></td>
  </tr>
  <tr>
    <th>Date Created</th>
    <td><?php echo $contact['created_at']; ?></td>
  </tr>
  <tr>
    <th>Date Updated</th>
    <td><?php echo $contact['updated_at']; ?></td>
  </tr>
  <tr>
    <th>Assigned To</th>
    <td><?php echo $contact['assigned_to']; ?></td>
  </tr>
</table>

<h2>Contact Notes</h2>

<ul>
<?php foreach ($contactNotes as $note): ?>
  <li>
    <b><?php echo $note['user_name']; ?></b>: <?php echo $note['comment']; ?> (<?php echo $note['created_at']; ?>)
  </li>
<?php endforeach; ?>
</ul>

<a href="/dashboard">Back to Dashboard</a>

</body>
</html>
