import { authenticationService } from "../services/authenticationService";
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
    methods: {
        connection() {

            this.loading = true;
            authenticationService.login(this.user).then(
                user => {

                    if (user == undefined) {
                        this.erreur = 'mot de passe ou email incorrect'
                    } else {
                        this.erreur = '';
                        localStorage.setItem('token', user.token);
                        this.$store.commit('connect', user);
                        this.$router.push('/dashboard');
                        this.$router.push(this.returnUrl);
                    }

                },
                error => {
                    this.loading = false;
                }
            );
        }
    }
};