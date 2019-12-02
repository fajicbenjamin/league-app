<template>
    <section>
        <vs-card class="cardx" v-for="match in matches" :key="match.gameId">
            <vs-row>
                <vs-col vs-w="2">
                    <vs-avatar size="50px" :src="match.champion"/>
                </vs-col>
                <vs-col vs-w="5" vs-xs="10" class="queue-col">
                    <h5>{{ match.queue.map }}</h5>
                    <p>{{match.queue.description}}</p>
                </vs-col>
                <vs-col vs-w="5" vs-xs="12" class="details-col">
                    <vs-button color="success" type="gradient" @click="seeMatch(match.gameId)">
                        See game details
                    </vs-button>
                </vs-col>
            </vs-row>

            <vs-divider position="left" class="m-0">
                {{ match.time }}
            </vs-divider>
        </vs-card>
    </section>
</template>

<script>
    export default {
        props: {
            matches: {
                type: Array,
                default: []
            }
        },
        data: function() {
            return {
                // match: this.matches[0]
            }
        },
        methods: {
            seeMatch(gameId) {
                window.location.href += `/match/${gameId}`
            },
            // calculateKda(stats) {
            //     if (stats.deaths === 0)
            //         return 'Perfect KDA';
            //
            //     return `${(stats.kills + stats.assists) / stats.deaths}:1`
            // },
            // calculateCsPerMinute(match) {
            //     return (match.stats.totalMinionsKilled / (match.gameDurationInSeconds / 60)).toFixed(1)
            // }
        },
        created() {
            // console.log(this.match)
        }
    }
</script>

<style scoped>
    .queue-col {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .details-col {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .queue-col p {
        margin-bottom: 0.5rem;
    }

    .vs-button:focus {
        outline: 0;
    }

    @media (max-width: 678px) {
        .queue-col {
            align-items: center;
        }
    }
</style>