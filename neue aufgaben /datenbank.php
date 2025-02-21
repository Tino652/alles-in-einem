<?php
include 'pinnwand.php';
$daten = ausgabe();

// Debugging: Ausgabe der Datenstruktur (besser lesbar)
echo "<pre>"; // <pre> Tag für formatierte Ausgabe im Browser
print_r($daten);
echo "</pre>";

// Überprüfen, ob Daten vorhanden sind, bevor darauf zugegriffen wird
if (!empty($daten)) {
    echo "<h3>Foreach-Schleife:</h3>";
    echo "<ul>"; // Beginn einer ungeordneten Liste für bessere Darstellung
    foreach ($daten as $eintrag) { // Aussagekräftigerer Variablenname als $art
        echo "<li>"; // Listenelement für jeden Eintrag
        // Formatierte Ausgabe der Daten (Beispiel)
        echo "Zeitpunkt: " . $eintrag['timestamp'] . "<br>";
        echo "Art: " . $eintrag['art'] . "<br>"; // Annahme, dass 'art' ein Schlüssel ist
        echo "Titel: " . $eintrag['titel'] . "<br>"; // Annahme, dass 'titel' ein Schlüssel ist
        echo "Preis: " . $eintrag['preis'] . "<br>"; // Annahme, dass 'preis' ein Schlüssel ist
        // ... weitere Felder
        echo "</li>";
    }
    echo "</ul>"; // Ende der Liste

    // Zugriff auf ein spezifisches Element (mit Überprüfung)
    if (isset($daten[1])) {
        echo "<h3>Element 2:</h3>";
        echo "<pre>";
        print_r($daten[1]);
        echo "</pre>";
    } else {
        echo "<p>Element 2 ist nicht vorhanden.</p>";
    }
$daten[2] = "[timestamp] => 2025-02-12 10:15:36
            [art] => Suche
            [titel] => Kaffeemaschine
            [preis] => 20€
            [kontakt] => dummy@dummy.de
            [details] => Hey Leute, ich suche eine Kaffeemaschine. Dabei ist egal, von welcher Marke sie kommt.";
    // Vergleich von Zeitstempeln (korrekt)
    $zeitpunkt1 = strtotime("36");
    $zeitpunkt2 = strtotime("38");

    if ($zeitpunkt1 < $zeitpunkt2) { // Korrekte Vergleichsrichtung
        echo "<p>Der 2. Artikel  ist neuer als der 1.</p>";
        print_r($daten[2]);
        print_r($daten[1]);
    } else {
        echo "<p>Der 1. Artikel ist neuer als der 2..</p>";
        print_r($daten[1]);
        print_r($daten[2]);
        
    }

} else {
    echo "<p>Keine Daten vorhanden.</p>";
}
$servername = "localhost"; // Ersetze mit deinem Servernamen
$username = "root"; // Ersetze mit deinem Datenbank-Benutzernamen
$password = ""; // Ersetze mit deinem Datenbank-Passwort
$dbname = "meine_datenbank"; // Ersetze mit deinem Datenbanknamen

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
  die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

?>