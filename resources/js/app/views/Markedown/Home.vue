<template>
  <MainLayout>
    <template v-slot:content-slot>
      <v-content>
        <v-container fluid>
          <p>Markedown HomePage</p>
        </v-container>
      </v-content>
    </template>

    <template v-slot:lien1>
     <span>Lien 1</span>
    </template>

    <template v-slot:lien2>
     <span>Lien 2</span>
    </template>
  </MainLayout>
</template>

<script>
  import MainLayout from "../../layouts/MainLayout";
  export default {
    components: {
      MainLayout
    }
  };
</script>