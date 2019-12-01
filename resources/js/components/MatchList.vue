<template>
    <section>
        <vs-card class="cardx" v-for="match in matches" :key="match.gameId">
            <vs-row>
                <vs-col vs-w="2">
                    <vs-avatar size="50px" :src="match.champion"/>
                </vs-col>
                <vs-col vs-w="4">
                    {{ match.queue.map + ' ' + match.queue.description}}
                    <button @click="seeMatch(match.gameId)">da</button>
                </vs-col>
                <vs-col>
                    {{ match.time }}
                </vs-col>
            </vs-row>
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

<style scoped lang="scss">
</style>