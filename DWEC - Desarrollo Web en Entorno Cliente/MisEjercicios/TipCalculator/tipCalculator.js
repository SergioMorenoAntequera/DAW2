
var f = function calculateTip(){
    var bill = parseFloat(document.getElementById("billamt").value);
    var service = parseFloat(document.getElementById("serviceQual").value);
    var people = parseFloat(document.getElementById("peopleamt").value);
    var message = "";

    if(bill == "" || service == "0" || people == ""){
        document.getElementById("totalTip").innerHTML = "Introduce the missing information";
    } else {
        message = ((bill * service) / people).toFixed(2);
        document.getElementById("tip").innerHTML = message;
    }

    document.getElementById("totalTip").style.visibility = 'visible';
}

document.getElementById("calculate").addEventListener("click", f);