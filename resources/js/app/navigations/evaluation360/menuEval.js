export default {
    data() {
        return {
            userRole: this.$store.state.userInfo.role.id,
            menuList: [],
        }
    },

    created() {
        let trainerMenu = [
            { title: 'Accueil', route: '/evaluation360/accueil' },
            { title: 'Tous les apprenants', route: '/evaluation360/apprenants' },
            { title: 'Gestion des apprenants', route: '/evaluation360/cohorte' },
            { title: 'Gestion des sondages', route: '/evaluation360/formateur/sondages' },
        ];

        let adminMenu = [
            { title: 'Accueil', route: '/evaluation360/accueil' },
            { title: 'Gestion des langages', route: '/evaluation360/langages' },
            { title: 'Gestion des compétences', route: '/evaluation360/competences' },
            { title: 'Gestion des utilisateurs', route: '/evaluation360/cohorte' },
            { title: 'Gestion des promotions', route: '/evaluation360/promotions' },
            { title: 'Gestion des sondages', route: '/evaluation360/formateur/sondages' },
        ];

        let learnerMenu = [
            { title: 'Accueil', route: '/evaluation360/accueil' },
            { title: 'Tous les apprenants', route: '/evaluation360/apprenants' },
            { title: 'Tous les sondages', route: '/evaluation360/sondages' },
            { title: 'Gestion des sondages', route: '/evaluation360/apprenant/sondages' },
        ];

        if (this.userRole == 1) {
            this.menuList = adminMenu;
        }

        if (this.userRole == 2) {
            this.menuList = trainerMenu;
        }

        if (this.userRole == 3) {
            this.menuList = learnerMenu
        }
    },

    methods: {

    }
}