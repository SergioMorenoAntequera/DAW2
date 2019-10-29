

var arr = ["Ana", "Bea", "Clara", "Diego", "Jero", "Ibaniez", "Ibarra", "Lucia", "Maria"];
var pk = "Jero";
var mitad = 0;
var menor = 0;
var mayor = arr.length;
var encontrado = false;

while(menor < mayor && !encontrado){

    mitad = Math.ceil((menor + mayor) / 2) - 1;

    console.log("Menor :" + menor);
    console.log("Mitad :" + mitad);
    console.log("Mayor :" + mayor);
    console.log("***************");

    if(arr[mitad] < pk){
        menor = mitad;
    }

    if(arr[mitad] > pk){
        mayor = mitad; 
    }

    if(arr[mitad] == pk){
        encontrado = true;
        
    }

}

if(encontrado){
    alert("Lo hemos encontrado");
} else {
    alert("No lo hemos encontrado");
}
