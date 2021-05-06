import Sidebar from "./Sidebar.vue";
import Logout from './Logout.vue'
import MenuEval from '../navigations/evaluation360/MenuEval.vue'
import MenuMd from '../navigations/markdown/MenuMd.vue'
import MenuDeliver from '../navigations/deliver/MenuDeliver.vue'
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
        isChecked() {
			let routeName = this.$route.path;
			var splits = routeName.split("/", 2);
			if (splits[1] != "compte") {
				return this.$store.state.isLogged;
			}
		},
        
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