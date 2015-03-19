<nav class='navbar navbar-inverse navbar-fixed-top'>
	<div class='container'>
		<div class='navbar-header'>
			<a class='navbar-brand' href='index.php'>Peer Review</a>
		</div>
		<div id='navbar' class='navbar-collapse collapse'>
			<ul class='nav navbar-nav'>
				<?php
					if (!isset($_SESSION)||empty($_SESSION['user_id'])){
					}else{
				?>
					<li><a href='dashboard.php'>Dashboard</a></li>
					<li><a href='viewreport.php'>Reports</a></li>
					<?php
						if (($_SESSION['admin'])==0){
						}else{
					?>
							<li><a href='admin.php'>Admin page</a></li>
					<?php
						}
					?>
					<li><a href='forum.php'>Forum</a></li>
					<li><a href='reportrankings.php'>Report Rankings</a></li>
					<li><a href='assessormarks.php'>Marks</a></li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
</nav>

<div class='container'>
