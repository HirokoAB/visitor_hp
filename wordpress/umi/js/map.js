/***************** Google Map API ******************/

function initialize() {
  var latlng = new google.maps.LatLng(38.634281, 141.528421);
  var myOptions = {
    zoom: 16,/*拡大比率*/
    center: latlng,/*表示枠内の中心点*/
    scrollwheel: false,
    mapTypeControlOptions: { mapTypeIds: ['msmvc', google.maps.MapTypeId.ROADMAP] }/*表示タイプの指定*/
  };
  var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);

  var icon = new google.maps.MarkerImage('img/ico.png',
    new google.maps.Size(72,72),/*アイコンサイズ*/
    new google.maps.Point(0,0)
    );
  var markerOptions = {
    position: latlng,
    map: map,
    icon: icon,
    title: '南三陸・海のビジターセンター'
  };
  var marker = new google.maps.Marker(markerOptions);

	var mapStyle = [
      {
          "stylers": [
//		  	{ "hue": "#009AE0" },
            { "saturation": -100 }
          ]
      }
    ];
    var mapType = new google.maps.StyledMapType(mapStyle);
    map.mapTypes.set('GrayScaleMap', mapType);
    map.setMapTypeId('GrayScaleMap');
}

google.maps.event.addDomListener(window, 'load', initialize);
