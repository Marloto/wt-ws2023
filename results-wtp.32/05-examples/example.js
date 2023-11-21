
        // 1. Schritt Snippet kopieren
        // 2. Function draus erzeugen
        // 3. Handle-Function zur Verarbeitung

        function handleListMessageResponse(data) {
            console.log(data);
            for(var i=0; i<data.length; i++) { 
                console.log(data[i]);
                var p = document.createElement("p");
                p.textContent = data[i].msg;
                var target = document.getElementById("output-container");
                target.appendChild(p);
            }
        }

        function listMessages() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    let data = JSON.parse(xmlhttp.responseText);
                    handleListMessageResponse(data);
                }
            };
            xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/f2453b14-122b-4590-bd2f-cfc3a4ec08ae/message/Jerry", true);
            // Add token, e. g., from Tom
            xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzAwNTgyNzA1fQ.bKWKz9aI6DOG4WMtbCjfdeHDWkI6paDmWG7Qbtdocqg');
            xmlhttp.send();
        }

        // ... später setInterval
        listMessages();