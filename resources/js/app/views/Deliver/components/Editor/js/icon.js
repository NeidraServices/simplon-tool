export default {
    props: {
      icon: {
        type: String,
        required: true,
      },
  
      title: {
        type: String,
        required: true,
      },
  
      action: {
        type: Function,
        required: true,
      },
  
      isActive: {
        type: Function,
        default: null,
      },
    },
}