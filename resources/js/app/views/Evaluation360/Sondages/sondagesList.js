import { apiService } from "../../../services/apiService";

export default {
    data() {
        return {
            sondages: [],
            isLoaded: false
        }
    },
    mounted() {
        
    },
    created() {
        this.getSondages();
    },
    methods: {
        async getSondages() {
            try {
                this.isLoaded = false;
                const req = await apiService.get(`${location.origin}/api/evaluation360/apprenant/sondage/list`)
                const reqData = req.data.data
                if(reqData) {
                    this.sondages = reqData
                    this.isLoaded = true;
                } 
            }
            catch (err) { console.log(err) }
        },
    }
}