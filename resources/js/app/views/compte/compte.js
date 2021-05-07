import { apiService } from '../../services/apiService'
import PasswordChange from './composants/PasswordChange'
export default {
  components: {
    PasswordChange
  },
  data() {
    return {
      user: null,
      isUpdateName: false,
      isUpdateSurname: false,
      isUpdateEmail: false,
      userInfos: {
        name: null,
        surname: null,
        email: null
      },
      apps: [
        { name: "Markdown", link: '/markedowns' },
        { name: "Elevation360", link: '/evaluation360' },
        { name: "Deliver", link: '/deliver' }],
    }
  },

  created() {
    this.getUser()
  },

  methods: {
    getUser() {
      apiService.get('/api/user/' + this.$route.params.id).then(({ data }) => {
        this.user = data.data;
      })
    },

    async updateUser() {
      let data = {
        id: this.user.id,
        name: this.userInfos.name,
        surname: this.userInfos.surname,
        email: this.userInfos.email
      }

      await apiService.post('/api/user/update', data).then(({ data }) => {
        this.user = data.data;
      })
    },


    pushLink(link) {
      this.$router.push(link)
    }

  }
}