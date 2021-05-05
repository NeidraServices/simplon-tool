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
                { text: 'Prénoms', value: 'surname' },
                { text: 'Email', value: 'email' },
                { text: 'Etat', value: 'verify' },
                { text: 'Actions', value: 'actions' },
            ],
        }
    },

    watch: {

    },

    created() {
        this.getData()
    },

    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/users/list`);
                const reqData = req.data.data;
                this.userList = reqData;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        }
    }
}