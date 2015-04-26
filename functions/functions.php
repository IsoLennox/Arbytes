<?php ob_start();

function redirect_to($new_location) {
    header("Location: " . $new_location);
	  exit; }

function logged_in(){
    return isset($_SESSION['user_id']);
}

function attempt_login($username, $password) {
		$user = find_user_by_username($username);
		if ($user) {
			// found user, now check password
			//if (password_check($password, $user["hashed_password"])) {
            if (password_verify($password, $user["password"])){
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}



function check_password($user_id, $password) {
		$user = find_user_by_id($user_id);
		if ($user) {
			// found user, now check password
			//if (password_check($password, $user["hashed_password"])) {
            if (password_verify($password, $user["password"])){
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}


 
function find_user_by_username($username) {
    global $connection;

    $safe_username = mysqli_real_escape_string($connection, $username);

    $query  = "SELECT * ";
    $query .= "FROM members ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}



function confirm_logged_in(){
    if (!logged_in()){
        redirect_to("login.php");
    }
}	



function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
function find_all_status_posts() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM status_posts ";
		$query .= "ORDER BY post_id DESC";
		$all_posts = mysqli_query($connection, $query);
		confirm_query($all_posts);
		return $all_posts;
    
	}

function find_user_status_posts($user_id) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM status_posts ";
		$query .= "WHERE user_id={$user_id} ";
		$query .= "ORDER BY post_id DESC";
		$all_posts = mysqli_query($connection, $query);
		confirm_query($all_posts);
		return $all_posts;
    
	}

function get_logged_in_user_profile(){
    global $connection;
//use to see if currently logged in user has profile
        $query = "SELECT * FROM profile WHERE user_id = {$_SESSION["user_id"]}";
        $result = mysqli_query($connection, $query);
//$result_array=mysqli_fetch_assoc($result);
        confirm_query($result);
		return $result;

}


function get_logged_in_member_group(){
    global $connection;
      $query1 = "SELECT * FROM members WHERE id = {$_SESSION["user_id"]}";
        $result = mysqli_query($connection, $query1);
    
    $array= mysqli_fetch_assoc($group_found);
    $group_id=$array['group_id']; 
        confirm_query($result);
		return $result;
    
    $query2 = "SELECT * FROM groups WHERE id = {$group_id}";
        $result2 = mysqli_query($connection, $query1); 
    
    $array= mysqli_fetch_assoc($group_found);
    $group_name=$array['group_name']; 
        confirm_query($result2);
		return $result2;

}

 function find_your_contacts(){
     global $connection;
    $query = "SELECT * FROM contacts WHERE contacts_with_id = {$_SESSION["user_id"]}";
    $result = mysqli_query($connection, $query);
   // $contacts_array=mysqli_fetch_assoc($result);
    confirm_query($result);
    return $result;
}

 function find_following_you(){
     global $connection;
    $query = "SELECT * FROM contacts WHERE contact_id = {$_SESSION["user_id"]}";
    $result = mysqli_query($connection, $query);
   // $contacts_array=mysqli_fetch_assoc($result);
    confirm_query($result);
    return $result;
}

function see_if_user_is_your_contact($contact_id){
    global $connection;
    $query = "SELECT * FROM contacts WHERE contact_id ={$contact_id} AND  contacts_with_id = {$_SESSION["user_id"]} LIMIT 1";
    
    $result = mysqli_query($connection, $query);
   // $contacts_array=mysqli_fetch_assoc($result);
    confirm_query($result);
    return $result;

}

function find_posts_for_user($user_id) {
		global $connection;
    
		
		$safe_user_id = mysqli_real_escape_string($connection, $user_id);
		
		$query  = "SELECT * ";
		$query .= "FROM status_posts ";
		$query .= "WHERE user_id = {$safe_user_id} ";
		$query .= "ORDER BY position ASC";
		$post_set = mysqli_query($connection, $query);
		confirm_query($post_set);
		return $post_set;
	}

function find_all_members() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "ORDER BY username ASC";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		return $user_set;
	}

function find_user_profile(){
    
    global $connection;
    
    //get global user_id from $_GET request within file using function
    global $user_id;
    $query = "SELECT * FROM profile WHERE user_id = {$user_id}";
    $result = mysqli_query($connection, $query);
    //$result_array=mysqli_fetch_assoc($result);
     confirm_query($result);
    return $result;
}

function get_user_gallery($contact_id){
    global $connection;
    $query = "SELECT * FROM gallery WHERE user_id = {$contact_id} ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    return $result;

}

function get_photo_from_gallery($image_id){
    global $connection;
    $query = "SELECT * FROM gallery WHERE id = {$image_id} ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    return $result;

}


function get_pi_from_gallery($user_id){
    global $connection;
    $query = "SELECT * FROM gallery WHERE user_id = {$user_id} AND pi=1 ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    return $result;

}

function find_post_by_id($post_id) {
    global $connection;

    $safe_post_id = mysqli_real_escape_string($connection, $post_id);

    $query  = "SELECT * ";
    $query .= "FROM status_posts ";
    $query .= "WHERE post_id = {$safe_post_id} ";
    $query .= "LIMIT 1";
    $post_set = mysqli_query($connection, $query);
    confirm_query($post_set);
    if($post = mysqli_fetch_assoc($post_set)) {
        return $post;
    } else {
        return null;
    }
}

function find_user_by_id($user_id) {
    global $connection;

    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT * ";
    $query .= "FROM members ";
    $query .= "WHERE id = {$safe_user_id} ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}



function find_user_by_email($email) {
    global $connection;

    $safe_email = mysqli_real_escape_string($connection, $email);

    $query  = "SELECT * ";
    $query .= "FROM members ";
    $query .= "WHERE email = '{$safe_email}' ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
    if($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}


function find_selected_page($public=false) {
    global $current_subject;
    global $current_page;

    if (isset($_GET["subject"])) {
        $current_subject = find_subject_by_id($_GET["subject"], $public);
        if ($current_subject && $public) {
            $current_page = find_default_page_for_subject($current_subject["id"]);
        } else {
            $current_page = null;
        }
    } elseif (isset($_GET["page"])) {
        $current_subject = null;
        $current_page = find_page_by_id($_GET["page"], $public);
    } else {
        $current_subject = null;
        $current_page = null;
    }
}

 
	
?>