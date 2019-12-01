<template>
    <div class="wrapper">
        <div class="card">
            <vs-input label-placeholder="Summoner name" v-model="summoner" @keyup.enter="searchSummoner"/>

            <vs-select class="select-style" v-model="chosenRegion" id="regionSelect">
                <vs-select-item :key="region.value" :value="region.value" :text="region.name" v-for="region in regions" />
            </vs-select>

            <vs-button size="small" class="search-button" type="gradient" icon="search" @click="searchSummoner">Search</vs-button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                summoner: '',
                chosenRegion: null,
                regions: [
                    {name: 'Korea', value: 'kr'},
                    {name: 'Japan', value: 'jp'},
                    {name: 'North America', value: 'na'},
                    {name: 'Europe West', value: 'euw'},
                    {name: 'Europe Nordic & East', value: 'eune'},
                    {name: 'Oceania', value: 'oce'},
                    {name: 'Brazil', value: 'br'},
                    {name: 'LAS', value: 'las'},
                    {name: 'LAN', value: 'lan'},
                    {name: 'Russia', value: 'ru'},
                    {name: 'Turkey', value: 'tr'}
                ]
            }
        },
        methods: {
            searchSummoner() {
                localStorage.setItem('region', this.chosenRegion)
                window.location.href = `profile/${this.chosenRegion}/${this.summoner}`
            }
        },
        mounted() {
            this.chosenRegion = localStorage.getItem('region')
        }
    }
</script>

<style scoped>
    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-size: cover;
        background-image: linear-gradient(transparent, black 80%), url('/images/background.jpg');
    }

    #regionSelect {
        margin-top: 17px;
        margin-left: 10px;
        margin-right: 10px;
    }

    #regionSelect >>> input {
        height: 38px;
    }

    .card {
        background: rgb(255, 255, 255, 0.7);
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        height: 100px;
        box-shadow: 0 3px 27px #00000029;
        border-radius: 10px;
        padding: 13px 20px 10px 20px;
    }

    .search-button {
        margin-top: 17px;
    }
</style>
