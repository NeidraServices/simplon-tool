export default {
    data() {
        return {
            userRole: this.$store.state.userInfo.role.id
        }
    },
    
    created() {
        this.showRole()
    },

    methods: {
        showRole() {

        }
    }
}