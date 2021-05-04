import { apiService } from '../../../../services/apiService.js';
export default {
    data() {
        return {
            referentiel: []
        }
    },
    created() {
        this.initializeData()
    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/referentiel/list`)
                const reqData = req.data.data
                this.referentiel = reqData
            }
            catch (err) { console.log(err) }
        },
    }
}