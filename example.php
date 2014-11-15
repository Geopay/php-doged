<?php

## Simple command-line script to show examples

require "./Doged.php";

$config = array(
    'user' => 'dogecoindarkrpc',
    'pass' => 'rpcpassword',
    'host' => '127.0.0.1',
    'port' => '20102' );

// create client conncetion
$doged = new Doged( $config );


// create a new address
$address = $doged->get_address( 'mkaz' );
print( "Address: $address \n" );

// list accounts in wallet
print_r( $doged->list_accounts() );

// get balance in wallet
print( "mkaz: " . $doged->get_balance( 'mkaz' ) );

// move money from accounts in wallet
// moves from 'thianh' to account 'mkaz'
$doged->move( 'thianh', 'mkaz', 10000 );

// send money externally (withdrawl?)
// send from account to external address
$doged->send( 'mkaz', 'DNYJ2ANdx1GL4sbCyikaVgYrf2GfiCtf8N', 100 );


