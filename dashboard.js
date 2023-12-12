document.addEventListener("DOMContentLoaded", function () {
    let addBtn=document.getElementById("addContactsBtn");
    // Add click event listeners to each button
    document.getElementById("allBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/dashboard.php";
        
        fetch(link)
        .then(response=>{
            if(response.ok){
                return response.text();
            }
            else{
                throw Error("An error occured with the Network");
            }
        })
        .then(data=>{
            document.getElementById("contactList").innerHTML=data;
            
            let viewBtns = document.querySelectorAll("#viewBtn");
            
            viewBtns.forEach(button=>{
                button.addEventListener('click', function () {
                    // Find the closest table row (tr)
                    const row = this.closest('tr');

                    // Extract data from the row
                    const email = row.cells[1].innerText;
            
                    let newlink="http://localhost/Group_Project/contactDetails.php?email="+ encodeURIComponent(email);
                    window.location.href = newlink;

                });
            });
        });
        
        
    });

    
    document.getElementById("salesBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/SalesLeads.php";
        console.log("Select All");
        fetch(link)
        .then(response=>{
            if(response.ok){
                return response.text();
            }
            else{
                throw Error("An error occured with the Network");
            }
        })
        .then(data=>{
            document.getElementById("contactList").innerHTML=data;
            
            
        });
    });
        
        
    
    

    document.getElementById("supportBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/Support.php";
        fetch(link)
        .then(response=>{
            if(response.ok){
                return response.text();
            }
            else{
                throw Error("An error occured with the Network");
            }
        })
        .then(data=>{
            document.getElementById("contactList").innerHTML=data;
            
            
        });
    });
    

    document.getElementById("assignBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/assigned_to_Me.php";
        console.log("Select All");
        fetch(link)
        .then(response=>{
            if(response.ok){
                return response.text();
            }
            else{
                throw Error("An error occured with the Network");
            }
        })
        .then(data=>{
            document.getElementById("contactList").innerHTML=data;
            
            
        })
    });

    document.getElementById("logoutBtn").addEventListener("click", function () {
        let logotLink="http://localhost/Group_Project/logout.php";
        window.location.href = logotLink;
    });

    document.getElementById("addContactsBtn").addEventListener("click", function () {
        console.log("Pressed");
        let newContactLink= "http://localhost/Group_Project/newContact.html";
        window.location.href = newContactLink;
        
    });


    
});
