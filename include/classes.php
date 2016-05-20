<?php
header('Content-Type: text/html; charset=utf-8');

class user
{
    public $username = '';
    public $useremail = '';
    public $userpassword = '';
    public $registerdate = '';
    public $reg = '';
    public $login='';
    public $userid = 0;
    public $userhash = '';
    public $match = 0;
    public $loginfetch = '';
}

class shop
{
    public $shopname = '';
    public $shopaddress = '';
    public $shoptype = '';
    public $shopdiscount = 0;
    public $shopimage = '';
    public $shopanimation = '';
    
}
?>