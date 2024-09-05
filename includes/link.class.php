<?php require_once('config.inc.php'); ?>
<?php
class Utils{
		
	function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name 
    $secure = SECURE;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // Sets the session name to the one set above.
    session_name($session_name);

    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
	}

	function login($user, $password) {
	    
		for($i=0;$i<count(USUARIOS);$i++){
			if(USUARIOS[$i][1]==$user)
				$arr=USUARIOS[$i];
		}
		
        if (isset($arr)) {
            
			// Check if the password in the database matches 
			// the password the user submitted.
			if ($arr[2] == $password) {
				// Password is correct!
				// Get the user-agent string of the user.
				$user_browser = $_SERVER['HTTP_USER_AGENT'];

				// XSS protection as we might print this value
				$user_id = preg_replace("/[^0-9]+/", "", $arr[0]);
				$_SESSION['user_id'] = $user_id;

				// XSS protection as we might print this value
				$username = preg_replace("/[^a-zA-Z0-9_\-]+/", " ", $arr[1]);
				$nombre = preg_replace("/[^a-zA-Z0-9_\-]+/", " ", $arr[3]);

				$_SESSION['username'] = $username;
				$_SESSION['nombre'] = $nombre;
				$_SESSION['login_string'] = hash('sha512', $password . $user_browser);

				// Login successful. 
				return true;
			} 
            
        } else {
            // No user exists. 
            return false;
        }
    
	}
		
	function login_check() {
		if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['user_id'];
			$username = $_SESSION['username'];
			$login_string = $_SESSION['login_string'];

			// Get the user-agent string of the user.
			$user_browser = $_SERVER['HTTP_USER_AGENT'];

			for($i=0;$i<count(USUARIOS);$i++){
				if(USUARIOS[$i][1]==$username)
					$arr=USUARIOS[$i];
			}
			
			if (isset($arr)) {
				// If the user exists get variables from result.
				$login_check = hash('sha512', $arr[2] . $user_browser);

				if ($login_check == $login_string) {
					// Logged In!!!! 
					return true;
				} else {
					// Not logged in 
					return false;
				}
			} else {
				// Not logged in 
				return false;
			}
			
		} else {
			// Not logged in 
			return false;
		}
	}	
		
	
}
?>