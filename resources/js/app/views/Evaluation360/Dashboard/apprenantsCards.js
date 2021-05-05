import { apiService } from '../../../services/apiService.js';
export default {
    data() {
        return {
            apprenants: []
        }
    },
    created() {
        this.initializeData()
    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get(`${location.origin}/api/users/list`)
                const reqData = req.data.data
                this.apprenants = reqData
            }
            catch (err) { console.log(err) }
        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }

}