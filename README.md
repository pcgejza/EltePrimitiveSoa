<h1>1. Feladat leírása</h1>


Az első beadandó egy Web Service alapú Nagykereskedői Információs Rendszer (most leegyszerűsítve egy webáruház) készítése. Az egyszerű SOAP, valamint a RESTful webszolgáltatás integráción van a hangsúly, a webáruház designja, valamint a további funkciók (regisztráció, bejelentkezés, adatfeltöltés, fizetés, stb.) nem része az értékelésnek, így azoknak a funkcióknak a megvalósítására ne is törekedjetek.

A nagykereskedő oldalán az alábbi egyszerű adatbázis-szerkezetet kell kialakítani:

–Termékek adatai: termékId, név, leírás, készletDb, eladási_ár

–Vevők: id, név, cím

–Eladások: termekid, vevőid, db, ár,  dátum

A Nagykereskedői Információs Rendszer két webszervice-t publikál a kiskereskedők felé:

RESTful alapú webszolgáltatás segítségével kérdezhetik le a termék és készletinformációkat a kiskereskedők.
SOAP alapú webszolgáltatást a termékek értékesítésére.
A feladat a fent leírt Nagykereskedői Információs Rendszer alapjainak, azaz az adatbázisnak és a két webszolgáltatásnak az elkészítése. A két funkció kliens oldali teszteléshez készíts egy egyszerű Kiskereskedői Infomációs Rendszert (adatbázis itt már nem szükséges).

 Egyéb technológiai megkötés nincs, bármilyen adatbáziskezelő rendszer és bármilyen fejlesztői rendszer, környezet (Java, .Net, PHP, JS, Python, stb) használható, amit a legjobban ismersz, vagy amit a célra a legalkalmasabbnak találsz. Nyilván a feladat egyes környezetekben (Java, .Net) egyszerűbb, de ahogy a lenti linkeken láthatod, szinte minden nyelvhez, fejlesztői környezethez található csomag, függvény, stb. SOAP-os és RESTful webszolgáltatások publikálására és hívására.

*http://ade.web.elte.hu/oktatas/webtechnologiak-informacios-rendszerekben/*
Tarcsi Ádám
<h1>2. Elkészített megoldás leírása</h1>
A feladat megoldását php nyelven implementáltam.

<h2>2.1. Rendszerkövetelmények</h2>
Szükséges hozzá egy webszerver ami legalább egy php 5 vagy nagyobb verzióval rendelkezik. Szükséges hozzá egy adatbázis szerver ami mysql-t használ.

<h2>2.2. Konfiguráció/Telepítés</h2>
Az adatbázis kapcsolathoz szükséges adatokat a ./wholesaler/config.php fájlban kell megadni az elvárt működéshez.
A nagykereskedő oldalára szükséges adatbázis táblákat és azok tartalmát (teszt adatokat) a dump.sql fájlban találja, ezt kell beimportálni egy kiválasztott mysql adatbázisba.

<h2>2.3. Fájl struktúra</h2>
A **wholesaler** könyvtárban található a nagykereskedő oldal, tehát ez kapcsolódik majd az adatbázishoz. Ezt áthelyezhetjük külön helyre is.

A **retailer** könyvtárban található a kiskereskedő oldal, itt a termék információk lekérdezésére készítettem egy get-info.php, valamint a termékek értékesítésére egy set-info.php fájlt.

<h2>2.4 Működés</h2>
A web szolgáltatás és a kiskereskedő oldal természetesen futhat két teljesen különböző helyről. Ezért odatettem egy url mezőt mindkét űrlapra(kiskereskedő oldal), ez automatikusan kitöltődik. 

<b>./retailer/get-info.php</b> - 1. feladat megoldása, restful 
<b>./retailer/set-info.php</b> - 2. feladat megoldása, soap