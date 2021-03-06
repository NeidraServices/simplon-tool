import { apiService } from "../../../services/apiService"
import { authenticationService } from "../../../services/authenticationService"
export default {
  data() {
    return {
      dialog: false,
      valid: true,
      password: '',
      password_confirmation: ''
    }
  },


  methods: {
    getUser() {
    },

    updatePassword() {
      let data = {
        password: this.password,
        password_confirmation: this.password_confirmation
      }

      apiService.post('/api/user/update/password', data).then((data) => {
        this.dialog = false;

      })
    },
    resetForm() {
      this.password = '';
      this.password_confirmation = '';
      this.dialog = false;
    }
  }
}