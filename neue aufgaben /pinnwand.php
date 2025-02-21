
<?php
/**
 * Dieses Skript speichert Einträge für das Schwarze Brett in einer Datenbank.
 */

//Datenbankparameter
$db_host = '127.0.0.1';         //Host unter dem die Datenbank erreichbar ist
$db_name = 'bsc_pinnwand';      //Name der Datenbank
$db_user = 'root';              //Benutzername
$db_pass = '';                  //Passwort
$db_table = 'inserate';         //Name der Tabelle

//Datenbankobjekt
$db = null;

//Initialisiere Datenbankverbindung bei Script include.
initDB();

/**
 * Diese Methode liefert die Einträge aus der Datenbank zurück.
 * Die "ausgabe()"-Methode liefert dir ein assoziatives Array mit
 * folgenden Schlüsseln zurück: timestamp, art, titel, preis, kontakt, details.
 * 
 * @return array Array von Datenbankeinträgen / null bei leerer Datenbank
 * @throws \mysqli_sql_exception Falls der Datenbankinhalt nicht gelesen werden kann
 */
function ausgabe()
{
    //globale Variablen
    global $db_table, $db;
    
    //MySQL Query
    $sql = 'SELECT timestamp, art, titel, preis, kontakt, details FROM '.$db_table.' ORDER BY preis ASC';
    $result = $db->query($sql);
    if(false === $result) {
	throw new \mysqli_sql_exception('Konnte Tabelleninhalt nicht abfragen!');
    }
    else
    {
	$return_array = null;
	while ($row = $result->fetch_assoc()) {
	    $return_array[] = $row;
	}
	return $return_array;
    }
}

/**
 * Methode, die einen neuen Eintrag in die Datenbank schreibt. 
 * Die Methode braucht den Eintrag als assoziatives Array
 * (Schlüssel: art, titel, preis, kontakt, details) übergeben.
 * 
 * @param array $array Ein assoziatives Array mit dem neuen Eintrag
 * @return boolean true im Erfolgsfall
 * @throws \InvalidArgumentException Falls das Array nicht die benötigten Schlüssel hat.
 * @throws \mysqli_sql_exception Falls ein MySQL-Fehler beim Eintragen auftrat.
 */
function speichern($array)
{
    if(!isset($array['art'], $array['titel'], $array['preis'], $array['kontakt'], $array['details'])) {
	throw new \InvalidArgumentException('Das übergebene Array hat nicht die korrekte Struktur!');
    }
    //globale Variablen
    global $db_table, $db;
    
    //MySQL Query
    $sql = 'INSERT INTO '.$db_table.'(art,titel,preis,kontakt,details) VALUES ("'
	    .$array['art'].'", "'.$array['titel'].'", "'.$array['preis'].'", "'
	    .$array['kontakt'].'", "'.$array['details'].'")';
    
    if(false === $db->query($sql)) {	    //Query absenden
	throw new \mysqli_sql_exception('Konnte den Eintrag nicht einfügen!');
    }
    return true;
}

/**
 * Löscht die Dummy-Einträge aus der Datenbank.
 * 
 * @return boolean true im Erfolgsfall
 * @throws \mysqli_sql_exception Falls ein MySQL-Fehler beim Löschen auftrat.
 */
function loescheDummy()
{
    //globale Variablen
    global $db_table, $db;
    
    //MySQL Query
    $sql = 'DELETE FROM '.$db_table.' WHERE kontakt="dummy@dummy.de"';
    
    $result = $db->query($sql);		//Query absenden
    if(false === $result) {
	throw new \mysqli_sql_exception('Konnte Dummys nicht löschen!');
    }
    return true;
}

/**
 * Initialisiert die Datenbank und erstellt Dummyeinträge
 * 
 * @throws \mysqli_sql_exception Bei MySQL-Fehlern
 */
function initDB()
{
    //globale Variablen
    global $db_host, $db_name, $db_user, $db_pass, $db_table, $db;
    //Verbindungsaufbau
    $db = @new mysqli($db_host, $db_user, $db_pass);
    if(mysqli_connect_errno()) {
        throw new \mysqli_sql_exception('Konnte keine Verbindung zur Datenbank aufbauen: '
		.mysqli_connect_error().'('.mysqli_connect_errno().')');
    }
    //UTF-8 -Kodierung einstellen
    if(!$db->set_charset("utf8")) {
	throw new \mysqli_sql_exception("Error loading character set utf8: %s\n", $db->error);
    }
    //Datenbank existiert nicht, falls die Auswahl der Datenbank fehlschlägt
    $db_exists = $db->select_db($db_name);
    if(!$db_exists)
    {
	//MySQL Query um Datenbank zu erstellen
	$sql = 'CREATE DATABASE IF NOT EXISTS '.$db_name.' CHARACTER SET utf8 COLLATE utf8_general_ci';
	if(false === $db->query($sql)) {		//Query absenden
	    throw new \mysqli_sql_exception('Konnte Datenbank "'.$db_name.'" nicht anlegen!');
	}
	//auf Datenbank wechseln
	$db->select_db($db_name);
    
	//MySQL Query um Tabelle zu erstellen
	$sql = 'CREATE TABLE IF NOT EXISTS '.$db_table.' (
	    id INT(11) NOT NULL AUTO_INCREMENT,
	    art ENUM("Suche", "Biete") NOT NULL DEFAULT "Suche",
	    titel VARCHAR(50) DEFAULT NULL,
	    preis VARCHAR(10) DEFAULT NULL,
	    kontakt VARCHAR(50) DEFAULT NULL,
	    details TEXT DEFAULT NULL,
	    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	    PRIMARY KEY (id)
	    )';
	
	if (false === $db->query($sql)) {		//Query absenden
	    throw new \mysqli_sql_exception('Konnte Datenbanktabelle "'.$db_table.'" nicht anlegen!');
	}
    
	//MySQL Query um Dummyeinträge zu erstellen
	$sql = 'INSERT INTO '.$db_table.'(art,titel,preis,kontakt,details) VALUES
	    ("Suche","Kaffeemaschine","20€","dummy@dummy.de","Hey Leute, ich suche eine Kaffeemaschine. Dabei ist egal, von welcher Marke sie kommt."),
	    ("Biete","SD-Karte mit 32GB und WLAN","50€","dummy@dummy.de","Hallo, ich biete eine nahezu neue SD-Karte zum Spottpreis an. Sie hat eine WLAN-Funktion integriert. Meldet euch einfach, wenn ihr Interesse habt!")';
	
	if(false === $db->query($sql)) {		//Query absenden
	    throw new \mysqli_sql_exception('Konnte keine Dummy-Einträge erstellen!');
	}
    }    
}
