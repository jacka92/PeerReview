<?php
// forum.php ----------------------------------------
	function posts(){
		$query  = "SELECT * ";
        $query .= "FROM forum ";
        $query .= "ORDER BY post_id DESC ";
        return $query;
	}
    function poster_name($User){
        $query  = "SELECT login ";
        $query .= "FROM users ";
        $query .= "WHERE user_id = {$User} ";
        return $query;
    }
    function search_users(){
        $query  = "SELECT users.login ";
        $query .= "FROM users,forum ";
        $query .= "WHERE users.user_id = forum.user_id ";
        return $query;
    }
    function search_threads(){
        $query  = "SELECT post_title ";
        $query .= "FROM forum ";
        return $query;
    }

// add_post.php ----------------------------------------
    function create_post($Title,$Content){
        $query  = "INSERT INTO forum (post_id, post_title, post_content, post_date, user_id) ";
        $query .= "VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP, {$_SESSION['user_id']})";
        return $query;
    }

// add_comment.php ----------------------------------------
    function create_comment($Title,$Content,$Post){
        $query  = "INSERT INTO forum_comments (comment_id, comment_title, comment_content, comment_date, post_id, user_id) ";
        $query .= "VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP, '{$Post}', {$_SESSION['user_id']})";
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

// search_user.php ----------------------------------------
    function get_user_id($User){
        $query  = "SELECT user_id ";
        $query .= "FROM users ";
        $query .= "WHERE login = '{$User}' ";
        return $query;
    }
    function user_threads($User){
        $query  = "SELECT post_title ";
        $query .= "FROM forum ";
        $query .= "WHERE user_id = {$User} ";
        return $query;
    }
    function get_post_id($User){
        $query  = "SELECT post_id ";
        $query .= "FROM forum ";
        $query .= "WHERE user_id = {$User} ";
        return $query;
    }

// search_thread.php ----------------------------------------
    function get_thread_id($Post){
        $query  = "SELECT post_id ";
        $query .= "FROM forum ";
        $query .= "WHERE post_title = '{$Post}' ";
        return $query;
    }
?>