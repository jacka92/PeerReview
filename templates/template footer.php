<?php
	echo "
		<!-- Close body text formatting -->
		</div>

		<!-- Fixed footer -->
		<nav class='navbar navbar-inverse navbar-fixed-bottom'>
		<div class='row'> </div>
			<div class='container'>
				<div class='navbar-footer'>";
    if (!isset($_SESSION)||empty($_SESSION['user_id'])){
	}else{
		echo "<a class='navbar-brand' href='logout.php'>Log Out</a>";
	}
	echo "
				</div>
			</div>
		</nav>

		<!-- Bootstrap core JavaScript -->
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
		<script src='js/bootstrap.min.js'></script>
        
	";
?>