# Utvecklarkollektivets första projekt!

Mer info kommer.

Instruktioner för att installer cakePHP
=======================================
1. För det första måste du ha en fungerande webserver på din dator, tex xampp eller wamp
2. Ladda ner hela zip-filen, kör en git clone, eller en fork.
3. Gå till mappen \app\Config, ta bort .sample på core-filen samt .default på database-filen
4. Öppna upp database.php och ändra host, login, password & database till dina inställningar
5. Nu är det bara att gå in och importera dump.sql i phpmyadmin, eller köra queryn: source path-till-fil/dump.sql
6. När dumpen är ladda i databasen kan du registrera en ny användare med registreringsnyckeln: 1111-1111-1111-1111

Kodstil VIKTIGT!
================
Vi använder CakePHP's kodstil. [Läs här](http://book.cakephp.org/2.0/en/contributing/cakephp-coding-conventions.html)


--------------------------
Observera att CakePHP inte använder tab-tecken. Därför måste du ställa in din editor på att använda 4 mellanslag.

Ställ om tabbar i dreamweaver
-----------------------------
Gå till Edit > Preferences. Välj "Code Format" i menyn till vänster. Ställ in "Tab width" till "4" och välj "Spaces" i select-menyn.

Ställ om tabbar i vim
---------------------
Skriv
    :set expandtabs 
och 
    :set tabstop=4
Om du vill göra om alla befintliga tabbar till spaces, skriv
    :retab

Ställ om tabbar i Notepad++
---------------------------
Inställningar > Inställningar > Programspråksmeny

I nedre höger kant finns det en checkbox "Ersätt med mellanslag", kryssa i den. Ovanför kan du också välja "Flikstorlek" (hur många mellanslag på en tab), välj 4.

Ställ om tabbar i Sublime Text 2
---------------------------
Preferences -> Settings - Default

Denna är som standard 4 så det behöver man nog inte ändra på, men se till att det är 4.
// The number of spaces a tab is considered equal to
"tab_size": 4,

Denna är som standard satt till false så ändra den till true.
// Set to true to insert spaces when tab is pressed
"translate_tabs_to_spaces": true,
