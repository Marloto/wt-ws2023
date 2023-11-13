

// Erzeugen eines Arrays: []
// -> erzeugen mit Werten: [v1, v2, v3, v4]
// Erzeugen eines Objektes: {}
// -> erzeugen mit Attributen: {"key1": "v1", "key2": "v2", "key3": "v3"}
var news = [{"title": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.", "text": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.", "date": 1699866938368},
{"title": "Hinter den Wortbergen", "text": "Weit hinten, hinter den Wortbergen, fern der Länder Vokalien und Konsonantien leben die Blindtexte. Abgeschieden wohnen sie in Buchstabhausen an der Küste des Semantik, eines großen Sprachozeans. Ein kleines Bächlein namens Duden fließt durch ihren Ort und versorgt sie mit den nötigen Regelialien. Es ist ein paradiesmatisches Land, in dem einem gebratene Satzteile in den Mund fliegen. Nicht einmal von der allmächtigen Interpunktion werden die Blindtexte beherrscht – ein geradezu unorthographisches Leben.", "date": 1699780485767},
{"title": "Webstandards", "text": "Überall dieselbe alte Leier. Das Layout ist fertig, der Text lässt auf sich warten. Damit das Layout nun nicht nackt im Raume steht und sich klein und leer vorkommt, springe ich ein: der Blindtext. Genau zu diesem Zwecke erschaffen, immer im Schatten meines großen Bruders »Lorem Ipsum«, freue ich mich jedes Mal, wenn Sie ein paar Zeilen lesen. Denn esse est percipi - Sein ist wahrgenommen werden. Und weil Sie nun schon die Güte haben, mich ein paar weitere Sätze lang zu begleiten, möchte ich diese Gelegenheit nutzen, Ihnen nicht nur als Lückenfüller zu dienen, sondern auf etwas hinzuweisen, das es ebenso verdient wahrgenommen zu werden: Webstandards nämlich.", "date": 1699866051303}];

// News ist ein Array aus Objekten mit title, text und date Attributen
// -> News-Array unter https://pastie.io/cxhujx.json od. Miro-Board

// News in den Body generieren, was ist von der DOM-API notwendig
// -> for-Schleife zur Iteration über das Array
// -> erzeugen von HTML-Elemente, z.B. p -> createElement
// -> Text einfügen in p -> innerText
// -> Anhängen der p in dem DOM, z.B. Body -> appendChild














// Variante 1
// let target = document.body;
// for(let i = 0; i < news.length; i++) {
//     let container = document.createElement("p");
//     container.innerText = news[i].title + ": " + news[i].text;
//     target.appendChild(container);
// }

// Load-Event als Alternative
// document.body.addEventListener("load", function() {
//     console.log("Loaded!");
// });


// Variante 1
let target = document.body;
let targetList = document.querySelector("ul#toc");
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
    target.appendChild(container);
}

// Wie kann dafür gesorgt werden, das maxi. 100 Zeichen angezeigt werden?
// -> nice to check: über CSS?
