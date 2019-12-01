<?php


namespace App\Http;


use GuzzleHttp\Client;

class RiotApi
{
    protected static $api;

    /**
     * Initialize url for Riot API, due to given region
     *
     * @param string $region
     */
    public static function initialize(string $region) {
        self::$api = "https://{$region}.api.riotgames.com";
    }

    /**
     * @param string $summonerName
     * @return mixed
     */
    public static function summonerByName(string $summonerName) {
        $url = self::$api . "/lol/summoner/v4/summoners/by-name/$summonerName";

        return self::executeRequest($url);
    }

    /**
     * @param string $encryptedSummonerId
     * @return mixed
     */
    public static function leagueBySummoner(string $encryptedSummonerId) {
        $url = self::$api . "/lol/league/v4/entries/by-summoner/$encryptedSummonerId";

        return self::executeRequest($url);
    }

    /**
     * @param string $accountId
     * @param array $options
     * @return mixed
     */
    public static function matchListByAccountId(string $accountId, $options = []) {
        $params = ['champion', 'queue', 'season', 'endTime', 'beginTime', 'endIndex', 'beginIndex'];

        $url = self::$api . "/lol/match/v4/matchlists/by-account/$accountId" . optionalUrlParams($params, $options);

        return self::executeRequest($url);
    }

    /**
     * @param string $matchId
     * @return mixed
     */
    public static function match(string $matchId) {
        $url = self::$api . "/lol/match/v4/matches/$matchId";

        return self::executeRequest($url);
    }

    /**
     * Execute HTTP request to RIOT api, given the url
     * with all the necessary parameters preprocessed
     *
     * @param string $url
     * @return mixed
     */
    private static function executeRequest(string $url) {
        $client = new Client();

        $response = $client->get($url, [
            'headers' => [
//                'Accept-Charset' => 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-Riot-Token' => env('RIOT_API_KEY')
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}