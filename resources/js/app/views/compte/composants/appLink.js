export default {
  data() {
    return {
      apps: [
        { name: "Markdown", link: '/markedowns' },
        { name: "Elevation360", link: '/evaluation360' },
        { name: "Deliver", link: '/deliver' }
      ],
    }
  },

  methods: {
    pushLink(link) {
      this.$router.push(link)
    }
  }
}