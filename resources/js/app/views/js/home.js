export default {
    data() {
        return {
            projectCard : [
                {
                    name: "Evaluation 360°",
                    description: "Faites vous évaluer et gagner en compétence",
                    path: "/evaluation360/accueil"
                },
                {
                    name: "Markdown",
                    description: "Votre bibliothèque de ressources",
                    path: "/markedowns"
                },
                {
                    name: "Project Deliver",
                    description: "Tous les rendus de projet à porter de main",
                    path: "/deliver"
                }
            ]
        }
    },
    methods: {
        goToProject(path){
            this.$router.push(path)
        }
    }
}