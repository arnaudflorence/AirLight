<?php

require_once 'controller/controller.php';

if (!ISSET($_GET['action']))
  {	// Display standard WebPage index.php
    doAeroportList();
  }
else
  {	// Display Webpage related to index.php?action=[action]
    if ($_GET['action'] == "viewAeroport") // action=viewSessionDetail
      doAeroportID(ISSET($_GET['id']) ? $_GET['id'] : 1);
    else if ($_GET['action'] == "viewListVol") // action=viewSessionDetail
      doVoltList();
    else
      echo "404 not found !"; // Error webpage
  }

//http://fr.whattheflight.com/aeroports/GIG/rio-de-janeiro-intl/