<?php

require_once('model/AeroportManager.php');
require_once('view/viewAeroportList.php');
require_once('view/viewListVol.php');
require_once('view/viewAeroport.php');

function doAeroportList()
{
    $data = getAeroportList();
    viewAllAeroport( $data);
}

function doAeroportID($id)
{
    $data = getAeroportID ($id);
    viewAeroportID( $data);
}

function doVoltList()
{
    $dataDepart = getAeroportDepart();
    $dataArrivee = getAeroportArrivee();
    viewAllVol( $dataDepart, $dataArrivee);
}