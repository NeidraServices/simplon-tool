import { apiService } from '../../services/apiService.js';

export default {
    components: {
        
    },

    mounted() {

    },

    data() {
        return {
            message: '',
            isVerified: false,
        }
    },

    watch: {

    },

    created() {
        if (!this.$route.params.token) {
            this.$router.push('/')
        } else {
            this.verify(this.$route.params.token);
        }
    },

    methods: {

        async verify(verifyToken) {
            try {
                let dataSend = {
                    confirmToken: verifyToken
                };

                const verifyMailReq = await apiService.post(`${location.origin}/api/email/verification`, dataSend);
                const verifyData = verifyMailReq.data;

                if(verifyData.success) {
                    this.message = verifyData.message;
                } else {
                    this.message = verifyData.message;
                    this.isVerified = true;     
                }
                
            } catch (error) {
                this.flashMessage.error({
                    message: 'Une erreur est survenue'
                });
            }
        }
    }
}