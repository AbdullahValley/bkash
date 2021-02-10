<?php

include('BkashHelper.php');

$bkash_helper = new BkashHelper();

$action = $_GET['action'];

echo $bkash_helper->$action();
