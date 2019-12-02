<template>
    <div>
        <vs-row>
            <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" vs-xs="12">
                <vs-card class="cardx text-center profile-card">
                    <div slot="header">
                        <h3>
                            {{ summoner.name }}
                        </h3>
                    </div>
                    <div slot="media">
                        <vs-avatar size="70px" :src="summoner.profileIcon"/>
                    </div>
                    <div>
                        <h5>Level: {{ summoner.summonerLevel }}</h5>
                        <p>Last active: {{ summoner.revisionDate }}</p>

                        <vs-divider>
                            League
                        </vs-divider>
                        <h5>{{ summoner.league[0].tier + ' ' + summoner.league[0].rank }}</h5>
                        <p>LP: {{ summoner.league[0].leaguePoints }}</p>
                        <img class="ranked-emblem" :src="`/images/${summoner.league[0].tier}.png`" alt="">
                        <p>W {{ summoner.league[0].wins }} L {{summoner.league[0].losses }}</p>
                    </div>
                    <div slot="footer">
                        <vs-row vs-justify="flex-end">
                            <vs-button type="gradient" color="danger" icon="favorite">Update</vs-button>
                        </vs-row>
                    </div>
                </vs-card>
            </vs-col>

            <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="6" vs-xs="12">
                <match-list class="matches-card" :matches="matches"></match-list>
            </vs-col>
        </vs-row>
    </div>
</template>

<script>
    export default {
        props: {
          summoner: {
              type: Object,
              default: null
          },
            matches: {
              type: Array,
                default: []
            }
        },
        data: function () {
            return {
                //
            }
        },
        methods: {
            //
        },
        created() {
            //
        }
    }
</script>

<style scoped>
    .profile-card {
        width: 60%;
        margin: 20px;
    }

    .matches-card {
        width: 70%;
        margin: 20px;
    }

    .ranked-emblem {
        width: 70px;
    }

    @media (max-width: 678px) {
        .profile-card {
            width: calc(100% - 40px);
        }
        .matches-card {
            width: calc(100% - 40px);
        }
    }
</style>