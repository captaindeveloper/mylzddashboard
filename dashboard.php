  <?php
        	require_once 'DBOperations.php';
        	?>
<html>
    <head>
        <title>Last 10 Results</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
function getAllData(str) {
	alert(str);
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                document.getElementById("tableAllData").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getalldata.php?q="+str,true);
        xmlhttp.send();
    
}
</script>
    </head>
    <body style="margin:10px">
    
  <div class="page-header">
  <h1>Rusty Luisaga Dashboard</h1>
  </div>
    <div class="row">
  <div class="col-sm-6">
  <div class="row">
  <div class="col-sm-12">
  <div class="panel panel-default">
		  <div class="panel-heading">Question 1</div>
		  <div class="panel-body"><?php
		        	
		        	$db=new DBOperations();
		        	table($db->getQuery1());
		            ?></div>
		</div>
		</div>
  </div>
  <div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
		  <div class="panel-heading">Question 2</div>
		  <div class="panel-body"><?php
		        	
		        	$db=new DBOperations();
		        	table($db->getQuery2());
		            ?></div>
		</div>
		</div>
		</div>
  </div>
  
  <div class="col-sm-6">
  <div class="row">
  <div class="col-sm-12">
   <div class="panel panel-default">
		  <div class="panel-heading">Question 3</div>
		  <div class="panel-body"><?php
		        	
		        	$db=new DBOperations();
		        	table($db->getQuery3());
		            ?></div>
		</div> 
		</div>
		</div>
		<div class="row">
		<div class="col-sm-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Question 6</div>
		  <div class="panel-body"><?php
		        	
		        	$db=new DBOperations();
		        	table($db->getQuery6());
		            ?></div>
		</div> 
		</div>
		</div>
  </div>
</div>
      <div class="row">
      <div class="col-sm-12">
      <div><span>Item updated at</span><input name="txtupdated" type="date" onchange="getAllData(this.value)"></input></div>
      <div class="panel panel-default">
		  <div class="panel-heading">All Items</div>
		  <div class="panel-body " id="tableAllData"><?php
		        	
		        	$db=new DBOperations();
		        	table($db->getData(''));
		            ?></div>
		</div> 
      </div>
      </div>
       
          
		
    </body>
</html>
<?php 
function table( $result ) {
	$result->fetch_array( MYSQLI_ASSOC );
    echo '<table class="table table-striped table-bordered">';
    tableHead( $result );
    tableBody( $result );
    echo '</table>';
}

function tableHead( $result ) {
    echo '<thead>';
    foreach ( $result as $x ) {
    echo '<tr>';
    foreach ( $x as $k => $y ) {
        echo '<th>' . ucfirst( $k ) . '</th>';
    }
    echo '</tr>';
    break;
    }
    echo '</thead>';
}

function tableBody( $result ) {
    echo '<tbody>';
    foreach ( $result as $x ) {
    echo '<tr>';
    foreach ( $x as $y ) {
        echo '<td>' . $y . '</td>';
    }
    echo '</tr>';
    }
    echo '</tbody>';
}
?>