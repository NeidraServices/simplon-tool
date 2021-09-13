<template>
  <div>
    <v-container fluid v-if="isChecked">
      <v-navigation-drawer mobile-breakpoint="960" app width="260">
        <v-list class="d-flex listSidebar">
          <v-list-item>
            <v-list-item-avatar>
              <v-img :src="getAvatar(userLoggedIn.avatar)"></v-img>
            </v-list-item-avatar>
          </v-list-item>

          <v-list-item link :to="'/evaluation360/user/' + userLoggedIn.id">
            <v-list-item-content>
              <v-list-item-title class="title">
                {{ userLoggedIn.name }} {{ userLoggedIn.surname }}
              </v-list-item-title>
              <v-list-item-subtitle>{{
                userLoggedIn.email
              }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <slot name="menus"></slot>
        <template v-slot:append>
          <slot name="lien"></slot>
        </template>
      </v-navigation-drawer>
    </v-container>
  </div>
</template>

<script>
import { authenticationService } from "../services/authenticationService";
import { EventBus } from "../eventBus.js";
export default {
  data() {
    return {
      role: null,
      userLoggedIn: null,
    };
  },

  computed: {
    isChecked() {
      let routeName = this.$route.path;
      let defaultRoute = this.$route.path;
      var splits = routeName.split("/", 2);
       if (splits[1] != "compte" && defaultRoute != "/") {
        return this.$store.state.isLogged;
      }
    },
  },

  mounted() {
    EventBus.$on("loggedIn", function () {
      authenticationService.role.subscribe((x) => (this.role = x));
    });
  },

  created() {
    this.userLoggedIn = this.$store.state.userInfo;
    authenticationService.role.subscribe((x) => (this.role = x));
  },
  
  methods: {
    getAvatar(image) {
      return `${location.origin}/images/${image}`;
    },
  },
};
</script>

<style>
.link:hover {
  background-color: gray;
  color: white;
  cursor: pointer;
}
.link:nth-child(1) {
  border: 1px solid rgba(0, 0, 0, 0.12);
  border-bottom: 0;
}
.link:nth-child(2) {
  border-top: 1px solid rgba(0, 0, 0, 0.12);
}
.listSidebar {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}
</style>