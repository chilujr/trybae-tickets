// ajax getting php data

let ajax = new XMLHttpRequest();
let method = "GET";
let url = "assets/request.php";
let asynchronous = true;
ajax.open(method, url, asynchronous);
ajax.send();

let getScans;

ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
        let data = JSON.parse(this.responseText);
        console.log(data);

function y(){
        for(let i = 0; i < data.length; i++){
            let scannedID = document.querySelectorAll("#scan")[0].textContent;
            if(scannedID == data[i].id){
                console.log(data[i].id);
                //document.querySelector(".scannedID").textContent = "Transaction ID: " + data[i].id;
                document.querySelector(".IDInput").value = data[i].id;
                console.log(data[i].name);
                document.querySelector(".scannedName").textContent = "Customer Name: " + data[i].event_id;
                console.log(data[i].phone);
                document.querySelector(".scannedEmail").textContent = "Email: " + data[i].email;
                console.log(data[i].arrived);
                document.querySelector(".scannedEvent").textContent = "Event Name: " + data[i].event;
                console.log(data[i].arrived);
                document.querySelector(".scannedAmount").textContent = "Amount: " + data[i].amount;
                console.log(data[i].arrived);
                document.querySelector(".scannedTime").textContent = "Transaction Time: " + data[i].tx_time;
                console.log(data[i].arrived);
                document.querySelector(".scannedAttendance").textContent = "Attendance " + data[i].attendance;
                document.querySelector(".arrivalInput").value = '&check;';
            } 
        }
    }
}
getScans = y;
}

// ajax getting php data


// clear scans
function clearFields(){
    document.querySelector("#scan").textContent = "";
    document.querySelector(".scannedName").textContent = "Name: ";
    document.querySelector(".scannedPhone").textContent = "Phone: ";
    document.querySelector(".scannedArrival").textContent = "Arrived: ";

}
// clear scans


// ajax to prevent redirection


    $('document').ready(function(){
        $('#scannedDetails').on('submit',function(e){
            e.preventDefault();
            var FormData = $('#scannedDetails').serialize();

        $.ajax({

            type : 'post',
            url : 'assets/post.php',
            data : FormData,
            dataType : 'json',
            encode : true,
            success : function(response){

                response = (response);
                alert(response);
            }
        });
        });
    });

    // select data from table
