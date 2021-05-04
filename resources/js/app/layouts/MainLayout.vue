<template>
  <div>
   <v-container fluid>
        <v-row justify="flex-start" class="row-container">
            <!-- <v-sidebar prop-no-gutters drawer :close-on-click="false" v-model="sidebar" height="100">
              <v-flex class="flex-direction: column">
                <v-row justify="space-between">
                  <v-col>
                    <v-avatar color="indigo" size="46">
                      <v-img src='https://picsum.photos/id/237/200/300' alt='C'/>
                  </v-avatar>
                  </v-col>
                </v-row>
              </v-flex>

            </v-sidebar> -->
            <v-navigation-drawer 
              permanent 
              expand-on-hover 
              mini-variant-width="90"
              class="grey lighten-2 navigation"
            >
            <v-list-item class="list-item pa-0">
              <v-list-item-content>
                <v-list-item-title class="pa-5 hidden-sm-and-down">
                <v-list-item-content>
                    <div class="d-flex justify-center">
                      <v-avatar color="indigo" size="46">
                        <v-img src='https://picsum.photos/id/237/200/300' alt='C'/>
                    </v-avatar>
                    </div>
                    <div class="nom">Nom et prénom</div>
                </v-list-item-content>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <div class="lien">
            <v-divider></v-divider>
              <div class="lien-module">
                <div><slot name="lien1"> </slot> </div>
                <div><slot name="lien2"> </slot></div>
              </div>
            </div>
          </v-navigation-drawer>          
          <slot name="content-slot"> </slot>
        </v-row>
      </v-container>
  </div>
</template>

<style lang="scss">
  .row-container {
    height: 100vh;
  }
  .v-navigation-drawer:hover {
    & .nom {
     display: flex;
     justify-content: center;
     margin-top: 15px;
    }
    & .lien-module > div{
    display: flex;
    justify-content: center;
    width: 100%;
  }
  }

  .lien {
    height: 40px;
    width: 100%;
    position: absolute;
    bottom: 0;
  }
  .lien-module{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 10px;
  }
  .lien-module > div{
    display: none;
  }
  .nom {
    display: none;
  }
</style>