<?php

function viewAeroportID( $data)
{
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
        <script src="https://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/styleAeroport.css">
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
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="http://sites.elannet.info/stasta/arnaud/Aeroport/index.php">AirLight</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link" href="index.php?action=viewListVol">Vol</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        <div id="wrapper_table" action="index.php?action=set&id=1" method="post">
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
                            </tr>
                        </thead>
                       <?php
                        $i = 0;            
                        while ($i < count($data)){
                             
                                echo "<tbody><tr><th scope='row'>".$data[$i]['CODE']."</th>";
                                echo "<td>".$data[$i]['NOM_AEROPORT']."</td>";
                                echo "<td>".$data[$i]['NOM_VILLE']."</td>";
                                echo "<td>".$data[$i]['NOM_PAYS']."</td>";                             
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
    <?php             
     $j = 0;
     while ($j < count($data)){?>    
    // création de la map (latitude longitude, niveau de zoom)
    var map = L.map("map").setView([<?= $data[$j]['LATITUDE'] ?>,<?= $data[$j]['LONGITUDE'] ?>], 10);
    <?php $j++;} ?>
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
 