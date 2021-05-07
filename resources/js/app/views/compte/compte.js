import { apiService } from '../../services/apiService'

export default {
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
      apps: ["Markdown", "Elevation360", "Deliver"],
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
    }

  }
}