<?php

function viewAllAeroport( $data)
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
        <link rel="stylesheet" href="CSS/styleAllAeroport.css">
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

    <div id=navbar><nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="http://sites.elannet.info/stasta/arnaud/Aeroport/index.php">AirLight</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a id="connect" href="#">Conection</a></li>
        </ul>
        <button onclick="window.location.href='index.php?action=viewListVol'" class="btn btn-danger navbar-btn">Vol</button>
      </div>
    </nav></div>

        <div id="wrapper_table" action="index.php?action=set&id=0" method="post">
            <div class="card">
                <div class="card-body">

                    <!--Table-->
                    <table class="table table-hover table-responsive-md table-fixed">

                        <!--Table head-->
                        <thead>
                            <tr>
                                <th>Code IATA</th>
                                <th>Nom de l'Aéroport</th>  
                                <th>Pays</th>
                                <th>Villes</th>
                                <th>Liens</th>

                            </tr>
                        </thead>
                       <?php
                        $i = 0;            
                        while ($i < count($data)){
                             
                                echo "<tbody><tr><th scope='row'>".$data[$i]['CODE']."</th>";
                                echo "<td>".$data[$i]['NOM_AEROPORT']."</td>";
                                echo "<td>".$data[$i]['NOM_VILLE']."</td>";
                                echo "<td>".$data[$i]['NOM_PAYS']."</td>";
                                echo "<td><a href='index.php?action=viewAeroport&amp;id=" .$data[$i]['ID_AEROPORT']. "'>Carte</a></td></tr></tbody>";
                               
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
    var map = L.map("map").setView([48.5376,7.62717], 3);

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

    //ajout d\'un marker';
      <?php             
        $j = 0;
     while ($j < count($data)){?> 
        var marker = L.marker([<?= $data[$j]['LATITUDE'] ?>,<?= $data[$j]['LONGITUDE'] ?>]).addTo(map);
        //Ajoout d\'un popup
        marker.bindPopup('<p><?= $data[$j]['NOM_AEROPORT'] ?></p>');
        <?php $j++;} ?>

  
    
    </script>                             
</body>
</html>
<?php }?>
 