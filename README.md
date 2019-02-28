# f1-management-system
# f1-management-system

1.	Descrierea aplicatiei

Acest proiect este un sistem de gestiune al campionatelor de Formula1 care permite atat adaugarea, modificare, stergerea, cat si citirea formatata a informatiilor din sistem (operatii CRUD).
	Aplicatie este una de tip WEB si a fost realizata folosind PHP ca limbaj back-end, Bootstrap(HTML5 + CSS3) pentru partea de front-end si MySQL ca baza de date pentru a pastra si gestiona informatiile.

2.	Baza de date

Cum am mentionat si in subcapitolul anterior, pentru baza de date am ales MySQL 
datorita multitudini de functii incluse in PHP si a bunei relatii dintre cele doua.
	Pentru un bun management al acestui tip de sistem am considerat necesare urmatoarele tabele:
-	Users
-	ID
-	Username
-	Email
-	Password
	Echipe
-	ID_Echipa
-	Nume
-	Sediu_central
	Piloti
-	ID_Pilot
-	Nume
-	ID_Echipa
	Curse
-	ID_Cursa
-	Locatie
-	Numar_ture
-	Lungime
	Masini
-	Serie_sasiu
-	ID_Pilot
-	Numar_masina
-	Putere_motor
-	Capacitate_motor



	Turnee
-	ID_Turneu
-	An
-	Denumire
-	Status
	PilotiCurseTurnee(tabela de legatura)
-	ID_Pilot
-	ID_Cursa
-	ID_Turneu
-	Timp

Relatii: 
-	1:M Echipe<->Piloti, Masini<->Piloti
-	M:M Piloti<->Turnee<->Curse


3.	Accesul in aplicatie

	Avand in vedere natura aplicatiei(sistem de gestiune) accesul este restrans si permis doar in baza unor credentiale, dar inregistrarea in aplicatie a fost lasata “libera” doar pentru a demonstra procesul in cadrul prezentarii.
	Inregistrarea unui nou utilizator in sistem se poate face doar completand toate campurile(nume de utilizator, email, parola si confirmarea parolei). In caz contrar, aplicatia va respinde tentativa de inregistrare, mentionand campurile ce au nevoie de completare.
	Pentru autentificare sunt necesare credentiale clasice(nume de utilizator si parola) care vor fi confruntate cu tabela “users” din baza de date pentru a stabili daca se permite accesul sau nu. In cazul in care credentialele sunt corecte, utilizatorul va fi redirectionat catre pagina “index.php”.

4.	Utilizarea platformei

Pagina “index.php” contine informatii despre toate turneele(active si inactive) precum
numarul pilotilor si al curselor si statusul acestuia. Ultimele doua coloane sunt butoane ce conduc catre paginile de “Adaugare rezultate turneu”, care permite adaugarea unor noi rezultate, si “Clasament” care genereaza un clasament al turneului.
	In bara de navigatie se mai gasesc inca 4 butoane care conduc catre panourile de administrare(“Panou piloti”, “Panou curse” si “Panou turnee”) si catre “Statistici”.
	Panourile de administrare permit operatii CRUD, dar “Panoul turnee” permite si activarea unui turneu prin selectarea pilotilor participanti, a turneului si a curselor.
	Ultimul link, “Statistici”, este un ecran pe care se afiseaza diferite statistici precum: “Cel mai bun pilot pe o anumita cursa” sau “Pilotii unei echipe”.
	Platforma este usor de utilizat, avand un aer natural, cu butoane sugestive si etichete pentru fiecare camp de input pentru o usoara acomodare.




5.	Query-uri complexe:

-	Query pentru stabilirea numarului de piloti pentru fiecare turneu:

 "SELECT COUNT(A.ID_Pilot) as NoOfPilots, A.ID_Turneu as TournamentID FROM (SELECT ID_Pilot, ID_Turneu from piloticurseturnee GROUP by ID_Pilot, ID_Turneu) A GROUP by ID_Turneu ORDER BY ID_Turneu ASC;"

-	Query pentru stabilirea numarului de curse pentru fiecare turneu:

 "SELECT COUNT(A.ID_Cursa) as NoOfRaces, A.ID_Turneu as TournamentID FROM (SELECT ID_Cursa, ID_Turneu from piloticurseturnee GROUP by ID_Cursa, ID_Turneu) A GROUP by ID_Turneu ORDER BY ID_Turneu ASC;"

-	Query pentru selectarea curselor care nu au fost jucate dintr-un anumit turneu:

"SELECT curse.ID_Cursa as ID_Cursa, curse.locatie as locatie FROM curse JOIN (SELECT ID_Cursa FROM piloticurseturnee WHERE ID_Turneu = $tournamentID and timp is NULL) b ON curse.ID_Cursa = b.ID_Cursa GROUP BY ID_Cursa;"

-	Query pentru selectarea pilotilor participanti ai unui anumit turneu:

"SELECT piloti.nume as NumePilot, b.timp as Timp, piloti.ID_Pilot as PilotID FROM piloti JOIN (SELECT ID_Pilot, timp FROM piloticurseturnee WHERE ID_Turneu = $tournamentID) b ON piloti.ID_Pilot = b.ID_Pilot GROUP BY PilotID;"

-	Query pentru selectarea celui mai bun pilot pe o anumita cursa:

"SELECT piloti.nume as PilotNume, a.timp as PilotTimp FROM piloti JOIN (SELECT ID_Pilot, timp FROM piloticurseturnee WHERE piloticurseturnee.ID_Cursa = $raceID) a ON piloti.ID_Pilot = a.ID_Pilot WHERE timp IS NOT NULL ORDER BY a.timp ASC LIMIT 1"
