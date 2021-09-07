export default {
    data() {
        return {
            userRole: this.$store.state.userInfo.role.id,
            trainerMenu: [
                { title: 'Accueil', route: '/evaluation360/accueil'},
                { title: 'Tous les apprenants', route: '/evaluation360/apprenants' },
                { title: 'Gestion des apprenants', route: '/evaluation360/cohorte'},
                { title: 'Gestion des sondages', route: '/evaluation360/formateur/sondages'},
            ],
            learnerMenu: [
                { title: 'Accueil', route: '/evaluation360/accueil'},
                { title: 'Tous les apprenants', route: '/evaluation360/apprenants' },
                { title: 'Tous les sondages', route: '/evaluation360/sondages' },
                { title: 'Gestion des sondages', route: '/evaluation360/apprenant/sondages' },
            ]
        }
    },
    
    created() {
        
    },

    methods: {

    }
}