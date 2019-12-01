export default {
    methods: {
        /*
        |--------------------------------------------------------------------------
        | getResults
        |--------------------------------------------------------------------------
        |
        | This method is invoked when Index components for different models
        | are mounted. It will fetch raw resources from Laravel endpoint,
        | wrapped in Laravel pagination object. Use pagination.data to access data.
        |
        */
        getResults(page = 1) {
            this.$http.get(`/${this.content}/raw?page=${page}&sort=${this.direction + this.sortBy}&filter[search_term]=${this.searchTerm}&include=${this.relations}`)
                .then(response => {
                    this.pagination = response.data
                });
        },
    }
}