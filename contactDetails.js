document.addEventListener("DOMContentLoaded", function () {
    let assignValue=document.getElementById("assignBtn").value;
    let switchValue=document.getElementById("switchBtn").value;
    console.log(assignValue);
    console.log(switchValue);


    document.getElementById("logoutBtn").addEventListener("click", function () {
        window.location.href = 'logout.php';
    })

    document.getElementById("assignBtn").addEventListener("click", function () {

        let link="http://localhost/Group_Project/assign.php?assign="+ encodeURIComponent(assignValue);
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
            console.log(data);
            document.getElementById("assignResult").innerHTML=data;
            
            
        });
    })

    document.getElementById("switchBtn").addEventListener("click", function () {

        let link="http://localhost/Group_Project/switch.php?switch="+ encodeURIComponent(switchValue);
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
            console.log(data);
            document.getElementById("switchResult").innerHTML=data;
            
            
        });
    })
});