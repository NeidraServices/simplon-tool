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
      avatar: "",
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
      apiService.get('/api/account/user/' + this.$route.params.id).then(({ data }) => {
        // console.log("DATAAAA : ",data)
        this.user = data.data;
        this.userInfos.surname = data.data.surname
        this.userInfos.name = data.data.name
        this.userInfos.email = data.data.email
      })
    },

    async updateUser() {
      let data = {
        name: this.userInfos.name,
        surname: this.userInfos.surname,
        email: this.userInfos.email
      }

      await apiService.post('/api/account/user/update', data).then(({ data }) => {
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

      // console.log(formData);
      let elem = this
      apiService.post('/api/account/user/image/update',
        formData,
      ).then(function (response) {
        // console.log(elem)
        elem.avatar = `${location.origin}/images/avatars/${response.data.avatar_name}`;
        console.log(response.data.message);
      })
        .catch(function (error) {
          console.log('FAILURE!!', error);
        });
    },


  }
}