<template>
  <div>
    <v-container>
      <FlashMessage :position="'top'"></FlashMessage>
      <h2 class="titre">{{ name }}</h2>
      <v-row>
        <v-col>
          {{ title }}
          <p>{{ description }}</p>
          <Editor
            mode="viewer"
            ref="editor"
            hint="Test"
            :outline="false"
            :preview="true"
            v-model="text"
          />
        </v-col>
      </v-row>
      <v-btn outlined @click="">Editer</v-btn>
      <br /><br />
      <v-divider></v-divider>
      <br />
      <h3 class="titre">Commentaires :</h3>

      <div v-if="commentaries.length == 0">Aucun commentaires.</div>
      <div v-for="item in commentaries" :key="item.id">
          <v-img :src="getAvatar(item.user.avatar)"></v-img>
        <h3>{{ item.user.name }} {{ item.user.surname }}  :</h3>
        <small>{{ item.createdAt | formatDate }}</small>
        <p>{{ item.description }}</p>
        <v-divider></v-divider>
      </div>
      <v-textarea
        v-model="commentary"
        label="Ajouter un commentaire"
      ></v-textarea>
      <v-btn outlined @click="postCommentary">Ajouter</v-btn>
      <br /><br />
    </v-container>
  </div>
</template>
<style>
.v-md-toolbar {
  display: inline-flex;
  width: 100%;
}
</style>
<script>
import { Editor } from "vuetify-markdown-editor";
import Axios from "axios";

export default {
  name: "ShowReadMd",
  components: {
    Editor,
  },
  props: {
    id: {
      type: String,
    },
  },
  data() {
    return {
      name: "",
      active: "",
      category: "",
      description: "",
      commentary: "",
      title: "",
      status: [
        {
          label: "En brouillon",
          value: 0,
        },
        {
          label: "Public",
          value: 1,
        },
      ],
      categories: [],
      commentaries: [],
      text: "",
    };
  },

  methods: {
    async getData() {
      try {
        const req = await Axios.get(
          `${location.origin}/api/markedown/markdown/${this.id}`
        );
        const reqData = req.data;
        console.log(reqData);
         this.name = reqData.markdown.title;
         this.description = reqData.markdown.description;
         this.text = reqData.text;
         this.active = reqData.markdown.status;
         this.commentaries = reqData.markdown.commentary

      } catch (error) {
        console.log(error);
      }
    },

    async postCommentary() {
      const data = {
        description: this.commentary,
        userId: 1, // a changer pour avoir l'id dynamiquement
      };

      await Axios.post(
        `${location.origin}/api/markedown/commentaire/ajouter/${this.id}`,
        data
      ).then(({ data }) => {
        this.flashMessage.success({
          message: data.message,
        });
        this.getData();
      });
    }, getAvatar(image) {
          return `${location.origin}/images/${image}`;
      },
  },
  created() {
    this.getData();
  },
};
</script>
<style>
.titre {
  width: 100%;
  text-align: center;
  margin-bottom: 30px;
}
</style>
