import Sidebar from "./Sidebar";

export default {
    components: {
        Sidebar
    },


    data() {
        return {
            prevName: '',
            nextName: '',
        }
    },

    mounted() {
        let routeName = this.$route.path;
        var splits = routeName.split("/", 2);
        switch (splits[1]) {
            case "markedowns":
                this.prevName = 'eval'
                this.nextName = 'deliver'
                break

            case "evaluation360":
                this.prevName = 'm-down'
                this.nextName = 'deliver'
                break
            case "deliver":
                this.prevName = 'm-down'
                this.nextName = 'eval'
                break
        }
    },

    methods: {
        prev() {

            let routeName = this.$route.path;
            var splits = routeName.split("/", 2);
            switch (splits[1]) {
                case "markedowns":
                    this.prevName = 'm-down'
                    this.nextName = 'deliver'
                    return this.$router.push('/evaluation360')
                case "evaluation360":
                    this.prevName = 'eval'
                    this.nextName = 'deliver'
                    return this.$router.push('/markedowns')
                case "deliver":
                    this.prevName = 'eval'
                    this.nextName = 'deliver'
                    return this.$router.push('/markedowns')
            }
        },

        next() {

            let routeName = this.$route.path;
            var splits = routeName.split("/", 2);
            switch (splits[1]) {
                case "markedowns":
                    this.prevName = 'm-down'
                    this.nextName = 'eval'
                    return this.$router.push('/deliver')
                case "evaluation360":
                    this.prevName = 'm-down'
                    this.nextName = 'eval'
                    return this.$router.push('/deliver')
                case "deliver":
                    this.prevName = 'm-down'
                    this.nextName = 'deliver'
                    return this.$router.push('/evaluation360')
            }
        },


    }
}