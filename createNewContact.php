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

// Prepare the JavaScript data
$contactData = json_encode([
    'id' => $contact['id'],
    'title' => $contact['title'],
    'fullName' => $contact['full_name'],
    'email' => $contact['email'],
    'company' => $contact['company'],
    'telephone' => $contact['telephone'],
    'assignedTo' => $contact['assigned_to'],
    'notes' => $contactNotes,
]);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Details</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    // Get the contact data from the PHP script
    var contactData = JSON.parse('<?php echo $contactData; ?>');

    $(document).ready(function() {
      // Display the contact details
      $('#title').val(contactData.title);
      $('#fullName').val(contactData.fullName);
      $('#email').val(contactData.email);
      $('#company').val(contactData.company);
      $('#telephone').val(contactData.telephone);
      $('#assignedTo').val(contactData.assignedTo);

      // Display the contact notes
      var notesHtml = '';
      for (var i = 0; i < contactData.notes.length; i++) {
        notesHtml += '<li><b>' + contactData.notes[i].userName + '</b>: ' + contactData.notes[i].comment + ' (' + contactData.notes[i].createdAt + ')</li>';
      }
      $('#notes').html(notesHtml);
    });
  </script>
</head>
<body>

<h1>Contact Details</h1>

<form action="/contact-details-update.php" method="post">
  <input type="hidden" name="id" id="id" value="<?php echo $contact['id']; ?>">
  <table border="1">
    <tr>
      <th>Title</th>
      <td><input type="text" name="title" id="title" value="<?php echo $contact['title']; ?>"></td>
    </tr>
    <tr>
      <th>Full Name</th>
      <td><input type="text" name="fullName" id="fullName" value="<?php echo $contact['full_name']; ?>"></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><input type="email" name="email" id="email" value="<?php echo $contact['email']; ?>"></td>
    </tr>
    <tr>
      <th>Company</th>
      <td><input type="text" name="company" id="company" value="<?php echo $contact['company']; ?>"></td>
    </tr>
    <tr>
      <th>Telephone</th>
      <td><input type="tel" name="telephone" id="telephone" value="<?php echo $contact['telephone']; ?>"></td>
    </tr>
    <tr>
      <th>Assigned To</th>
      <td><input type="text" name="assignedTo" id="assignedTo" value="<?php echo $contact['assigned_to']; ?>"></td>
    </tr>
  </table>

  <br>

  <h2>Contact Notes</h2>

  <ul id="notes"></ul>

  <br>

  <input type="submit" value="Update Contact">
</form>

<a href="/dashboard">Back to Dashboard</a>

</body>
</html>
