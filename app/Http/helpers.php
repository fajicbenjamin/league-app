<?php

use Carbon\Carbon;

function getRegionHost($region) {
    $codes = [
        'br' =>	'br1',
        'eune' => 'eun1',
        'euw' => 'euw1',
        'jp' => 'jp1',
        'kr' => 'kr',
        'lan' => 'la1',
        'las' => 'la2',
        'na' => 'na1',
        'oce' => 'oc1',
        'tr' => 'tr1',
        'ru' => 'ru',
        'pbe' => 'pbe1'
    ];

    return $codes[$region];

//    return "https://{$codes[$region]}.api.riotgames.com";
}

function optionalUrlParams(array $params, array $options) {
    if ($options) {
        $paramsUrl = '?';

        collect($params)->each(function ($param) use ($options, &$paramsUrl) {
            isset($options[$param]) ? $paramsUrl .= "$param=" . $options[$param] . '&' : $paramsUrl .= '';
        });

        return rtrim($paramsUrl, '&');
    }

    return '';
}

function fromUnixTimestamp(string $timestamp, string $timezone = 'UTC') : Carbon {
    return Carbon::createFromTimestampMs($timestamp)->setTimezone($timezone);
}

function findItemByKey($filename, $itemId) {
    $data = file_get_contents($filename);

    return collect(json_decode($data)->data)->first(function ($item, $key) use ($itemId) {
        if (!isset($item->key))
            return $key == $itemId;
        return $item->key == $itemId;
    });
}

function findItemsByKey($filename, $items) {
    $data = file_get_contents($filename);

    return collect(json_decode($data)->data)->filter(function ($item, $key) use ($items) {
        if (!isset($item->key))
            return in_array($key, $items);
        return in_array($item->key, $items);
    });
}

function leagueMap($mapId) {
    $maps = [
        1 => "Summoner's Rift",
        2 => "Summoner's Rift",
        3 => "The Proving Grounds",
        4 => "Twisted Treeline",
        8 => "The Crystal Scar",
        10 => "Twisted Treeline",
        11 => "Summoner's Rift",
        12 => "Howling Abyss",
        14 => "Butcher's Bridge",
        16 => "Cosmic Ruins",
        18 => "Valoran City Park",
        19 => "Substructure 43",
        20 => "Crash Site",
        21 => "Nexus Blitz"
    ];

    return $maps[$mapId];
}

