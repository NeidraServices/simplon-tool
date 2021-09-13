import { apiService } from '../../services/apiService'
import PasswordChange from './composants/PasswordChange'
import AppLink from './composants/AppLink'
export default {
  components: {
    PasswordChange,
    AppLink
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

      file: '',
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
        name: this.userInfos.name,
        surname: this.userInfos.surname,
        email: this.userInfos.email
      }

      await apiService.post('/api/user/update', data).then(({ data }) => {
        this.user = data.data;
      })
    },

    getAvatar(image) {
      return `${location.origin}/images/${image}`;
    },

    onFileChange() {
      
      this.file = this.$refs.file.files[0];
      let formData = new FormData();
      formData.append('image', this.file);
      apiService.post('/api/user/image/update',
        formData,
      ).then(function () {
        console.log('SUCCESS!!');
      })
        .catch(function () {
          console.log('FAILURE!!');
        });
    },


  }
}