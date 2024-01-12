// to get data from dynamic table
let table = document.getElementById("table"),rIndex;

for(let i=0; i < table.rows.length; i++){
      
    table.rows[i].onclick = function(){
        rIndex = this.rowIndex;

        document.querySelector(".scan").textContent = this.cells[0].innerHTML;
        document.querySelector(".scannedName").textContent ="Name: " + this.cells[1].innerHTML;
        document.querySelector(".scannedPhone").textContent ="Phone: " + this.cells[2].innerHTML;
        document.querySelector(".scannedArrival").textContent ="Arrived: " + this.cells[3].innerHTML;
    }
}