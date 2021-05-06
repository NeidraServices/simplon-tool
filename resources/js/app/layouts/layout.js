import Sidebar from "./Sidebar";
import Logout from './Logout'
import MenuEval from '../navigations/evaluation360/MenuEval'
import MenuMd from '../navigations/markdown/MenuMd'
import MenuDeliver from '../navigations/deliver/MenuDeliver'
export default {
    components: {
        Sidebar,
        Logout,
        MenuEval,
        MenuMd,
        MenuDeliver
    },


    data() {
        return {
            prevName: '',
            nextName: '',
        }
    },

    computed: {
        pathIsEval() {
            let routeName = this.$route.path;
            var splits = routeName.split("/", 2);
            if (splits[1] == "evaluation360") {
                return splits[1];
            }
        },
        pathIsMd() {
            let routeName = this.$route.path;
            var splits = routeName.split("/", 2);
            if (splits[1] == "markedowns") {
                return splits[1];
            }
        },
        pathIsDeliver() {
            let routeName = this.$route.path;
            var splits = routeName.split("/", 2);
            if (splits[1] == "deliver") {
                return splits[1];
            }
        },
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