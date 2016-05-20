<?php
header('Content-Type: text/html; charset=utf-8');
include "include/connection.php";
include "include/functions.php";
include "include/classes.php";
require_once "Mail.php";
session_start();



 if(isset($_POST['inputName'])){
     
    $register = new user();
                                              
    $register->username = $_POST['inputName'];
    $register->useremail= $_POST['theemail'];
    $register->userpassword = md5($_POST['thepassword']);
    $register->registerdate = date("Y-m-d");
    $register->validdate = date('Y-m-d',strtotime("+365 day"));
    $register->userhash = md5( rand(0,1000) );
    
     
    
    $chars = "0123456789";
    $register->cardnumber = "";
    for($g = 0; $g<2;$g++){
                                    
    if(isset($i) == 5)
    $register->cardnumber.="-";
                                        
    for ($i = 0; $i < 5; $i++) {
        $register->cardnumber.= $chars[mt_rand(0, strlen($chars)-1)];
                                    
        }
    }
     
     
     
    
    $register->reg = registration_query($register->username,$register->useremail,$register->userpassword,$register->registerdate,$register->userhash,$register->cardnumber,$register->validdate);
     
     
     
    //if regsiter succssefully, then system generate an email and send to the new user
     
    if($register->reg){
        
          $from = "youngyaa@youngyaa.com.au";
          $to = $register->useremail; // Send email to our user
          $subject = 'Signup | Verification'; // Give the email a subject 
          $host = "ssl://smtp.zoho.com";
          $port = "465";
          $senderusername = "youngyaa@youngyaa.com.au";
          $senderpassword = "youngyaa123";
          $headers = array ('From' => $from,'To'=> $to,'Subject' =>$subject);
        
          $message = '
 
          Hi,'.$register->username.'! 非常感谢注册云涯!
         
          您的会员账号已经创建成！在账号成功激活后，您可以使用以下信息随时进行登陆操作。
 
          ------------------------
          登陆邮箱: '.$register->useremail.'
          登陆密码: '.$_POST['thepassword'].'
          ------------------------
 
          请点击此链接来激活您的云涯账号：
          http://www.youngyaa.com.au/index.html?email='.$register->useremail.'&hash='.$register->userhash.'
 
          ';
        
          $smtp = Mail::factory('smtp',
          array ('host' => $host,
          'port' => $port,
          'auth' => true,
          'username' => $senderusername,
          'password' => $senderpassword));
          $mail = $smtp->send($to, $headers, $message);
        
          if (PEAR::isError($mail)) {
              
              $register->reg = delete_user($register->useremail);
              echo 0;
          }
          else{
              echo 1;
          }
    }
        
    
     
    mysqli_close($connection);
 }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])){

    $register = new user();
    
    $register->username = $_POST['loginEmail'];
    $register->userpassword = md5($_POST['loginPassword']);
    $register->login = login_query($register->username,$register->userpassword);
    $row = mysqli_fetch_assoc($register->login);
    
   
    if(mysqli_num_rows($register->login) == 1){
        
        $_SESSION['login_user'] = "YES";
        $_SESSION['username'] = $row['username'];
        $_SESSION['userid'] = $row['UID'];
        $_SESSION['planlevel'] = $row['planlevel'];
        $_SESSION['useremail'] = $row['useremail'];
        $_SESSION['userpassword'] = $row['userpassword'];
        $_SESSION['rewards'] = $row['rewards'];
        $_SESSION['number'] = $row['cardnumber'];
        $_SESSION['valid'] = $row['validdate'];
            
        
        //redirect the URL 
        header('Location:index.html?login=YES');
      
    }
    else{
        //$_GET['login'] = 'NO';
        $_SESSION['login_user'] = "NO";
        //echo $_SESSION['login_user'];
         header('Location:index.html?login=NO');
    }
    
    mysqli_close($connection);
    
     
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['aaEmail'])){
    
$myemail = $_POST['aaEmail'];
//$succ = array();
 
//send a request to the database
$sql = "SELECT useremail FROM users WHERE useremail = '$myemail'";
$result = mysqli_query($connection,$sql);
 
if(mysqli_num_rows($result) > 0) {
    //email is already taken
    //$succ['isTaken'] = "0";
    //echo json_encode($succ);
    echo 0;
}
else {
    //email is available
    //$succ['isTaken'] = "1";
    //echo json_encode($succ);
    echo 1;
}

}

?>