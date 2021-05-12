<?php
$servername="localhost";
$username="root";
$pass="";
$db="test1";

$con=mysqli_connect($servername,$username,$pass,$db);

if($con){
	//echo "connection success";

}
else{
	echo "not connect";
}









?>

<!DOCTYPE html>
<html>
<head>
	<title>Booking APP</title>

<?php include("links.php"); ?>
</head>
<body>

		<div class="container">
		<div class="col-md-7 mt-3 ">
		
		<div class="card" style="margin-left: 100px;">
 			 <div class="card-header text-center">
   				<h4> Booking Form</h4>
  			</div>

    <div class="card-body text-center">
   	<div class=" col-md-8 text-center">
   
    <form method="post"  action="">

	       <select name="city"  class=" form-control" >
  	 	
    		<option value="Rajkot">Rajkot</option>
    		<option value="Surat">Surat</option>
    		<option value="Delhi">Delhi</option>
    		<option value="Mumbai">Mumbai</option>
	       </select>
<br>

	       <select name="vehicle" class=" form-control">
  	
  	     <option value="Car"  >Car</option>
  	     <option value="Bike">Bike</option>
 
	       </select>

	
<br>


        <input class="form-control" name="date" placeholder="MM/DD/YYY" type="date"/>
      

<br>
          Full Time <input type="radio" name="btype" id="ftid" value="full">
          Half Time <input type="radio" name="btype" id="htid" value="half">
          Horly<input type="radio" name="btype" id="hrid" value="hour">

<br>

          <select id="HalfDay"  name="HalfDay" class=" form-control" >
          
          <option value="9 AM to 1 PM"  >9 to 1 PM</option>
          <option value="2 AM to 9 AM">2 AM to 9 AM</option>
          </select>
<br>

          <div id="hourly">

          <select id="hour" name="hour" class=" form-control" >
          <option>Time</option>
          <option value="9 AM to 10 AM"  >9 AM to 10 AM</option>
          <option value="11 AM to 12 AM">11 AM to 12 AM</option>
          </select>
          <br>
          

        </div>

        <input type="text" name="destination" class="form-control" placeholder="destination" required><br>

          <input type="submit" name="submit"  class="form-control btn btn-danger"></div>


	
    </form>

</div>

</div>

	
  </div>
</div>
</div>
	</div>
	</div>




	<script>




    $(document).ready(function(){
      

        $('#HalfDay').hide();
        $('#hourly').hide();

      $('#htid').click(function(){

          $('#HalfDay').show();
          $('#hourly').hide();


          //alert(document.getElementById("#ftid").value);
      });

      $('#ftid').click(function(){

          $('#HalfDay').hide();
          $('#hourly').hide();


          
      });


      $('#hrid').click(function(){

          $('#hourly').show();
          $('#HalfDay').hide();

          //alert(document.getElementById("#ftid").value);
      });

     
     

    });
    
</script>




</body>
</html>

<?php









if(isset($_POST['submit'])){

//$_POST['id'];

$city=$_POST['city'];
$vehicle=$_POST['vehicle'];
$date=$_POST['date'];
$btype=$_POST['btype'];
$destination=$_POST['destination'];
$halfday=$_POST['HalfDay'];
$hour=$_POST['hour'];




  $q="SELECT * FROM `boooking` WHERE `date`='".$_POST['date']."' AND `time`='".$_POST['HalfDay'] ."'  ";
  $re=mysqli_query($con,$q);


  $row=mysqli_fetch_array($re);

  if($row['time']==$_POST['HalfDay']) {

    echo "<script>alert('allready Booked')</script>";
  }

  else if($_POST['btype']=='hour'){
      
       $query="INSERT INTO `boooking`(`city`, `vehicle`, `date`, `btype`,`time`,`destination`) VALUES ('$city','$vehicle','$date','$btype','$hour','$destination')";


  $rs1=mysqli_query($con,$query);
    $last_id = mysqli_insert_id($con);

  if($rs1){
    //echo " record inserted";
  }
  else{
    echo "not inserted";
  }

    }
    else if( $_POST['btype']=='full'){
      $query1="INSERT INTO `boooking`(`city`, `vehicle`, `date`, `btype`,`time`,`destination`) VALUES ('$city','$vehicle','$date','$btype','Full Day','$destination')";

         $rs2=mysqli_query($con,$query1);
         $last_id = mysqli_insert_id($con);
          //echo $last_id;

  if($rs2){
    //echo " record inserted";
  }
  else{
    echo "not inserted";
  }


    }

    else{

      $query2="INSERT INTO `boooking`(`city`, `vehicle`, `date`, `btype`,`time`,`destination`) VALUES ('$city','$vehicle','$date','$btype','$halfday','$destination')";

        $rs3=mysqli_query($con,$query2);
          $last_id = mysqli_insert_id($con);

  if($rs3){
    //echo " record inserted";
  }
  else{
    echo "not inserted";
  }


    }
   
    
  }





  $qq="SELECT * FROM `boooking`";

$rs=mysqli_query($con,$qq);


error_reporting("all"); 
   

  





	$sel="SELECT * FROM `boooking` WHERE id='".$last_id."'";

$result=mysqli_query($con,$sel);
	
$i=1;
while($row=mysqli_fetch_array($result)) {



  echo "<h3 style='text-align:center' class='mt-4'>Your Booking Summary</h3>";
  echo "<br>";
	
  echo "<div class='text-center'>";
  
	echo "City :" .  " " .$row['city'] . "<br>"   ;
	echo "Vehicle :" . " " .$row['vehicle'] . "<br>";
	echo "Date :" . "" .$row['date'] ."<br>";
  echo "Booking Type :". " " .$row['btype'] ."Day"."<br>";
  echo "Booking Time :" . " " .$row['time'] ."<br>";
  echo "Destination :" . " ". $row['destination'] ."<br>";
	echo "<br>";
  echo "</div>";
	$i++;
}








?>