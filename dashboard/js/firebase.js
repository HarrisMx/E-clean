function initMap(){
    var myLatLng = {lat: 28.2293, lng: 25.7479};

    //Maps init values
  var vals = {
      zoom: 5,
      center: {
          lat: -26.2293, 
          lng: 22.7479
      }
  }
var map = new google.maps.Map(document.getElementById('map'),vals);

var greenIcon = {
    url: "http://www.clker.com/cliparts/R/g/O/v/U/h/google-maps-marker-for-residencelamontagne-md.png", // url
    scaledSize: new google.maps.Size(17, 25), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};

var redIcon = {
    url: "https://kohala.es/wp-content/uploads/2017/01/google-pin-117326.png", // url
    scaledSize: new google.maps.Size(20, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};


// Initialize Firebase
var config = {
    apiKey: "AIzaSyD4vE_A2X1IGHoL_PAf_g_gzVpEabjFll0",
    authDomain: "ehealth-cabd5.firebaseapp.com",
    databaseURL: "https://ehealth-cabd5.firebaseio.com",
    projectId: "ehealth-cabd5",
    storageBucket: "ehealth-cabd5.appspot.com",
    messagingSenderId: "13094090679"
  };
firebase.initializeApp(config);

var database = firebase.database();

var starCountRef = firebase.database().ref('tickets/');
starCountRef.on('value', function(snapshot) {


var compliments = Object.keys(snapshot.child('compliment')).length;
var complains = Object.keys(snapshot.child('complain')).length;

for(var i = 1; i <= complains ; i++){
    var lat = snapshot.child('complain').child(i).child('location').child('latitude').val();
    var long = snapshot.child('complain').child(i).child('location').child('longitude').val();

    var mapProps = {
        coords:{
        lat: lat ,
        lng: long
    },
    icon:redIcon
};

addMarker(mapProps);
}

for(var i = 1; i <= compliments ; i++){
    var lat = snapshot.child('compliment').child(i).child('location').child('latitude').val();
    var long = snapshot.child('compliment').child(i).child('location').child('longitude').val();

    var mapProps = {
        coords:{
        lat: lat ,
        lng: long
    },
    icon:greenIcon
};

addMarker(mapProps);
}

$( "div.notification-green" ).text(compliments.toString());
$( "div.notification-red" ).text(complains.toString());

});

  function addMarker(props){
      var marker = new google.maps.Marker({
          position: props.coords,
          map: map,
          icon: props.icon
    });
  }

}