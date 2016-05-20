<?php
header('Content-Type: text/html; charset=utf-8');

	

function confirm_query($result_set) {
	    global $connection;
		if (!$result_set) {
		    echo mysqli_error($connection)."<br>";
			die("Database query failed.");
		}
	}

function registration_query($USERNAME,$EMAIL,$PASSWORD,$DATE,$HASH){
    global $connection;
    
    $sql = "insert into users(username, useremail,userpassword,registrationDate,activateURL) values('$USERNAME','$EMAIL','$PASSWORD','$DATE','$HASH')";
    $add_newusers = mysqli_query($connection, $sql);
    confirm_query($add_newusers);
    return $add_newusers;
}

function login_query($EMAIL,$PASSWORD){
    global $connection;
    
    $sql = "select * from users where useremail = '$EMAIL' and userpassword = '$PASSWORD' and activation = 1";
    $login = mysqli_query($connection,$sql);
    confirm_query($login);
    return $login;
}

function userinfo_query($UID){
    global $connection;
    
    $sql = "select * from users where UID = $UID";
    $userinfo = mysqli_query($connection,$sql);
    confirm_query($userinfo);
    return $userinfo;
}

function userinfor_query_email($EMAIL){
    global $connection;
    
    $sql = "select * from users where useremail = '$EMAIL'";
    $userinfobymail = mysqli_query($connection,$sql);
    confirm_query($userinfobymail);
    return $userinfobymail;
}

function search_activation($EMAIL,$HASH){
    global $connection;
    
    $sql = "SELECT useremail, activateURL, activation FROM users WHERE useremail='$EMAIL' AND activateURL='$HASH' AND activation=0";
    $search = mysqli_query($connection,$sql);
    confirm_query($search);
    return $search;
}

function update_activation($EMAIL,$HASH){
    global $connection;
    
    $sql = "UPDATE users SET activation=1 WHERE useremail='$EMAIL' AND activateURL='$HASH' AND activation=0";
    $update = mysqli_query($connection,$sql);
    confirm_query($update);
    return $update;
}

function delete_user($EMAIL){
    global $connection;
    $sql = "delete from users where useremail='$EMAIL'";
    $delete = mysqli_query($connection,$sql);
    confirm_query($delete);
    return delete;
}

function display_homepage_shop(){
    global $connection;
    $sql = "select * from shops";
    $homepage_shop = mysqli_query($connection,$sql);
    confirm_query($homepage_shop);
    return $homepage_shop;
}

?>