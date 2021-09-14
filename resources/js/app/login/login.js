import { authenticationService } from "../services/authenticationService";
import { EventBus } from "../eventBus.js"
import Title from './components/CardTitle.vue'
export default {

    components: {
        Title
    },

    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            emailRules: [
                v => !!v || "E-mail requis",
                v => /.+@.+\..+/.test(v) || "Ce champ doit être un email"
            ],
            pwdRules: [v => !!v || "Mot de passe requis"],
            lazy: false,
            valid: true,
            loading: false,
            returnUrl: "",
            erreur: ''
        };
    },
    created() {
        if (localStorage.getItem('token')) {
            this.$router.push('/')
        }
    },
    methods: {
        async connection() {
            try {
                this.loading = true;
                const data = await authenticationService.login(this.user);
                if(data.message && !data.success) {
                    this.erreur = data.message                    
                }else if (data == undefined) {
                    this.erreur = 'mot de passe ou email incorrect'
                } else {
                    const user = data
                    this.erreur = '';
                    await EventBus.$emit('loggedIn', true);
                    await this.$store.commit('connect', user);
                    await localStorage.setItem('token', user.token);
                    await this.$router.push('/');
                    // await this.$router.push(this.returnUrl);
                    EventBus.$emit('snackbar', {
                        snackbar: true,
                        text: `Bienvenue`,
                        color: 'blue',
                        timeout: 3000
                    })
                }
            } catch (error) {
                this.erreur = error     
                this.loading = false;
                EventBus.$emit('snackbar', {
                    snackbar: true,
                    text: error,
                    color: 'red',
                    timeout: 3000
                })
            }
        }
    }
};