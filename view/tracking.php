<?php require_once 'header.php';?>
      <div class="main-panel">
        <div class="content-wrapper">         
            <div id="map"style="height:400px;"></div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
<?php include_once("footer.php") ?>
<script>

      // This example creates a 2-pixel-wide red polyline showing the path of
      // the first trans-Pacific flight between Oakland, CA, and Brisbane,
      // Australia which was made by Charles Kingsford Smith.

      function initAutocomplete() {
          var iconBase = 'images/';
        var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 25.164920894986718, lng: 55.47125816345215},
      zoom: 14,
      mapTypeId: 'roadmap'
    });
    var features = <?php echo $usersJson?>;
     
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    flightPlanCoordinates = [];
    features.forEach(function(feature) {   
        var locations =  feature.location; 
        for(i=0;i<locations.length;i++) { 
            var location = {lat:locations[i]['lat'],lng:locations[i]['long']};
            flightPlanCoordinates.push(location);
        }
       // for (i = 0; i < flightPlanCoordinates.length; i++) {  
      
        
        var icon = {
           
                url: feature.img, // url              
                scaledSize: new google.maps.Size(30, 30), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(15, 53), // anchor
               
            };
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(flightPlanCoordinates[0]['lat'], flightPlanCoordinates[0]['lng']),            
                icon: iconBase + 'beachflag.png',                                        
                title:feature.fullName,
                map:map,
                
            });
            
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(flightPlanCoordinates[flightPlanCoordinates.length - 1]['lat'], flightPlanCoordinates[flightPlanCoordinates.length - 1]['lng']),            
                icon: iconBase + 'pin1.png',                                        
                title:feature.fullName,
                map:map,
                
            });
            
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(flightPlanCoordinates[flightPlanCoordinates.length - 1]['lat'], flightPlanCoordinates[flightPlanCoordinates.length - 1]['lng']),
              
            icon: icon,                       
                title:feature.fullName,
                map:map,
               
            });
            
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent("sdsadsa");
                  infowindow.open(map, marker);
                }
            })(marker, i));
      //  }
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
    });   
    }
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initAutocomplete"
         async defer></script>
    
    </script>