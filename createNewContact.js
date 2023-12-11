function saveContactDetails() {
  // Get the contact data from the form
  var contactData = {
    id: $("#id").val(),
    title: $("#title").val(),
    fullName: $("#fullName").val(),
    email: $("#email").val(),
    company: $("#company").val(),
    telephone: $("#telephone").val(),
    assignedTo: $("#assignedTo").val(),
  };

  // Make an AJAX request to update the contact details
  $.ajax({
    url: "/contact-details-update.php",
    method: "POST",
    data: contactData,
    success: function(response) {
      if (response.success) {
        alert("Contact details updated successfully!");
        // Update the contact data in the client-side cache
        contactData = response.data;
      } else {
        alert("Error updating contact details: " + response.error);
      }
    },
    error: function(error) {
      console.error(error);
      alert("An error occurred while updating contact details.");
    }
  });
}
