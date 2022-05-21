<?php

use Hsoderlind\Discogs\Client\ClientFactory;

require(__DIR__ . '/bootstrap.php');
parse_str(str_replace('--', '', implode('&', array_splice($argv, 1))), $args);

use Hsoderlind\Discogs\Auth\Auth;

$consumerKey = 'KJkhZLFxqmqJMZATjHDR';
$consumerSecret = 'rVxYKbELOKwyVRmDNzTEPXvzfyPfiXpz';

if (!isset($args['verifier'])) {
	$signature = $consumerSecret . '&';
	$result = Auth::requestToken($consumerKey, $signature);
	print_r($result);
	echo PHP_EOL;

	$token = $result['oauth_token'];
	$tokenSecret = $result['oauth_token_secret'];

	echo 'Authorize at ' . Auth::AUTHORIZE_URL . '?oauth_token=' . $token . PHP_EOL;
	echo 'Then, run the command: php client.test.php --token=' . $token . ' --tokenSecret=' . $tokenSecret . ' --verifier=[code]' . PHP_EOL;
}

if (isset($args['verifier'])) {
	$signature = $consumerSecret . '&' . $args['tokenSecret'];
	$result = Auth::accessToken($consumerKey, $signature, $args['token'], $args['verifier']);
	print_r($result);
	echo PHP_EOL;

	$client = ClientFactory::create([
		'oauth_consumer_key' => $consumerKey,
		'oauth_signature' => $consumerSecret . '&' . $result['oauth_token_secret'],
		'oauth_token' => $result['oauth_token'],
	]);
	$identity = $client->useUser()->getIdentity();
	print_r($identity);
}

exit();
