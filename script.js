document.addEventListener("DOMContentLoaded",function(){
    let emailInput=document.getElementById("emailInput").value;
    let pwdInput = document.getElementById("pwdInput").value;
    let loginBtn= document.getElementById("loginBtn");

    loginBtn.addEventListener("click",function(){
        try {
            fetch('login.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(emailInput)}&password=${encodeURIComponent(pwdInput)}`,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('message').innerText = `Login successful. Welcome, ${data}!`;
                } else {
                    document.getElementById('message').innerText = `Invalid email or password. ${data}`;
                }
                
            })
            .catch(error => console.error('Error:', error)); 
        } catch (error) {
            console.log("Error connecting to the database");
        }
        
    })
    
    console.log("Bottom of script");
            

        
        /*
        let link="http://localhost/Group_Project/action_page.php?";
        fetch(link)
        .then(response=>{
            if(response.ok){
                ;
            }
            else{
                throw Error("An error occured with the Network");
            }
        })
        .then(data=>{
            document.getElementById("result").innerHTML=data
        })
        .catch(error=>{
            console.error('Fetch error:',error)
        })
        */
    

    

 

});