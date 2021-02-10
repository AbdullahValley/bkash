<?php
session_start();
require('BkashHelper.php');

$bkash_helper = new BkashHelper();

$final_amount = $_SESSION['final_amount'];
$api_response = json_decode($_GET['response'], true);  // Getting Response from bKash API.
$transaction_trxId = $api_response['trxID']; // bKash trxId.


// IF CONDITION Transaction Duplicate THEN YOU CAN DIE Here
if ('Noman' == 'failed') {
    echo "This Transaction ID is Already Used and Please Use Correct Transaction ID.";
    die();
}

// Assign Transaction Information
$transaction_amount = $api_response['amount'];                    // bKash Payment Amount.
$transaction_reference = $api_response['merchantInvoiceNumber'];  // bKash Reference for Invoice ID.

$transaction_sender = null;
$count = 0; // transaction search count

while (!$transaction_sender) {
    $search_trxId_res = $bkash_helper->searchTransaction($transaction_trxId); // search transaction to get sender
    $search_trxId_res = json_decode($search_trxId_res, true);

    $transaction_sender = ltrim($search_trxId_res['customerMsisdn'], '88'); // bKash Sender.

    if ($count === 100) {
        $transaction_sender = 'not found';
    }
}

// DB :: INSERT Transaction information
