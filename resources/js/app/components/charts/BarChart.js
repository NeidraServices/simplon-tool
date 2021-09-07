import Vue from "vue";
import VueChartJs from 'vue-chartjs';

export default Vue.component('bar-chart', {
    extends: VueChartJs.Bar,

    props: {
        chartdata: {
            type: Object,
            default: null
          },
          options: {
            type: Object,
            default: null
          }
    },

    data() {
        return {
            // chartdata: {
            //     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            //     datasets: [
            //         {
            //             label: 'Data One',
            //             backgroundColor: '#f87979',
            //             data: [40, 39, 10, 40, 39, 80, 40]
            //         }
            //     ]
            // },
            // options: { responsive: true, maintainAspectRatio: false }
        }
    },

    mounted() {
        this.renderChart(this.chartdata, this.options)
    }
})