<?php
// forum.php ----------------------------------------
	function posts(){
		$query  = "SELECT * ";
        $query .= "FROM forum ";
        $query .= "ORDER BY post_id DESC ";
        return $query;
	}

// add_post.php ----------------------------------------
    function create_post($Title,$Content){
        $query  = "INSERT INTO forum (post_id, post_title, post_content, post_date) ";
        $query .= "VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP)";
        return $query;
    }

// add_comment.php ----------------------------------------
    function create_comment($Title,$Content,$Post){
        $query  = "INSERT INTO forum_comments (comment_id, comment_title, comment_content, comment_date, post_id) ";
        $query .= "VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP, '{$Post}')";
        return $query;
    }

// view_forum_comments.php ----------------------------------------
    function comments($Post_ID){
        $query  = "SELECT * ";
        $query .= "FROM forum_comments ";
        $query .= "WHERE post_id = {$Post_ID} ";
        $query .= "ORDER BY post_id DESC ";
        return $query;
    }
?>