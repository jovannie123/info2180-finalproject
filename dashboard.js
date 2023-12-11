// dashboard.js

// Sample contact data
const contacts = [
    { 
        title: 'Mr',
        firstName: 'John',
        lastName: 'Doe',
        email: 'john@example.com',
        company: 'ABC Corp',
        contactType: 'Sales Lead',
        detailsLink: 'details.html?id=1' // Replace with the appropriate link structure
    },
    { 
        title: 'Ms',
        firstName: 'Jane',
        lastName: 'Doe',
        email: 'jane@example.com',
        company: 'XYZ Inc',
        contactType: 'Sales Support',
        detailsLink: 'details.html?id=2' // Replace with the appropriate link structure
    },
    // Add more contacts as needed
];

// Function to populate the contact table
function populateContactTable() {
    const contactTableBody = document.getElementById('contactTableBody');

    contacts.forEach((contact, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${contact.title}</td>
            <td>${contact.firstName} ${contact.lastName}</td>
            <td>${contact.email}</td>
            <td>${contact.company}</td>
            <td>${contact.contactType}</td>
            <td><a href="${contact.detailsLink}" target="_blank">View Details</a></td>
        `;
        contactTableBody.appendChild(row);
    });
}

// Add event listener to the "Add Contact" button
const addContactBtn = document.getElementById('addContactBtn');
addContactBtn.addEventListener('click', () => {
    // Implement logic to add a new contact
    // For example, show a form to input contact details
});

// Call the function to populate the contact table initially
populateContactTable();

