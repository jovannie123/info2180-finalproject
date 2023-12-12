document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("logoutBtn").addEventListener("click", function () {
        let logotLink="http://localhost/Group_Project/logout.php";
        window.location.href = logotLink;
    })

    document.getElementById("saveUserBtn").addEventListener("click", function () {
        let link="http://localhost/Group_Project/newUser.php";
        
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