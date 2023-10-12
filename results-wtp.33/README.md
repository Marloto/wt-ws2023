DNS-Server
Abfrage, welcher Server ist mit www.thi.de verbunden
Wir benötigen eine IP: 123.123.123.123 - 0..255
- 192...
- 172...
- 169...
- 10...
- 127.0.0.1 (localhost), 127...
Adresse von hinten nach vorne verarbeiten
- Nameserver de-Domain über Rootserver finden -> a.nic.de
- Nameserver für thi.de-Domain über de-Nameserver
- A-Record für www.thi.de-Domain über thi.de-Nameserver
"dig" Werkzeuge zum auflösen
-> IP für www.thi.de ist 194.94.240.181
TTL steuert Caching lokal, wie lange die Informationen aufgehoben werden soll


~$ nc -v 194.94.97.140 80
Connection to 194.94.97.140 port 80 [tcp/http] succeeded!
GET /resources/test.txt HTTP/1.1
Host: online-lectures-cs.thi.de

HTTP/1.1 200 OK
Server: nginx/1.17.9
Date: Thu, 12 Oct 2023 12:11:40 GMT
Content-Type: text/plain
Content-Length: 13
Last-Modified: Mon, 05 Oct 2020 06:18:53 GMT
Connection: keep-alive
ETag: "5f7abacd-d"
Accept-Ranges: bytes

Hallo, Welt!


-> URL http://online-lectures-cs.thi.de:80/resources/test.txt
-> IP stammt aus der Domain: online-lectures-cs.thi.de -> 194.94.97.140
-> TCP -> Port: fallback auf default-wert, steht nach Domain, wenn angegeben, 80
-> HTTP -> Path: /resources/test.txt


Visual Studio Code:
- Syntax Steuerung
- Zeilenumbruch: LF od. CRLF, LF ist ok
- Was ist UTF-8? Character Encoding

Shortcuts:
- Alt/Option + Z für Word Wrap
- Alt + Pfeil Hoch / Runter -> Zeilen zu verschieben
- Alt/Option + Shift + Pfeil Hoch / Runter -> Zeilen duplizieren
- Strg/Cmd + Shift + K -> Entfernen einer Zeile
- Alt + Click erzeugt weitere Cursor
- Cmd/Strg + D -> markiert nächstes Suchvorkommen mit Cursor
- Cmd / Strg + F für Suche
- in der Suche Alt + Enter markiert alle Stellen im Dokument die gefunden werden würden mit einem Cursor
- Cmd + P -> Suche nach geöffneten Dateien
- Cmd/Strg + Shift + P -> Öffnet eingabe für Steuerung von VSC