import { authenticationService } from "../services/authenticationService";
import { EventBus } from "../eventBus.js"
export default {

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
        if (authenticationService.currentUserValue) {
            return this.$router.push('/');
        }

        this.returnUrl = this.$route.query.returnUrl || "/";
    },
    methods: {
        async connection() {
            try {
                this.loading = true;
                const user = await authenticationService.login(this.user);
                if (user == undefined) {
                    this.erreur = 'mot de passe ou email incorrect'
                } else {
                    this.erreur = '';
                    await EventBus.$emit('logged', true);
                    await this.$store.commit('connect', user);
                    await localStorage.setItem('token', user.token);
                    await this.$router.push('/dashboard');
                    // await this.$router.push(this.returnUrl);
                }
            } catch (error) {
                this.loading = false;
            }
        }
    }
};