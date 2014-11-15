
# php-doged

A basic PHP library to talk to a dogecoindarkd daemon to get you started in your doged project to take us to the dark side of the moon.

All of the end points of the API are not implemented, it is currently focused on account and moving of coins. I'm trying to make sure the library is documented and includes examples so its easy to use before being complete.  Patches welcome.


## Requirements

Requires **dogecoindarkd** to already be installed and running on your local server or reachable by your server.  

Get dogecoindarkd source from: https://github.com/doged/dogedsource

compiling the coin is as easy as going into the dogedsource/src directory and typing:
git clone https://github.com/doged/dogedsource
cd dogedsource
cd src
make -f makefile.unix

## Usage:

Example use, see examples.php for more

```
require "./Doged.php";

$config = array(
    'user' => 'dogecoindarkrpc',
    'pass' => 'rpcpassword',
    'host' => '127.0.0.1',
    'port' => '22555' );

// create client conncetion
$doge = new Doged( $config );

// create a new address
$address = $doged->get_address( 'mkaz' );
print( $address );

// check balance 
print( "mkaz: " . $doged->get_balance( 'mkaz' ) );

// send money externally (withdrawl?)
$doge->send( 'mkaz', 'DQpwDDrW8gqJJWiW7TvXgNtbfD5Du94wy3', 100 );

```


## About

Forked from library created by Marcus Kazmierczak, http://mkaz.com/


