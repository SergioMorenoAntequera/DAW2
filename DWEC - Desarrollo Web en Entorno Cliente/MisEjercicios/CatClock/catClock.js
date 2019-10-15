var message = "";
        var partyTime = false;
        var image;
        

        //Obtener si estamos de fiesta o no
        var partyButton = document.getElementById("partyTimeButton");
        partyButton.addEventListener("click", function(){
            partyTime = !partyTime;
        });

        updateClock();

        function updateClock(){
            
            var now =  new Date();
            var formatedTime = formatDate(now);
            document.getElementById("clock").innerHTML = formatedTime;

            if(now.getHours() >= 8 && now.getHours() < 12){
                image = "https://pbs.twimg.com/profile_images/378800000532546226/dbe5f0727b69487016ffd67a6689e75a.jpeg";
                message = "GOOD MORNING!!";
            }
            if(now.getHours() >= 12 && now.getHours() < 18){
                image = "https://s3.amazonaws.com/media.skillcrush.com/skillcrush/wp-content/uploads/2016/08/normalTime.jpg";
                message = "GOOD AFTERNOON!!";
            }
            if(now.getHours() >= 18 && now.getHours() < 23){
                image = "https://upload.wikimedia.org/wikipedia/commons/8/8c/Cat_sleep.jpg";
                message = "GOOD EVENING!!";
            }
            if(now.getHours() >= 23 && now.getHours() < 8){
                message = "GOOD NIGHT!!";
            }
            
            //Obtener resultado del desplegable WAKEP UP
            var listWakeUp = document.getElementById("wakeUpTimeSelector");
            var wakeUp = listWakeUp.options[listWakeUp.selectedIndex].value;
            if(now.getHours() >= wakeUp && now.getHours() < parseInt(wakeUp)+1){
                image = "https://s3.amazonaws.com/media.skillcrush.com/skillcrush/wp-content/uploads/2016/09/cat1.jpg";
                message = "WAKE UUUUP!!";
            }

            //Obtener resultado del desplegable LUNCH
            var listLunch = document.getElementById("lunchTimeSelector");
            var lunch = listLunch.options[listLunch.selectedIndex].value;
            if(now.getHours() >= lunch && now.getHours() < parseInt(lunch)+1){
                image = "https://s3.amazonaws.com/media.skillcrush.com/skillcrush/wp-content/uploads/2016/09/cat2.jpg";
                message = "TIME TO EAT!!";
            }

            //Obtener resultado del desplegable NAP
            var listNap = document.getElementById("napTimeSelector");
            var nap = listNap.options[listNap.selectedIndex].value;
            if(now.getHours() >= nap && now.getHours() < parseInt(nap)+1){
                image = "https://s3.amazonaws.com/media.skillcrush.com/skillcrush/wp-content/uploads/2016/09/cat3.jpg";
                message = "NAP TIMEEEE!!";
            }
            
            if(partyTime){
                partyButton.textContent = "PARTY IS OVER";
                image = "https://s3.amazonaws.com/media.skillcrush.com/skillcrush/wp-content/uploads/2016/08/partyTime.jpg";
                partyButton.style.background= "#0A8DAB";
                message = "PARTY TIME!!!";
            } else {
                partyButton.textContent = "TIME TO PARTY";
                partyButton.style.background='#222';
            }

            document.getElementById("lolcatImage").src = image;
            document.getElementById("message").innerHTML = message;
            setTimeout(updateClock, 100);
        }
    
    function formatDate(date){
        if(date.getSeconds() < 10)
            var s = "0" + date.getSeconds();
        else 
            var s = date.getSeconds();
        if(date.getMinutes() < 10)
            var m = "0" + date.getMinutes();
        else
            var m = date.getMinutes();
        if(date.getHours > 12){
            var xm = "PM";
                var h = date.getHours() - 12;
        } else {
            var xm = "AM";
            var h = date.getHours();
        }
        return (h+":"+m+":"+s+" "+xm);
    }