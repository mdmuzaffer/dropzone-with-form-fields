<?php
include("header.php");
include_once 'db.php';

//Fetch data from table
	
try {
	$sql = 'SELECT * FROM users';
	$query = $connection->query($sql);
	$form_data = $query->fetchAll(PDO::FETCH_ASSOC);
	
	/* echo"<pre>";
	print_r($form_data);
	die; */
	}
	catch (\PDOException $e) {
	   die($e->getMessage());
	}

?>

<!doctype html>
<html lang="en">
  <head>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/basic.css" rel="stylesheet"/> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
  
    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>

h1{
  color: #396;
  font-weight: 100;
  font-size: 40px;
  margin: 40px 0px 20px;
}
[action="upload.php"] {
    width: 100%;
}
button#submit-all {
    padding: 9px 18px;
}
[action="upload.php"] .form-group {
    margin-bottom: 7px;
    display: grid;
}
[action="upload.php"] .col-sm-10 input {
    width: 100%;
    padding: 7px 7px;
}

#clockdiv{
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

.jumbotron{
	background-color: #00816A;
	color:#ffffff;
}
#clockdiv > div{
  padding: 10px;
  border-radius: 3px;
  background: #00BF96;
  display: inline-block;
}

#clockdiv div > span{
  padding: 15px;
  border-radius: 3px;
  background: #00816A;
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 16px;
}

.dropzone {
    min-height: 100px;
    border: 2px dotted rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}
</style>

</head>
<div class="jumbotron">
        <div class="container">
            <div class="row">
	          	<div class="col col-md-6">
                <?php 
                foreach ($form_data as $data){
				
				$user_id = $data['user_id'];
				$form_id = $data['form_id'];
				$name = $data['name'];
				$email = $data['email'];
				$attachments = $data['attachments'];
				

                $end_date = $data['created_at'];
                $start_date = $data['created_at'];
                $sec = strtotime($end_date);
                $diff = abs(strtotime($end_date) - strtotime($start_date));
				
               /*  $competiton_name = $data['user_id'];
                $competiton_description = $data['description'];
                $start_date = $data['start_date'];

                $end_date = $data['end_date'];
                $sec = strtotime($end_date);
                $diff = abs(strtotime($end_date) - strtotime($start_date)); */


                  $years = floor($diff / (365*60*60*24));
                  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                   $date_diff = printf("%d days\n", $days);

                } ?>
	          		<h2 class="display-3"><?php if(!empty($name)){echo $name;}?></h2>
                <p class="description"><?php if(!empty($email)){echo $email;}?></p>
	          	</div>
	          	<div class="col col-md-6">
	          		<h2>Remaining time for registeration</h2>
						<div id="clockdiv">
						  <div>
						    <span class="days"></span>
						    <div class="smalltext">Days</div>
						  </div>
						  <div>
						    <span class="hours"></span>
						    <div class="smalltext">Hours</div>
						  </div>
						  <div>
						    <span class="minutes"></span>
						    <div class="smalltext">Minutes</div>
						  </div>
						  <div>
						    <span class="seconds"></span>
						    <div class="smalltext">Seconds</div>
						  </div>
						</div>
	            </div>
			</div>
        </div>
</div>

<!-- Form Start From Here -->


<div class="container">
  <div class="row">
	 <!-- Success Message Div-->
    <div class="success-message"></div>
	
		<form action="upload.php" enctype="multipart/form-data" method="POST">
			<div class="col-md-6">
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Name:</label>
				<div class="col-sm-10">
				  <input type="text" id ="firstname" name ="firstname"  placeholder="Enter Name" required/>
				</div>
			</div>
			<br>
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
				  <input type="text" id ="email" name ="email" placeholder="Enter Email" required />
				</div>
			</div>
			<br>
				<button type="submit" id="submit-all"> upload </button>
			</div>
			
			<div class="col-md-6">
				<div class="dropzone" id="myDropzone"></div>
			</div>
		</form>
		
						<div class="col col-md-12">
				
				<table class="table">
					<thead>
					  <tr>
						<th>Id</th>
						<th>User Id</th>
						<th>name</th>
						<th>Email</th>
						<th>Image</th>
						<th>Date</th>
					  </tr>
					</thead>
					<tbody>
					<?php foreach($form_data as $data){?>
					
						<tr><td><?php echo $data['user_id'];?></td>
						<td><?php echo $data['form_id'];?></td>
						<td><?php echo $data['name'];?></td>
						<td><?php echo $data['email'];?></td>
						<td><?php echo $data['attachments'];?></td>
						<td><?php echo $data['created_at'];?></td></tr>
					  <?php } ?>
					</tbody>
				  </table>
				</div>
		
  </div>
 </div>
<script>


	Dropzone.options.myDropzone= {
    url: 'upload.php',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
	
	  success:function(file, response){
	        if (response == "true") {
	            $(".success-message").html('<p style="color:green">Your images uplodaed successfully</p>');
				setInterval(function(){ location.reload(); }, 4000);
	        } else {
				$(".success-message").html('<p style="color:red">Some thing wrong please check again</p>');
				setInterval(function(){ location.reload(); }, 4000);

	        }
      },
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit-all").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("email", jQuery("#email").val());
        });
    }
	
}


/* Counter Functionality */
function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}
/*var test = new Date(Date.parse(new Date()));
D M m d Y H i s
  alert(test);*/
const deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
//alert(deadline);
initializeClock('clockdiv', deadline);

</script>