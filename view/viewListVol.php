<?php

function viewAllVol( $dataDepart, $dataArrivee)
{
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/styleVol.css">
        <link rel="stylesheet" href="CSS/styleMap.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
   integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
   crossorigin=""></script>
    </head>   
<body >
    <div id='fond'>
    <div id="main_wrapper">

    <div id=navbar>   
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="http://sites.elannet.info/stasta/arnaud/Aeroport/index.php">AirLight</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a id="connect" href="#">Conection</a></li>
        </ul>
      </div>
    </nav></div>

        <div id="wrapper_table" method="post">
            <div class="card">
                <div class="card-body">

                    <!--Table-->
                    <table class="table table-hover table-responsive-md table-fixed">

                        <!--Table head-->
                        <thead>
                            <tr>
                                <th>Numéro de vol</th>
                                <th>Départ</th>
                                <th></th>
                                <th>Arrivée</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                       <?php
                        $i = 0;            
                        while ($i < count($dataDepart)){
                          
                                echo "<tbody><tr><th scope='row'>".$dataDepart[$i]['NUMERO_VOL']."</th>";
                                echo "<td>".$dataDepart[$i]['NOM_AEROPORT']."</td>";
                                echo "<td>".$dataDepart[$i]['DATE_DEPART']."</td>";
                                echo "<td>".$dataArrivee[$i]['NOM_AEROPORT']."</td>";
                                echo "<td>".$dataArrivee[$i]['DATE_ARRIVE']."</td>";
                                echo "<td><a href='index.php?action=viewReservationVol&amp;id=" .$dataDepart[$i]['ID_VOL']. "'>Réservation</a></td></tr></tbody>";
         
                        $i++;
                        }
                      ?>
                  </table>
              

                </div>
            </div>
        </div>
    </div>
 
<div id="map"></div>
</div>
<script type="text/javascript">

    // création de la map (latitude longitude, niveau de zoom)
    var map = L.map("map").setView([36.1447400,-5.3525700], 3);

    // création du calque images https://leaflet-extras.github.io/leaflet-providers/preview/
    L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}", {
            attribution: "Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC",
            maxZoom: 20,
            minZoom: 3
    
    }).addTo(map);
    
    var southWest = L.latLng(-89.98155760646617, -180),
    northEast = L.latLng(89.99346179538875, 180);
    var bounds = L.latLngBounds(southWest, northEast);

    map.setMaxBounds(bounds);
    map.on("drag", function() {
        map.panInsideBounds(bounds, { animate: false });
    });
    
    
    
    
    <!-- Récupération des aéroports dans la bdd -->
<?php   $j = 0;
     while ($j < count($dataDepart)) {
    $nom = ($dataDepart[$j]['NOM_AEROPORT']);
    //$code = ($aeroport["code_aeroport"]);
    $latitude = ($dataDepart[$j]['LATITUDE']);
    $longitude = ($dataDepart[$j]['LONGITUDE']);
    //Création d'un array qui contient les info nécessaires aux pointeurs
    $dataAeroportDepart[] = array('nom' => $nom, 'position' => array('latitude' => $latitude, 'longitude' => $longitude));
     $j++;} 
// //Array version PHP
// var_dump($dataAeroport);
// echo '<br>';
// //Array version JSON
 //echo json_encode($dataAeroport);
// echo '<br>';
//Conversion array PHP en JSON
$tabJSONDepart = json_encode($dataAeroportDepart);

$k = 0;
     while ($k < count($dataArrivee)) {
    $nom = ($dataArrivee[$k]['NOM_AEROPORT']);
    //$code = ($aeroport["code_aeroport"]);
    $latitude = ($dataArrivee[$k]['LATITUDE']);
    $longitude = ($dataArrivee[$k]['LONGITUDE']);
    //Création d'un array qui contient les info nécessaires aux pointeurs
    $dataAeroportArrivee[] = array('nom' => $nom, 'position' => array('latitude' => $latitude, 'longitude' => $longitude));
     $k++;} 
// //Array version PHP
// var_dump($dataAeroport);
// echo '<br>';
// //Array version JSON
 //echo json_encode($dataAeroport);
// echo '<br>';
//Conversion array PHP en JSON
$tabJSONArrivee = json_encode($dataAeroportArrivee);
?>


//On crée un pointeur sans ombre
var PinIcon = L.Icon.extend({
    options: {
        //shadowUrl: '-shadow.png',
        iconSize:     [45, 55],  // la taille de l'icon
        shadowSize:   [50, 64],  // la taille de l'ombre. On l'a désactivé car on n'a pas d'un fichier pour l'ombre.
        iconAnchor:   [0, 55],  // Le point où on montre le ballon (icon)
        shadowAnchor: [4, 62],   // point pour l'ombre, on n'a pas de l'ombre
        popupAnchor:  [-3, -76]  // l'endroit où sort la description du ballon (icon)
    }
});
//On crée un pointeur rouge
var redIcon = new PinIcon({iconUrl: 'IMG/pointer2.png'});

    
var tabJSONDepart = <?= $tabJSONDepart ?>;
var tabJSONArrivee = <?= $tabJSONArrivee ?>;
//console.log(tabJSONDepart);
//console.log(tabJSONDepart[0]['position']['latitude']);
//console.log(tabJSONDepart[0]['nom']);

//On boucle sur les aéroports dans le tableau JSON et on les affiche grâce aux pointeurs
for(var i = 0; i < tabJSONDepart.length; i++)
{ 
  L.marker([tabJSONDepart[i]['position']['latitude'],tabJSONDepart[i]['position']['longitude']],
  {icon: redIcon}).addTo(map).bindPopup(tabJSONDepart[i]["nom"]);

 } 
 
 //On boucle sur les aéroports dans le tableau JSON et on les affiche grâce aux pointeurs
for(var i = 0; i < tabJSONArrivee.length; i++)
{ 
  L.marker([tabJSONArrivee[i]['position']['latitude'],tabJSONArrivee[i]['position']['longitude']],
  {icon: redIcon}).addTo(map).bindPopup(tabJSONArrivee[i]["nom"]);

 } 

// create a red polyline from an array of LatLng points
for(var i = 0; i < tabJSONArrivee.length; i++)
{
var latlngs = [
    [(tabJSONDepart[i]['position']['latitude']), (tabJSONDepart[i]['position']['longitude'])],
    [(tabJSONArrivee[i]['position']['latitude']), (tabJSONArrivee[i]['position']['longitude'])]
];
var polyline = L.polyline(latlngs, { className: 'my_polyline' }).addTo(map);
} 
    
    </script>                             
</body>
</html>
<?php }?>

<!--// create a red polyline from an array of LatLng points
var latlngs = [
    [(tabJSONDepart[0]['position']['latitude']), (tabJSONDepart[0]['position']['longitude'])],
    [(tabJSONArrivee[0]['position']['latitude']), (tabJSONArrivee[0]['position']['longitude'])]
];
var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);-->