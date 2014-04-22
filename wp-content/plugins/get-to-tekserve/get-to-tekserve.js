	var geocoder;
	var map;
	var tekMarker;
	var startMarker;
	var meIcon;
	var directionsDisplay;
	var directionsService;
	var mapAddress;
	var mapAddressLat;
	var mapAddressLng;
	var polylineOptionsActual;
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var mapZoom = 16;
		mapAddress = "119 W 23rd St. New York, NY 10011";
		mapAddressLat = 40.7433349;
		mapAddressLng = -73.9934616;
		var mapStyles = [
		{
		"featureType": "landscape.man_made",
		"elementType": "geometry.stroke",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#c33f07" }
		]
	  },{
		"featureType": "landscape",
		"elementType": "geometry.fill",
		"stylers": [
		  { "visibility": "on" },
		  { "color": "#f36f37" }
		]
	  },{
		"featureType": "poi",
		"stylers": [
		  { "visibility": "simplified" }
		]
	  },{
		"elementType": "labels.icon",
		"stylers": [
		  { "hue": "#00d4ff" },
		  { "saturation": 100 }
		]
	  },{
		"featureType": "road",
		"elementType": "geometry",
		"stylers": [
		  { "color": "#ffffff" }
		]
	  },{
		"featureType": "poi.park",
		"elementType": "geometry",
		"stylers": [
		  { "color": "#40a8c9" },
		  { "visibility": "on" }
		]
	  },{
		"featureType": "water",
		"elementType": "geometry",
		"stylers": [
		  { "color": "#004d72" }
		]
	  },{
		"elementType": "labels.text.fill",
		"stylers": [
		  { "color": "#40a8c9" },
		  { "visibility": "on" }
		]
	  },{
		"elementType": "labels.text.stroke",
		"stylers": [
		  { "color": "#ffffff" },
		  { "weight": 5.3 }
		]
	  },{
		"featureType": "transit.line",
		"elementType": "geometry.fill",
		"stylers": [
		  { "color": "#808080" },
		  { "visibility": "off" }
		]
	  },{
		"featureType": "administrative",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.attraction",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.business",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.medical",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.place_of_worship",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.school",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "poi.sports_complex",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "road.local",
		"stylers": [
		  { "visibility": "simplified" }
		]
	  },{
		"featureType": "transit.station.airport",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "transit.station.bus",
		"stylers": [
		  { "visibility": "off" }
		]
	  },{
		"featureType": "transit.station.rail",
		"stylers": [
		  { "visibility": "simplified" }
		]
	  },{
		"featureType": "administrative.land_parcel",
		"stylers": [
		  { "visibility": "off" }
		]
	  }
	];
		directionsService = new google.maps.DirectionsService();
		var mapOptions = {
			zoom: mapZoom,
			center: new google.maps.LatLng(mapAddressLat, mapAddressLng),
			styles: mapStyles,
			draggable: false,
			scrollwheel: false,
			zoomControl: true,
			zoomControlOptions: {
			  style: google.maps.ZoomControlStyle.SMALL
			}
		};
		var contentString = "<div id=\'content\' style=\'border: 2px solid white; min-height: 300px; min-width: 300px;\'>"+
			"<div id=\'logo\' style=\'background-color: #40a8c9; background-image: url(teklogo.svg); background-repeat: no-repeat; background-size: contain; width: 100%; height: 25%;\'>"+
			"<span style=\'visibility: hidden;\'>Tekserve Logo Image</span>"+
			"</div>"+
			"<div id=\'bodyContent\'>"+
			"<table border=\'0\'>"+
			"<tbody>"+
			"<tr>"+
			"<td style=\'width: 45%; padding-right: 2em;\'><strong>Train Line</strong></td>"+
			"<td style=\'width: 45%;\'><strong>Station / Stop</strong></td>"+
			"</tr>"+
			"<tr>"+
			"<td>F / M &amp; NJ PATH</td>"+
			"<td>23rd St. &amp; 6th Ave.</td>"+
			"</tr>"+
			"<tr>"+
			"<td>1</td>"+
			"<td>23rd St. &amp; 7th Ave.</td>"+
			"</tr>"+
			"<tr>"+
			"<td>N / R</td>"+
			"<td>23rd St. &amp; Broadway</td>"+
			"</tr>"+
			"<tr>"+
			"<td>C / E</td>"+
			"<td>23rd St. &amp; 8th Ave.</td>"+
			"</tr>"+
			"<tr>"+
			"<td>6</td>"+
			"<td>23rd St. &amp; Park Ave.</td>"+
			"</tr>"+
			"</tbody>"+
			"</table>"+
			"</div>"+
			"</div>";
		

		var infowindow = new google.maps.InfoWindow({
			content: contentString,
			position: new google.maps.LatLng(mapAddressLat, mapAddressLng)
		});
		map = new google.maps.Map(document.getElementById("map-canvas"),
			mapOptions);
		polylineOptionsActual = new google.maps.Polyline({
			strokeColor: "#004d72",
			strokeOpacity: .6,
			strokeWeight: 12
		});
		directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true, polylineOptions: polylineOptionsActual});
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("directions-panel"));
		tekMarker = {
			url: "/wp-content/plugins/get-to-tekserve/tekmarker2.svg",
			size: new google.maps.Size(64, 64),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(32, 64)
		};
		meIcon = {
			url: "/wp-content/plugins/get-to-tekserve/me2.svg",
			size: new google.maps.Size(64, 64),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(32, 64)
		};
		marker = new google.maps.Marker({
			map: map,
			icon: tekMarker,
			draggable: false,
			animation: google.maps.Animation.DROP,
			position: new google.maps.LatLng(mapAddressLat, mapAddressLng),
		});
		google.maps.event.addListener(marker, "click", function() {
			infowindow.open(map,marker);
		});
	
	}

	var startAddress;

	function codeStart() {
		var address = document.getElementById("start-address").value;
		geocoder.geocode( { "address": address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				startAddress = results[0].geometry.location;
				if (startMarker) {
				//if marker already was created change positon
					startMarker.setPosition(startAddress);
				}
				else {
					startMarker = new google.maps.Marker({
						map: map,
						position: startAddress,
						icon: meIcon
					});
				}
			calcRoute();
			} else {
				alert("We couldn\'t get your directions because: " + status);
			}
		});
	}

	function getToTekserveLoadScript() {
		 if ($j('#get-to-tekserve').hasClass('initialized')) {
		 console.log('Google Maps already initialized');
		 }
		 else {
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&" +
			  "callback=initialize";
			document.body.appendChild(script);
			$j('#get-to-tekserve').addClass('initialized')
		}
	}

// 	window.onload = loadScript;

	function calcRoute() {
	  var selectedMode = document.getElementById("mode").value;
	  var request = {
		  origin: startAddress,
		  destination: new google.maps.LatLng(mapAddressLat, mapAddressLng),
		  // Note that Javascript allows us to access the constant
		  // using square brackets and a string value as its
		  // "property."
		  travelMode: google.maps.TravelMode[selectedMode]
	  };
	  directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
		  directionsDisplay.setDirections(response);
		}
	  });
	}