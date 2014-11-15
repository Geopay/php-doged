<?php

/**
 * Project : php-doged library
 * Summary : A basic php library to talk with dogecoindarkd 
 *
 * Source  : forked from https://github.com/mkaz/php-doge
 *
 * Author  : Marcus Kazmierczak (@mkaz)
 * License : GPL vv
 */ 

require_once dirname(  __FILE__ ) . '/jsonRPCClient.php';

class Doged  {

    private $client;

    /** 
     * Create client to conncet on init
     * @param $config array of parameters $host, $port, $user, $pass
     */

    function __construct( $config ) {
        
        $connect_string = sprintf( 'http://%s:%s@%s:%s/', 
            $config['user'],
            $config['pass'],
            $config['host'],
            $config['port'] );

        // internal client to use for connection
        $this->client = new jsonRPCClient( $connect_string );
    }


    /**
     * Creates or Retrieves a DogecoinDark address for a account name
     * An account is just a string used as key to identify account,
     * A DogecoinDark address is returned which can receive coins
     *
     * @param string $account some string used as key to account
     * @return string dogecoin address 
     */
    function get_address( $account ) {
        return $this->client->getaccountaddress( $account );
    }


    /**
     * Given a DogecoinDark address returns the account name
     *
     * @param string $address dogecoin addresss
     * @return string account name key
     */
    function get_account( $address ) {
        return $this->client->getaccount( $address );
    }


    /**
     * Create new address for account, recommended to include
     * account name for further API use.
     *
     * @param string $account account name
     * @return string dogecoindark address
     */
    function get_new_address( $account='' ) {
        return $this->client->getnewaddress( $account );
    }


    /**
     * Get list of all accounts on in this dogecoindarkd wallet
     *
     * @return array strings of account => balance
     */
    function list_accounts() {
        return $this->client->listaccounts();
    }

    /**
     * Get the details of a transaction
     *
     * @param string $txid transaction id
     * @return array describing the transaction
     */
    function get_transaction( $txid ) {
        return $this->client->gettransaction( $txid );
    }

    /**
     * Associate dogecoindark address to account string
     *
     * @param string $address dogecoin address
     * @param string $account account string
     */
    function set_account( $address, $account ) {
        return $this->client->setaccount($address, $account);
    }


    /**
     * Get balance for given account
     *
     * @param string $account account name
     * @return float account balance
     */
    function get_balance( $account, $minconf=1 ) {
        return $this->client->getbalance( $account, $minconf );
    }


    /**
     * Move coins from one account on wallet to another
     * Both accounts are local to this dogecoindarkd instance
     *
     * @param string $account_from account moving from
     * @param string $account_to account moving to
     * @param float $amount amount of coins to move
     * @return
     */
    function move( $account_from, $account_to, $amount ) {
        return $this->client->move( $account_from, $account_to, $amount );
    }


    /**
     * Send coins to any Dogecoindark Address
     *
     * @param string $account account sending coins from
     * @param string $to_address dogecoindark address sending to
     * @param float $amount amount of coins to send
     * @return string txid
     */
    function send( $account, $to_address, $amount ) {
        $txid = $this->client->sendfrom( $account, $to_address, $amount );  
        return $txid;
    }

	/**
	 * Validate a given Dogecoindark Address
	 * @param string $address to validate
	 * @return array with the properties of the address
	 */
	function validate_address( $address ) {
		return $this->client->validateaddress($address);
	}
}

