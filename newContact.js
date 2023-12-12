document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("logoutBtn").addEventListener("click", function () {
        window.location.href = 'logout.php';
    })

    document.getElementById("saveContactBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/newContact.php";
        
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
            document.getElementById("result").innerHTML=data;
        });
    });
});