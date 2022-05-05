<?php


namespace App\Service\Google;


use Google\Exception;
use Google_Client;
use Google_Service_Sheets;

class GoogleClient
{
    /**
     * @var string
     */
    private string $tokenPath;


    /**
     * GoogleClient constructor.
     * @param string $tokenPath
     */
    public function __construct(string $tokenPath)
    {
        $this->tokenPath = $tokenPath;
    }

    /**
     * @return Google_Client
     * @throws Exception
     */
    public function getClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $this->setAccessToken($client);

        // If there is no previous token or it's expired.
        $this->refreshAccessToken($client);
        $this->saveAccessToken($client);

        return $client;
    }

    /**
     * @param Google_Client $client
     */
    private function setAccessToken(Google_Client &$client)
    {
        if (!file_exists($this->tokenPath)) {
            return;
        }

        $accessToken = json_decode(file_get_contents($this->tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    /**
     * @param Google_Client $client
     * @throws Exception
     */
    private function refreshAccessToken(Google_Client &$client)
    {
        if (!$client->isAccessTokenExpired()) {
            return;
        }

        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
    }

    /**
     * @param Google_Client $client
     */
    private function saveAccessToken(Google_Client &$client)
    {
        if (!file_exists(dirname($this->tokenPath))) {
            mkdir(dirname($this->tokenPath), 0700, true);
        }

        file_put_contents($this->tokenPath, json_encode($client->getAccessToken()));
    }

}