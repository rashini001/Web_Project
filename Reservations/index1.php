<?php 
require "head.php";
?>

<header class="header">
	<br><br><br><br><br><br>
		 <div class="col-md-12 text-center">
  <h3 class="text-center"><br><br>The Most Consumed Dirnk in the World</h3><br><br>
		<div class="col-md-12 text-center">
			<button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-light btn-lg"><em>Make Your Reservation Now!!</em></button>
		</div>
	</div>
</header>

<div>


<section id="aboutus">
	<div class="container">
		<h3 class="text-center"><br><br>Crezy For Coffee</h3>
		<div class="row">

			<div class="col-sm"><br><br>
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
           				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
           				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" src="img/3.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
           				<img class="d-block w-100" src="img/2.jpg" alt="Second slide">
           				</div>
           				<div class="carousel-item">
           				<img class="d-block w-100" src="img/4.jpg" alt="Third slide">
           				</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous></span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div><br><br>
			</div>

			<div class="col-sm">
				<div class="arranging"><br><hr>
					<h4 class="text-center">Our Career</h4>
					<p><br>“One Love Restaurant” is a beach cafe located in Unawatuna area of Galle. our cafe 
               is built facing the beach and has become a popular restaurant among many tourists due to the beauty of its environment.This is a legally registered cafe. Here, the safety of the customers is also taken care of.Consumers can enjoy the coffe and add feedback about it.Most of our customers are foreigners. our cafe also hosts special beach parties on weekend 
               nights as well as during festivals. we are very crowded during night time. 
               Also it is very busy after 6 pm, because many foreigners come to the beach at night. Also, during 
               the festive season, foreign tourists as well as local tourists come to beach to have fun, so  
               we get very busy during that time. Both local and foreign tourists come to fresh, so we 
               serve new delicious recipes and drinks from local and foreign cuisines. Also, from our cafe, 
               we provide space to enjoy food as well as order and buy to go.<br><br><br></p><hr>
				</div>
			</div>
		</div><br>
	</div>
</section>

<div class="header2"></div>

 
 <div class id="gallery"><br>
 	<div class="container">
 		<h3 class="text-center"><br>Gallery<br></h3>
 		<h4 class="text-center">It's not just a coffee<br><br></h4>
 		<div class="d-flex flex-row flex-wrap justify-content-center">
 			<div class="d-flex flex-column">
              <img src="img/8.jpg" class="img-fluid">
              <img src="img/9.jpg" class="img-fluid">
            </div>
            <div class="d-flex flex-column">
              <img src="img/5.jpg" class="img-fluid">
              <img src="img/6.jpg" class="img-fluid">
            </div>
            <div class="d-flex flex-column">
               <img src="img/7.jpg" class="img-fluid">
               <img src="img/10.jpg" class="img-fluid">
            </div>
            <div class="d-flex flex-column">
               <img src="img/4.jpg" class="img-fluid">
               <img src="img/11.png" class="img-fluid"> 	
            </div>
 		</div>
 	</div>
 </div><br><br>

 <div class="container" id="reservation">
    <h3 class="text-center"><br><br>Reservation<br><br></h3>
    <img  src="img/16.jpg" width="100%" height="250" class="img-fluid rounded">
    <button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-dark btn-block btn-lg">Make Your Reservation Now!</button>
        
</div><br><br>

 <div class="header2">
 </div>

 

 <section class="map" id="footer">
 	<div class="container">
 		<h3 class="text-center"><br><br>Find us!</h3><br>
 		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15871.506987107816!2d80.2440546943332!3d6.011656893396555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae172f162bf926d%3A0xc0444c5e8377446c!2sUnawatuna!5e0!3m2!1sen!2slk!4v1692983007343!5m2!1sen!2slk" width="100%" height="250" style="border:0;" allowfullscreen></iframe>
 		<div class="row staff">
 			<div class="col">
 				<h4><strong>Opening Hours</strong></h4>
 				<div class="signup-form">
                <form action="#footer" method="post">
                        <div class="form-group">
 					<label>Enter Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Date" required="required">	
 				</div>
 				<div  class="form-group">
                            <button type="submit" name="check_schedule" class="btn btn-dark btn-block">Check Open Time</button>
                </div>
            </from>

            <?php 
            if(isset($_POST['check_schedule']))
            {
            	require 'connection/db.con.php';

            	$date = $_POST['date'];

            	$sql = "SELECT * FROM schedule WHERE date = '$date'";
    			$result = $con->query($sql);
    			if ($result->num_rows == 1)
    			{
    				while($row = $result->fetch_assoc())
    				{
    					echo "<table class='table table-sm table-striped table-dark text-center>
                   <thead>
                    <tr>
                    <th scope='col'>Date</th>
                    <th scope='col'>Open Time</th>
                    <th scope='col'>Close Time</th>
                    </tr>
                   </thead>
                   <tbody>
                    <tr>
                    <th scope='row'><em>". $date . "</em></th>
                    <td>".$row['open_time']."</td>
                    <td>".$row['close_time']."</td>
                    </tr>
                   </tbody>
                </table>";
    				}
    			}
    			else
    			{
    				echo "<table class='table table-striped table-dark text-center'>
                   <thead>
                    <tr>
                    <th scope='col'>Date</th>
                    <th scope='col'>Open Time</th>
                    <th scope='col'>Close Time</th>
                    </tr>
                   </thead>
                   <tbody>
                    <tr>
                    <th scope='row'><em>". $date . "</em></th>
                    <td>07:00</td>
                    <td>00:00</td>
                    </tr>
                   </tbody>
                </table>";
    			}

    			mysqli_close($con);
            }
            ?>

 			</div><br>
 		</div>

 		<div class="col">
            <h4 class="text-right"><strong>Visit Us</strong></h4>
            <p class="text-right">Crezy For Coffe<br><i class="fa fa-map-marker"></i>&nbsp; 23,Mani Street,Galle  <br><br>email: onelove@gmail.com<br>phone: +94713931089</p>
        </div>
    </div>
</section>

        <?php
		require "footer.php";
		?>
 		
 	


