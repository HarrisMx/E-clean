<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Environmental Health System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWgRvmRZTQcR_A7CLxwXsmNm527biFouk&callback=initMap" async defer></script>
  <script src="https://www.gstatic.com/firebasejs/5.5.2/firebase.js"></script>
  <script src="js/firebase.js" type="text/javascript"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script src="js/firebase.js" type="text/javascript"></script> 
  <style type="text/css">
	#map{
      width:100%;
      height: 600px;
  }

  .ticket a{
    color:#A9B5BD;
  }

div[class^="notification-"]{
    color:#A9B5BD;
    float:right;
    width:20px;
    height:20px;
}
  .ticket a:hover{
    color:#343A40;
  }

  .alert{
     text-decoration:none;
  }
  .ticket:hover{
    curser: hand;
    background-color: #ccc;
    border-radius: 20px;
    
    color:#343A40;
  }
  .ticket:hover a{
    font-weight:bold;
    color:#343A40;
    text-decoration:none;
  }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Environmental Health System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="home.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Tickets</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li class="ticket">
              <div class="alert">
                <a href="tickets.php?attended=yes" >Attended</a>&nbsp;<div class="notification-green">2</div>
              </div>
            </li>
            <li class="ticket">
              <div class="alert">
                <a href="tickets.php?attended=no" >Not Attended</a>&nbsp;<div class="notification-red">1</div>
              </div>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
        </ul>
        
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        </li>
          
        <li class="nav-item dropdown">
     
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">

       <div class="card mb-3">
        <div class="card-header">
          <i class="fa"></i>  Un Attended Tickets</div>
        <div class="card-body">
        <div id="accordion">

<div class="card">
  <div class="card-header">
    <a class="card-link accord-header" data-toggle="collapse" href="#collapseOne">
      All Un Attended tickets
    </a>
  </div>
  <div id="collapseOne" class="collapse show" data-parent="#accordion">
    <div class="card-body">
    <table class="table tickets">
  <thead class="thead-dark">
  <tbody class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Location</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
    </tbody>
  </thead>
  <tbody>
    
  </tbody>
</table>
  </tbody>
</table>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
      All Attended Tickets
    </a>
  </div>
  <div id="collapseTwo" class="collapse" data-parent="#accordion">
    <div class="card-body">
    <table class="table attended">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Location</th>
      <th scope="col">Message</th>
    </tr>
  </tbody>
</table>
    </div>
  </div>
</div>


</div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
          
        
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">You are about to Leave your Dashboard.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="php/classes/logout.php" method="POST">
              <button class="btn btn-secondary" name="logout" type="submit">
                  Logout
              </button>  
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript">
        $(document).ready(function(){ 

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


var i = 1;
while( compliments >= i )
{
    var row = "<tr><td>" + i + "</td><td>" +snapshot.child('complain').child(i).child('location').child('latitude').val() +" , "+snapshot.child('complain').child(i).child('location').child('longitude').val()+"</td><td> " + snapshot.child('complain').child(i).child('message').val()+ "</td><td><Button class=\"btn btn-md btn-primary\">Attended</Button></td></tr>";
    $('tbody').append(row);
    
   
i++;
}

var j = 1;
while( compliments >= j )
{
    var row = "<tr><td>" + j + "</td><td>" +snapshot.child('complain').child(i).child('location').child('latitude').val() +" , "+snapshot.child('complain').child(j).child('location').child('longitude').val()+"</td><td> " + snapshot.child('complain').child(j).child('message').val()+ "</td><td><Button class=\"btn btn-md btn-primary\">Attended</Button></td></tr>";
    $('.attended').append(row);
    
j++;
}

        });
    });
    </script>
    
  </div>
</body>
</html>
