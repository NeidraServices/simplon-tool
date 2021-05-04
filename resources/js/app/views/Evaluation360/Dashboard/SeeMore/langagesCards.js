import { apiService } from '../../../../services/apiService.js';
export default {
    data() {
        return {
            langages: []
        }
    },
    created() {
        this.initializeData()
    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/langage/list`)
                const reqData = req.data.data
                this.langages = reqData
            }
            catch (err) { console.log(err) }
        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}