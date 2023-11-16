// neues p-Element (paragraphen)
let element = document.createElement("p");
// p-Element erhält als Text-Inhalt "Hallo, Welt!"
element.innerText = "Hallo, Welt!";
// Class-Attribut verändern
// -> zum benennen von bestimmten Style Eigenschaften
//    welche dann verschiedenen elementen über class="..."
//    zugewiesen werden
element.classList.add("some-class");
// ID Attribut setzen
// -> Fragmente (#...) in URL und ID?
// -> mit IDs in CSS arbeiten zum selektieren
element.id = "some-id";
// Platzieren auf der Seite, bzw. body
document.body.appendChild(element);

// Finden von Elementen: getElementById, getElementsByClassName, getElementsByTagName
console.log(document.getElementsByTagName("title"));