<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="6">
        <v-card>
          <v-card-title>Veuillez entrer votre e-mail</v-card-title>
          <v-card-text>
            <form
              autocomplete="off"
              @submit.prevent="requestResetPassword"
              method="post"
            >
              <div class="form-group">
                <v-text-field
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="user@example.com"
                  v-model="email"
                  label='email'
                  required
                />
              </div>
              <v-btn type="submit" depressed >
                Lien de vérification d'e-mail
              </v-btn>
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
      email: null,
      has_error: false,
    };
  },
  methods: {
    requestResetPassword() {
      console.log(this.email);
      axios.post("/api/password/email", { email: this.email}).then(
        (result) => {
          this.response = result.data;
          console.log(result.data);
        },
        (error) => {
          console.error(error);
        }
      );
    },
  },
};
</script>