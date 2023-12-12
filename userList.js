document.addEventListener("DOMContentLoaded", function () {
    

    let link="http://localhost/Group_Project/userList.php";
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
        document.getElementById("userList").innerHTML=data;
    })

    .catch(error=>{
        console.error('Fetch error:', error);
    });

    document.getElementById("addUserBtn").addEventListener("click", function () {
        let newlink="http://localhost/Group_Project/newUser.html";
        window.location.href=newlink;

        
    });

    document.getElementById("logoutBtn").addEventListener("click", function () {
        window.location.href = 'logout.php';
    })
});