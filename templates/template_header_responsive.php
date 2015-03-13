<?php
	function page_header() {
		global $connection;

		$html_string = "

		<!-- Fixed navbar -->
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container'>
				<div class='navbar-header'>
					<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a class='navbar-brand' href='index.php'>Peer Review</a>
				</div>
				<div id='navbar' class='navbar-collapse collapse'>
					<ul class='nav navbar-nav'>";
					
						$query  = "SELECT * ";
						$query .= "FROM pages ";
						$query .= "ORDER BY page_id";
						$query_result = mysqli_query($connection, $query);
						confirm_query($query_result);

						while($page = mysqli_fetch_assoc($query_result)) {
							$html_string .= '
							<li ';/*
							if () {
								$html_string .= 'class="active"'
							}*/
							$html_string .= '>
								<a href="' . $page["page_name"] . '">' . $page["page_title"] . '</a>
							</li>';
						}
						mysqli_free_result($query_result);
						$html_string .= "
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Dropdown <span class='caret'></span></a>
							<ul class='dropdown-menu' role='menu'>
								<li><a href='#'>Action</a></li>
								<li><a href='#'>Another action</a></li>
								<li><a href='#'>Something else here</a></li>
								<li class='divider'></li>
								<li class='dropdown-header'>Nav header</li>
								<li><a href='#'>Separated link</a></li>
								<li><a href='#'>One more separated link</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Body text formatting -->
		<div class='container'>
		";

		return $html_string;
	}
?>

