<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="6">
        <v-card>
          <v-card-title>Nouveau mot de passe</v-card-title>
          <v-card-text>
            <!-- <ul v-if="errors">
              <li v-for="error in errors" v-bind:key="error">{{ msg }}</li>
            </ul> -->
            <form autocomplete="off" @submit.prevent="resetPassword" method="post">
              <div class="form-group">
                  <label for="email">E-mail</label>
                  <v-text-field type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required />
              </div>
              <div class="form-group">
                  <label for="email">mot de passe</label>
                  <v-text-field type="password" id="password" class="form-control" placeholder="" v-model="password" required />
              </div>
              <div class="form-group">
                  <label for="email">Confirmez le mot de passe</label>
                  <v-text-field type="password" id="password_confirmation" class="form-control" placeholder="" v-model="password_confirmation" required />
              </div>
              <v-btn type="submit" color='primary'>Changer</v-btn>
            </form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import axios from "axios"

export default {
    data() {
      return {
        token: null,
        email: null,
        password: null,
        password_confirmation: null,
        has_error: false
      }
    },
    methods: {
        resetPassword() {
            axios.post("/api/password/reset", {
                token: this.$route.params.token,
                email: this.email,
                password: this.password,
                confirm_password: this.password_confirmation
            })
            .then(result => {
                // console.log(result.data);
                this.$router.push({name: 'login'})
            }, error => {
                console.error(error);
            });
        }
    }
}
</script>