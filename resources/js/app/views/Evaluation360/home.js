import { apiService } from "../../services/apiService.js";
import { EventBus } from '../../eventBus.js';
import PieChart from "../../components/charts/PieChart.js";

export default {
    components: {
        PieChart
    },

    mounted() {

    },

    data() {
        return {
            userRole: this.$store.state.userInfo.role,
            isLoaded: false,
            chartDataSondage: {},
            chartOptionsSondage: {},
        }
    },

    watch: {

    },

    created() {
        this.getHomeData()
    },

    methods: {
        async getHomeData() {
            try {
                this.isLoaded = false;
                if(this.userRole.id == 2){
                    const request      = await apiService.get(`${location.origin}/api/evaluation360/stats/sondage`);
                    const requestData  = request.data;
                    if(requestData) {
                        
                        this.chartDataSondage = {
                            labels: requestData.labels,
                            datasets: [
                                {
                                    backgroundColor: ['#000982', '#a8630f'],
                                    data: requestData.data
                                }
                            ]
                        }
                        this.chartOptionsSondage = {
                            responsive: true, maintainAspectRatio: false, title: {
                                display: true,
                                text: `Nombre de sondages (${requestData.total})`
                            }
                        }
                        this.isLoaded = true;
                    }
                } else if(this.userRole.id == 3){
                    console.log('je suis un apprenant')
                }
            } catch (error) {
                console.log(error)
                EventBus.$emit('snackbar', {
                    text: `Stats sondage : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        }
    }
}