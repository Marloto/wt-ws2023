

// Erzeugen eines Arrays: []
// -> erzeugen mit Werten: [v1, v2, v3, v4]
// Erzeugen eines Objektes: {}
// -> erzeugen mit Attributen: {"key1": "v1", "key2": "v2", "key3": "v3"}

// News ist ein Array aus Objekten mit title, text und date Attributen
// -> News-Array unter https://pastie.io/cxhujx.json od. Miro-Board

// News in den Body generieren, was ist von der DOM-API notwendig
// -> for-Schleife zur Iteration über das Array
// -> erzeugen von HTML-Elemente, z.B. p -> createElement
// -> Text einfügen in p -> innerText
// -> Anhängen der p in dem DOM, z.B. Body -> appendChild

// Wie kann dafür gesorgt werden, das maxi. 100 Zeichen angezeigt werden?
// -> nice to check: über CSS?


// Was ist JSON?
// -> JavaScriptObjectNotation -> orientiert sich an der JavaScript Notation zur Erzeugung von Objekten und Arrays
// -> Format wie man Daten strukturieren kann
// -> lesen von Daten
// -> verarbeiten von Daten











// Variante 1
// let target = document.body;
// for(let i = 0; i < news.length; i++) {
//     let container = document.createElement("p");
//     container.innerText = news[i].title + ": " + news[i].text;
//     target.appendChild(container);
// }

// https://online-lectures-cs.thi.de/resources/news.json
// https://t1p.de/jefpy

function loadNews(url) {
    let res = new XMLHttpRequest();
    res.onreadystatechange = function() {
        if(res.readyState === 4 && res.status === 200) {
            console.log(res.responseText);
            let news = JSON.parse(res.responseText);
            showNews(news);
        }
    };
    res.open('GET', url, true);
    res.send();
}

// Variante 1
function showNews(news) {
    let target = document.querySelector("#news");
    let targetList = document.querySelector("ul#toc");
    if(!target || !targetList) {
        return; // abbrechen wenn Elemente fehlen
    }
    for(let i = 0; i < news.length; i++) {
        let tocItem = document.createElement("li");
        let tocItemLink = document.createElement("a");
        tocItemLink.innerText = news[i].title;
        tocItemLink.href = '#news' + i;
        tocItem.appendChild(tocItemLink);
        targetList.appendChild(tocItem);

        let container = document.createElement("div");
        container.id = "news" + i;
        let titleElement = document.createElement("h3");
        let textElement = document.createElement("p");
        textElement.classList.add("more");
        titleElement.innerText = news[i].title;

        let text = news[i].text;
        let rest = "";
        if(text.length > 100) {
            rest = text.substring(100);
            text = text.substring(0, 100);
        }
        textElement.innerText = text;

        let restElement = document.createElement("span");
        restElement.innerText = rest;
        restElement.style.display = "none";
        textElement.appendChild(restElement);

        textElement.addEventListener("click", function() {
            if(restElement.style.display == "none") {
                restElement.style.display = "";
            } else {
                restElement.style.display = "none";
            }
        });

        container.appendChild(titleElement);
        container.appendChild(textElement);
        target.appendChild(document.createElement('hr'));
        target.appendChild(container);
    }
};

// Load-Event als Alternative
window.addEventListener("load", function() {
    loadNews("http://localhost:5500/13-js-examples/news.json");
});




// Was aus der DOM-API wäre notwendig, um das Formular zu überprüfen und
// dem Nutzer Feedback anzubieten?
// -> werte der Eingabefelder (Vgl. value)
// -> Traversieren, bis Form?
// -> getElementById od. getElementsByName

let newsletterForm = document.querySelector("#newsletter_form");
let nameInput = document.querySelector("#newsletter_name");
let mailInput = document.querySelector("#newsletter_mail");
let submitButton = document.querySelector("#newsletter_save");
// newsletterForm.addEventListener('submit', function(e) {
//     let nameValue = nameInput.value;
//     let mailValue = mailInput.value;
//     console.log(nameValue, mailValue);
//     // return false;
    
// })

function loadBlacklist(url) {
    let res = new XMLHttpRequest();
    res.onreadystatechange = function() {
        if(res.readyState === 4 && res.status === 200) {
            console.log(res.responseText);
            let blacklist = JSON.parse(res.responseText);
            validateForm(blacklist);
        }
    };
    res.open('GET', url, true);
    res.send();
}

function validateForm(blacklist) {
    let nameValue = nameInput.value;
    let mailValue = mailInput.value;
    console.log(nameValue, mailValue);

    let containsNoError = true;

    // Name min. 3 Zeichen
    // -> name mit length Attribut prüfen
    // Email auf Blacklist checken
    // -> vergleich mit blacklist-Array
    // -> Zeichenketten vergleichen, contains-Methode ggf.
    // -> iteration über blacklist
    // Anpassungen im Dokument
    // -> mit CSS Klassen (bevorzugen)
    // -> Style-Attribut nutzen
    // -> Zusätzliche Elemente erzeugen, die Informationen liefern    
    nameInput.classList.remove('error-input', 'success-input');
    // Clean up
    let oldMsg = document.querySelector('div.error-msg');
    if(oldMsg) {
        oldMsg.parentElement.removeChild(oldMsg);
    }
    if(nameValue.length <= 3) {
        // .. do things!
        nameInput.classList.add("error-input");
        let errorMsg = document.createElement('div');
        errorMsg.classList.add('error-msg');
        errorMsg.innerText = 'Should have at least 4 characters';
        nameInput.parentElement.appendChild(errorMsg);
        containsNoError = false;
        // -> 
    } else {
        nameInput.classList.add("success-input");
    }
    mailInput.classList.remove('error-input', 'success-input');
    if(mailValue.length > 0) {
        let blacklisted = false;
        for(let i = 0; i < blacklist.length; i++) {
            let blacklistedElement = blacklist[i];
            if(mailValue.endsWith(blacklistedElement)) {
                blacklisted = true;
                break;
            }
        }
        if(blacklisted) {
            mailInput.classList.add("error-input");
            containsNoError = false;
        } else {
            mailInput.classList.add("success-input");
        }
    } else {
        mailInput.classList.add("error-input");
        containsNoError = false;
    }

    // wenn alles richtig ist submit() Methode aufrufen!
    if(containsNoError) {
        // über DOM-API Form-Element suchen, oder Variable hier verwenden
        newsletterForm.submit();
    }
}

if(submitButton != null) {
    submitButton.addEventListener('click', function() {
        loadBlacklist("http://localhost:5500/13-js-examples/blacklist.json")
    });
}

// Vergleichen von Strings
// -> == -> "42" == "42" -> true
// -> == -> "42" == 42 -> true (weil type conversion)
// -> === -> "42" === "42" -> true
// -> === -> "42" === 42 -> false
// -> === prüft typ und werte gleichheit

function showImg(nr) {
    let childs = document.querySelectorAll('#carousel img');
    for(let i = 0; i < childs.length; i++) {
        childs[i].style.display = i == nr ? '' : 'none';
    }
}

function initImg() {
    let states = document.createElement('div');
    states.classList.add('states');
    let childs = document.querySelectorAll('#carousel img');
    for(let i = 0; i < childs.length; i++) {
        let dot = document.createElement('dot');
        dot.classList.add('dot');
        dot.addEventListener('click', function() {
            showImg(i);
        })
        states.appendChild(dot);
    }
    document.querySelector('#carousel').appendChild(states);
    showImg(0);
}

window.addEventListener('load', function() {
    initImg();
});