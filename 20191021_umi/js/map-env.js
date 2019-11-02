/***************** Google Map API ******************/


//
//function initialize() {
//  var latlng1 = new google.maps.LatLng(38.824771, 141.586855);
//  var latlng2 = new google.maps.LatLng(38.814585, 141.567160);
//  var latlng3 = new google.maps.LatLng(38.824771, 141.586855);
// 
//  var opts1 = {
//    zoom: 13,
//    center: latlng1,
//    mapTypeId: google.maps.MapTypeId.ROADMAP
//  };
// 
//  var opts2 = {
//    zoom: 13,
//    center: latlng2,
//    mapTypeId: google.maps.MapTypeId.ROADMAP
//  };
// 
//  var opts3 = {
//    zoom: 13,
//    center: latlng3,
//    mapTypeId: google.maps.MapTypeId.ROADMAP
//  };
// 
//  var map1 = new google.maps.Map(document.getElementById("map_canvas1"), opts1);
//  var marker1 = new google.maps.Marker({
//    position: latlng1,   //マーカーの位置
//    map: map1,   //表示する地図
//    title: "東京本社"   //ロールオーバー テキスト
//   });
//  var map2 = new google.maps.Map(document.getElementById("map_canvas2"), opts2);
//  var marker2 = new google.maps.Marker({
//    position: latlng2,   //マーカーの位置
//    map: map2,   //表示する地図
//    title: "大阪支店"   //ロールオーバー テキスト
//   });
//  var map3 = new google.maps.Map(document.getElementById("map_canvas3"), opts3);
//  var marker3 = new google.maps.Marker({
//    position: latlng3,   //マーカーの位置
//    map: map3,   //表示する地図
//    title: "福岡営業所"   //ロールオーバー テキスト
//   });
//}




//function initialize() {
//  var latlng = new google.maps.LatLng(38.634281, 141.528421);
//  var myOptions = {
//  zoom: 14, /*拡大比率*/
//    center: latlng,/*表示枠内の中心点*/
//    scrollwheel: false,
//    mapTypeControlOptions: { mapTypeIds: ['msmvc', google.maps.MapTypeId.ROADMAP] }/*表示タイプの指定*/
//  };
//  var map = new google.maps.Map(document.getElementById('map_canvas1'), myOptions);
//
//  var icon = new google.maps.MarkerImage('img/ico.png',
//    new google.maps.Size(72,72),/*アイコンサイズ*/
//    new google.maps.Point(0,0)
//    );
//  var markerOptions = {
//    position: latlng,
//    map: map,
//    icon: icon,
//    title: '南三陸・海のビジターセンター'
//  };
//  var marker = new google.maps.Marker(markerOptions);
//
//	var mapStyle = [
//      {
//          "stylers": [
////		  	{ "hue": "#009AE0" },
//            { "saturation": -100 }
//          ]
//      }
//    ];
//    var mapType = new google.maps.StyledMapType(mapStyle);
//    map.mapTypes.set('GrayScaleMap', mapType);
//    map.setMapTypeId('GrayScaleMap');
//}
//
//google.maps.event.addDomListener(window, 'load', initialize);





function googleMap() {
	
  var latlng = new google.maps.LatLng(38.824771, 141.586855);/* 座標 */
  var myOptions = {
  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map1'), myOptions);
  
  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: 'お伊勢浜',/*タイトル*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
  { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  
  
function googleMap2() {
	  
  var latlng = new google.maps.LatLng(38.814585, 141.567160);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map2'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '大谷海岸',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  
  
function googleMap3() {
	  
  var latlng = new google.maps.LatLng(38.781610, 141.517811);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map3'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '赤崎海岸',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  
  
function googleMap4() {
	  
  var latlng = new google.maps.LatLng(38.750453, 141.466874);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map4'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '田束山',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  

function googleMap5() {
	  
  var latlng = new google.maps.LatLng(38.692021, 141.559893);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map5'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '歌津崎',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  
  
function googleMap6() {
	  
  var latlng = new google.maps.LatLng(38.709175, 141.535738);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map6'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '館崎',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  

function googleMap7() {
	  
  var latlng = new google.maps.LatLng(38.668042, 141.462263);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map7'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '荒島',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  

function googleMap8() {
	  
  var latlng = new google.maps.LatLng(38.651827, 141.489248);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map8'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '椿島',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };


function googleMap9() {
	  
  var latlng = new google.maps.LatLng(38.630306, 141.527859);/* 座標 */  
  var myOptions = {  zoom: 14, /*拡大比率*/
  center: latlng,
  mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map9'), myOptions);

  /*アイコン設定*/
  var icon = new google.maps.MarkerImage('https://maps.google.com/mapfiles/ms/icons/blue-dot.png',/*画像url*/
  new google.maps.Size(32,32),/*アイコンサイズ*/
  new google.maps.Point(0,0)/*アイコン位置*/
  );
  
  var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '神割崎',/*タイトル*/
  animation: google.maps.Animation.DROP/*アニメーション*/
  };
  var marker = new google.maps.Marker(markerOptions);
  /*取得スタイルの貼り付け*/
  var styleOptions = [
  {
  "stylers": [
   { "saturation": -100 }
  ]
  }
  ];
  var styledMapOptions = { name: '　' }/*地図右上のタイトル*/
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('style', sampleType);
  map.setMapTypeId('style');
  };
  
  

  
  google.maps.event.addDomListener(window, 'load', function() {
     googleMap();
     googleMap2();
	 googleMap3();
     googleMap4();
	 googleMap5();
     googleMap6();
	 googleMap7();
     googleMap8();
	 googleMap9();
  });
  