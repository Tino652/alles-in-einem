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

    // Vergleich von Zeitstempeln (korrekt)
    $zeitpunkt1 = strtotime("2025-02-12 10:15:36");
    $zeitpunkt2 = strtotime("2025-02-12 10:15:38");

    if ($zeitpunkt1 < $zeitpunkt2) { // Korrekte Vergleichsrichtung
        echo "<p>Zeitpunkt 1 ist früher als Zeitpunkt 2.</p>";
    } else {
        echo "<p>Zeitpunkt 2 ist früher oder gleich Zeitpunkt 1.</p>";
    }

} else {
    echo "<p>Keine Daten vorhanden.</p>";
}


?>