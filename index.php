<?php

require './db-config.php';

session_start();

if( isset( $_SESSION['uid'] ) )
{
    header('Location: ./profile.php');
}
else
{
    header('Location: ./login.php');
}
