
<?php

require_once('model/Manager.php');

// Get categories and them id
function getAeroportList()
{
  $command = "SELECT ID_AEROPORT," .
    " NOM_AEROPORT," .
    " CODE," .
    " LATITUDE," .
    " LONGITUDE," .
    " NOM_VILLE," .
    " NOM_PAYS" .
    " FROM AEROPORT a, PAYS p, VILLE v" .
    " WHERE a.ID_VILLE = v.ID_VILLE" .
    " AND p.ID_PAYS = v.ID_PAYS";
  $elanDb = new SQL_Connect();
  $elanDb->connect("Arnaud_Aeroport");
  $answer = $elanDb->ask($command);
  return ($answer);
}

function getAeroportID($id)
{
  $command = "SELECT ID_AEROPORT," .
    " NOM_AEROPORT," .
    " CODE," .
    " LATITUDE," .
    " LONGITUDE," .
    " NOM_VILLE," .
    " NOM_PAYS" .
    " FROM AEROPORT a, PAYS p, VILLE v" .
    " WHERE a.ID_VILLE = v.ID_VILLE" .
    " AND p.ID_PAYS = v.ID_PAYS" .
    " AND ID_AEROPORT = " . $id ."";
  $elanDb = new SQL_Connect();
  $elanDb->connect("Arnaud_Aeroport");
  $answer = $elanDb->ask($command);
  return ($answer);
}

function getAeroportDepart()
{
  $command = "SELECT ID_VOL," .
    " NUMERO_VOL," .
    " ID_AEROPORT_DEPART," .
    " NOM_AEROPORT," .
    " LATITUDE," .
    " LONGITUDE," .
    " DATE_DEPART" .
    " FROM VOL v, AEROPORT a" .
    " WHERE a.ID_AEROPORT = v.ID_AEROPORT_DEPART";
  $elanDb = new SQL_Connect();
  $elanDb->connect("Arnaud_Aeroport");
  $answer = $elanDb->ask($command);
  return ($answer);
}

function getAeroportArrivee()
{
  $command = "SELECT ID_VOL," .
    " NUMERO_VOL," .
    " ID_AEROPORT_ARRIVEE," .
    " NOM_AEROPORT," .
    " LATITUDE," .
    " LONGITUDE," .
    " DATE_ARRIVE" .
    " FROM VOL v, AEROPORT a" .
    " WHERE a.ID_AEROPORT = v.ID_AEROPORT_ARRIVEE";
  $elanDb = new SQL_Connect();
  $elanDb->connect("Arnaud_Aeroport");
  $answer = $elanDb->ask($command);
  return ($answer);
}

?>
