<?php

namespace Hsoderlind\Discogs\Client;

use Hsoderlind\Discogs\Client\Client;

abstract class ClientFactory
{
	/**
	 * The user agent added to request headers
	 */
	public const USER_AGENT = 'hs-discogs-api-php/1.0.0 +https://github.com/hsoderlind/discogs-api-php';

	/**
	 * The base URL to Discogs API
	 */
	public const BASE_URL = 'https://api.discogs.com';

	/**
	 * Create a new instance of Hsoderlind\Discogs\Client\Client with Oauth1 authorization.
	 * 
	 * $config should only contain the follow params:
	 * - oauth_consumer_key: (required) the consumer key provided by your Discogs application settings
	 * - oauth_nonce: (required) a random string
	 * - oauth_signature: (required) should contain the consumer secret provided by your Discogs application settings followed by a & character.
	 * - oauth_callback: (required when requesting endpoint https://api.discogs.com/oauth/request_token) should contain an URL to your site where we are redirected upon a successfull request.
	 * - oauth_token: (required on all requests that requires OAuth authorization) should contain the token provided by the response from https://api.discogs.com/oauth/request_token.
	 * - oauth_token_secret (required on all requests that requires OAuth authorization) should contain the token secret provided by the response from https://api.discogs.com/oauth/access_token.
	 * - oauth_verifier (required when requesting endpoint https://api.discogs.com/oauth/access_token) should contain the verifier provided by the response from https://discogs.com/oauth/authorize.
	 *
	 * @param array $config
	 * @param string $contentType
	 * @param string $userAgent
	 * @return Client
	 */
	public static function create(array $config, string $contentType = 'application/json', string $userAgent = self::USER_AGENT): Client
	{
		$params = [
			'oauth_nonce'               =>      (string)(time() + rand()),
			'oauth_signature_method'    =>      'PLAINTEXT',
			'oauth_timestamp'           =>      time()
		];

		$requiredParams = ['oauth_consumer_key', 'oauth_signature'];

		for ($i = 0; $i < count($requiredParams); $i++) {
			$key = $requiredParams[$i];
			$params[$key] = $config[$key];
		}

		$optionalParams = ['oauth_nonce', 'oauth_callback', 'oauth_token', 'oauth_token_secret', 'oauth_verifier'];

		for ($i = 0; $i < count($optionalParams); $i++) {
			$key = $optionalParams[$i];
			if (isset($config[$key])) {
				$params[$key] = $config[$key];
			}
		}

		$authorizationParams = [];
		foreach ($params as $key => $value) {
			$authorizationParams[] = $key . '="' . $value . '"';
		}

		$authStr = 'OAuth ' . implode(', ', $authorizationParams);

		$headers = [
			'Authorization' =>  $authStr,
			'User-Agent'    =>  $userAgent,
			'Content-Type'  =>  $contentType ?? 'application/json'
		];

		$client = new Client([
			'base_uri' => self::BASE_URL,
			'headers' => $headers
		]);

		return $client;
	}
}
