import { apiService } from "../../../../services/apiService.js";

export default {
    components: {
        
    },

    mounted() {

    },

    data() {
        return {
            isLoaded: false,
            search: '',
            userList: [],
            headers: [
              {
                text: 'Nom',
                align: 'start',
                filterable: false,
                value: 'name',
              },
              { text: 'Prénoms', value: 'surnam' },
              { text: 'Email', value: 'email' },
              { text: 'Etat', value: 'verify' },
              { text: 'Actions', value: 'actions' },
            ],
        }
    },

    watch: {

    },

    created() {
       
    },

    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/`)
            } catch (error) {
                console.log(error)
            }
        }
    }
}