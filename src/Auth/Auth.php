<?php

namespace Hsoderlind\Discogs\Auth;

use Hsoderlind\Discogs\Client\ClientFactory;

abstract class Auth
{
    public const REQUEST_TOKEN_URL = 'https://api.discogs.com/oauth/request_token';

    public const AUTHORIZE_URL = 'https://www.discogs.com/oauth/authorize';

    public const ACCESS_TOKEN_URL = 'https://api.discogs.com/oauth/access_token';

    /**
     * Request a aouth token.
     *
     * @param string $consumerKey
     * @param string $signature
     * @param string|null $callbackUrl
     * @return array
     */
    public static function requestToken(string $consumerKey, string $signature, ?string $callbackUrl = null): array
    {
        $client = ClientFactory::create([
            'oauth_consumer_key'    =>  $consumerKey,
            'oauth_signature'       =>  $signature,
            'oauth_callback'        =>  $callbackUrl
        ], 'application/x-www-form-urlencoded');

        $response = $client->get(self::REQUEST_TOKEN_URL);
        parse_str($response->getBody(), $result);

        return $result;
    }

    /**
     * Redirect to Discogs authorization page.
     *
     * @param string $token
     * @return void
     */
    public static function authorize(string $token): void
    {
        header('Location: ' . self::AUTHORIZE_URL . '?oauth_token=' . $token, true, 302);
    }

    /**
     * Verify the application authorization.
     *
     * @param string $consumerKey
     * @param string $signature
     * @param string $token
     * @param string $verifier
     * @return array
     */
    public static function accessToken(string $consumerKey, string $signature, string $token, string $verifier): array
    {
        $client = ClientFactory::create([
            'oauth_consumer_key'    =>  $consumerKey,
            'oauth_signature'       =>  $signature,
            'oauth_token'           =>  $token,
            'oauth_verifier'        =>  $verifier
        ], 'application/x-www-form-urlencoded');

        $response = $client->post(self::ACCESS_TOKEN_URL);
        parse_str($response->getBody(), $result);

        return $result;
    }
}
