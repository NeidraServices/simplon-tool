<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="6">
        <v-card>
          <v-card-title>Veuillez entrer votre e-mail</v-card-title>
          <v-card-text>
            <v-form
              autocomplete="off"
              v-model="valid"
              lazy-validation
              @submit.prevent="requestResetPassword"
              method="post"
            >
              <div class="form-group">
                <v-text-field
                  type="email"
                  :rules="emailRules"
                  id="email"
                  class="form-control"
                  placeholder="user@example.com"
                  v-model="email"
                  label="email"
                  required
                />
              </div>
              <v-btn type="submit" depressed>
                Lien de vérification d'e-mail
              </v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      email: null,
      has_error: false,
      valid: true,
      emailRules: [
        (v) => !!v || "Email de l'apprenant requis",
        (v) => /.+@.+\..+/.test(v) || "Ce champ doit être un email",
      ],
    };
  },
  methods: {
    requestResetPassword() {
      axios.post("/api/password/email", { email: this.email }).then(
        (result) => {
          this.response = result.data;
        },
        (error) => {
          console.error(error);
        }
      );
    },
  },
};
</script>