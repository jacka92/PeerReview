<html>
    <head>
        <title>Forum</title>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <script src='jquery-ui-1.11.3/external/jquery/jquery.js'></script>
        <script src='jquery-ui-1.11.3/jquery-ui.js'></script>
                  <script type='text/javascript'>
            $(document).ready(function () {
                var right = $('#pacman').offset().left;
                $('#pacman').css({right:right}).dequeue().animate({'left':'96.5%'}, 4000);
            });
            
            
        </script>
        <?php include 'templates/imports_index.php'; ?>
<?php
	session_start();
	session_unset();
	session_destroy();
?>
<?php


echo "<meta http-equiv='refresh' content=\"4;URL='index.php'\">


	</head>
	<body>
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container'>
				<div class='navbar-header'>
					<a class='navbar-brand' href='index.php'>Peer Review</a>
				</div>
				<div id='navbar' class='navbar-collapse collapse'>
					<ul class='nav navbar-nav'>
					</ul>
				</div>
			</div>
		</nav>

		<div class='container'>

			<div class='row'>
				<h1 style = 'text-align:center;'>You have successfully logged out. Redirecting in 4 seconds...</h1>
                <div id = pacman style = 'position:absolute;'>
				    <img src='img/ajax-loader.gif' height='40' width='40'>
                </div>
			</div>

		</div>

		<!-- Fixed footer -->
		<nav class='navbar navbar-inverse navbar-fixed-bottom'>
		<div class='row'> </div>
			<div class='container'>
				<div class='navbar-footer'>
				</div>
			</div>
		</nav>
        

        


		<!-- Bootstrap core JavaScript -->
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
		<script src='js/bootstrap.min.js'></script>
	</body>
</html>";

?>
      