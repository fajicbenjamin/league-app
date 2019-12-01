<?php


namespace App\Http\Controllers;


use App\Http\RiotApi;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class LeagueController extends Controller
{
    protected $client;
    protected $api;
    protected $dataDragon;

    protected $region;

    public function profile(string $region, string $summonerName) {
        RiotApi::initialize(getRegionHost($region));

        $summoner = RiotApi::summonerByName($summonerName);

        $summoner->revisionDate = fromUnixTimestamp($summoner->revisionDate)->diffForHumans();
        $summoner->profileIcon = getProfileIconUrl($summoner->profileIconId);

        $summoner->league = RiotApi::leagueBySummoner($summoner->id);

        $matches = $this->getMatchList($summoner);

        return view('summoner.profile', compact('summoner', 'matches'));

    }

    private function getMatchList($summoner) {

        //$matches = Cache::get($summoner->name);
        $matches = null;

        if (!$matches) {
            $matchList = RiotApi::matchListByAccountId($summoner->accountId, [
                    'endIndex' => 10
                ]);

            $matches = collect($matchList->matches)
                ->map(function ($match) {
                    return [
                        'gameId' => $match->gameId,
                        'champion' => getChampionIcon(getChampion($match->champion)),
                        'queue' => leagueQueue($match->queue),
                        'time' => fromUnixTimestamp($match->timestamp)->diffForHumans()
                    ];
                })->toArray();

            //Cache::put($summoner->name, $matches, Carbon::now()->addMinutes(60));
        }

        return $matches;
    }

    private function game($match, $summoner) {

        $players = collect($match->participantIdentities)->mapWithKeys(function ($identity) use ($summoner, &$player) {
            if ($identity->player->summonerName == $summoner->name) {
                $player = $identity;
            }

            return [$identity->participantId => $identity->player->summonerName];
        });

        $playerIcons = collect([]);

        $matchStats = collect($match->participants)->filter(function ($participant) use ($player, &$playerIcons) {
            $playerIcons->add($participant);
            return $participant->participantId == $player->participantId;
        })->first();


        $championsIcons = collect(getChampions($playerIcons->pluck('championId')->toArray()))->mapWithKeys(function ($champion) {
            return [$champion->key => getChampionIcon($champion)];
        });

        $playerIcons = $playerIcons->mapWithKeys(function ($playerIcon) {
            return [$playerIcon->participantId => $playerIcon->championId];
        });

        $players = $players->mapWithKeys(function ($player, $key) use ($playerIcons, $championsIcons, $summoner, $matchStats) {
            if ($player == $summoner->name) {
                $matchStats->championIcon = $championsIcons[$playerIcons[$key]];
            }

            return [$player => $championsIcons[$playerIcons[$key]]];
        })->toArray();

        $spells = collect([$matchStats->spell1Id, $matchStats->spell2Id])
            ->map(function ($spell) {
                $spellMapped = getSummonerSpell($spell);
                if ($spellMapped) {
                    $spellMapped->icon = getSummonerSpellIcon($spellMapped);
                }

                return $spellMapped;
            });

        $items = collect([
            $matchStats->stats->item0,
            $matchStats->stats->item1,
            $matchStats->stats->item2,
            $matchStats->stats->item3,
            $matchStats->stats->item4,
            $matchStats->stats->item5,
            $matchStats->stats->item6
        ])->map(function ($item) {
                $itemMapped = getItem($item);
                if ($itemMapped) {
                    $itemMapped->icon = getItemIcon($itemMapped);
                }

                return $itemMapped;
            });

        $matchStats->spells = $spells->toArray();
        $matchStats->items = $items->toArray();
        $matchStats->blueTeam = array_slice($players, 0, 5);
        $matchStats->redTeam = array_slice($players, 5);
        $matchStats->queue = leagueQueue($match->queueId);
        $matchStats->gameCreation = fromUnixTimestamp($match->gameCreation)->diffForHumans();
        $matchStats->gameDurationInSeconds = $match->gameDuration;
        $matchStats->gameDuration = secondsToTimeString($match->gameDuration);

        return $matchStats;
    }

    public function match(string $region, string $summonerName, string $gameId) {
        RiotApi::initialize(getRegionHost($region));

        $match = RiotApi::match($gameId);

        dd($this->game($match, RiotApi::summonerByName($summonerName)));
    }
}