function leagueQueue($queueId) {
    $queues = [
        0 => (object) ['map' => 'Custom', 'description' => ''],
        72 => (object) ['map' => 'Howling Abyss', 'description' => '1v1 Snowdown Showdown'],
        73 => (object) ['map' => 'Howling Abyss', 'description' => '2v2 Snowdown Showdown'],
        75 => (object) ['map' => 'Summoner\'s Rift', 'description' => '6v6 Hexakill'],
        76 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Ultra Rapid Fire'],
        78 => (object) ['map' => 'Howling Abyss', 'description' => 'One For All: Mirror Mode'],
        83 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Co-op vs AI Ultra Rapid Fire'],
        98 => (object) ['map' => 'Twisted Treeline', 'description' => '6v6 Hexakill'],
        100 => (object) ['map' => 'Butcher\'s Bridge', 'description' => '5v5 ARAM'],
        310 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Nemesis'],
        313 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Black Market Brawlers'],
        317 => (object) ['map' => 'Crystal Scar', 'description' => 'Definitely Not Dominion'],
        325 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'All random'],
        400 => (object) ['map' => 'Summoner\'s Rift', 'description' => '5v5 Draft Pick'],
        420 => (object) ['map' => 'Summoner\'s Rift', 'description' => '5v5 Ranked Solo'],
        430 => (object) ['map' => 'Summoner\'s Rift', 'description' => '5v5 Blind Pick'],
        440 => (object) ['map' => 'Summoner\'s Rift', 'description' => '5v5 Ranked Flex'],
        450 => (object) ['map' => 'Howling Abyss', 'description' => '5v5 ARAM'],
        460 => (object) ['map' => 'Twisted Treeline', 'description' => '3v3 Ranked Flex'],
        470 => (object) ['map' => 'Twisted Treeline', 'description' => '3v3 Blind Pick'],
        600 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Blood Hunt Assassin'],
        610 => (object) ['map' => 'Cosmic Ruins', 'description' => 'Dark Star: Singularity'],
        700 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Clash'],
        800 => (object) ['map' => 'Twisted Treeline', 'description' => 'Co-op vs. AI Intermediate Bot'],
        810 => (object) ['map' => 'Twisted Treeline', 'description' => 'Co-op vs. AI Intro Bot'],
        820 => (object) ['map' => 'Twisted Treeline', 'description' => 'Co-op vs. AI Beginner Bot'],
        830 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Co-op vs. AI Intro Bot'],
        840 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Co-op vs. AI Beginner Bot'],
        850 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Co-op vs. AI Intermediate Bot'],
        900 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'ARURF'],
        910 => (object) ['map' => 'Crystal Scar', 'description' => 'Ascension'],
        920 => (object) ['map' => 'Howling Abyss', 'description' => 'Legend of the Poro King'],
        940 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Nexus Siege'],
        950 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Doom Bots Voting'],
        960 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Doom Bots Standard'],
        980 => (object) ['map' => 'Valoran City Park', 'description' => 'Star Guardian Invasion: Normal'],
        990 => (object) ['map' => 'Valoran City Park', 'description' => 'Star Guardian Invasion: Onslaught'],
        1000 => (object) ['map' => 'Overcharge', 'description' => 'PROJECT: Hunters'],
        1010 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'Snow ARURF'],
        1020 => (object) ['map' => 'Summoner\'s Rift', 'description' => 'One for All'],
        1030 => (object) ['map' => 'Crash Site', 'description' => 'Odyssey Extraction: Intro'],
        1040 => (object) ['map' => 'Crash Site', 'description' => 'Odyssey Extraction: Cadet'],
        1050 => (object) ['map' => 'Crash Site', 'description' => 'Odyssey Extraction: Crewmember'],
        1060 => (object) ['map' => 'Crash Site', 'description' => 'Odyssey Extraction: Captain'],
        1070 => (object) ['map' => 'Crash Site', 'description' => 'Odyssey Extraction: Onslaught'],
        1090 => (object) ['map' => 'Convergence', 'description' => 'Teamfight Tactics'],
        1100 => (object) ['map' => 'Convergence', 'description' => 'Ranked Teamfight Tactics']
    ];

    return $queues[$queueId];
}

function secondsToTimeString($seconds) {
    $timeString = '';

    if ($hours = floor($seconds / 3600))
        $timeString .= "{$hours}h ";
    if ($minutes = floor($seconds / 60 % 60))
        $timeString .= "{$minutes}m ";
    if ($seconds = floor($seconds % 60))
        $timeString .= "{$seconds}s ";

    return rtrim($timeString);
}

function lastDragonApiVersion() {
    return json_decode(file_get_contents(env('DRAGON_API_VERSIONS')))[0];
}

function getProfileIconUrl($profileIconId) {
    return env('PROFILE_ICON') . $profileIconId . '.png';
}

function getChampion($championId) {
//    dd(findItemByKeyFromLink(env('CHAMPIONS_API'), $championId));
    return findItemByKey(env('CHAMPIONS_API'), $championId);
}

function getChampions($championIds) {
    return findItemsByKey(env('CHAMPIONS_API'), $championIds);
}

function getChampionIcon($champion) {
    return  env('CHAMPION_ICON') . $champion->image->full;
}

function getSummonerSpell($spellId) {
    return findItemByKey(env('SPELLS_API'), $spellId);
}

function getSummonerSpellIcon($spell) {
    return env('SUMMONER_SPELL_ICON') . $spell->image->full;
}

function getItem($itemId) {
    return findItemByKey(env('ITEMS_API'), $itemId);
}

function getItemIcon($item) {
    return env('ITEM_ICON') . $item->image->full;
}
