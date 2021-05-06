// import { Editor, EditorContent } from '@tiptap/vue-2'
// import { defaultExtensions } from '@tiptap/starter-kit'
// import Collaboration from '@tiptap/extension-collaboration'
// import CollaborationCursor from '@tiptap/extension-collaboration-cursor'
// import TaskList from '@tiptap/extension-task-list'
// import TaskItem from '@tiptap/extension-task-item'
// import Highlight from '@tiptap/extension-highlight'
// import CharacterCount from '@tiptap/extension-character-count'

// import Menu from '../menu.vue'

// const getRandomElement = list => {
//   return list[Math.floor(Math.random() * list.length)]
// }

// const getRandomRoom = () => {
//   return getRandomElement([
//     // HN killed it all
//     // 'room.one',
//     // 'room.two',
//     // 'room.three',
//     // 'room.four',
//     // 'room.five',
//     'room.six',
//     // 'room.seven',
//     // 'room.eight',
//     'room.nine',
//     // 'room.ten',
//     'room.eleven',
//     'room.twelve',
//     'room.thirteen',
//   ])
// }

// export default {
//   components: {
//     EditorContent,
//     Menu,
//   },

//   data() {
//     return {
//       editor: null,
//     }
//   },

//   mounted() {
//     this.editor = new Editor({
//       extensions: [
//         ...defaultExtensions().filter(extension => extension.name !== 'history'),
//         Highlight,
//         TaskList,
//         TaskItem,
//         Collaboration.configure({
//           document: ydoc,
//         }),
//         CollaborationCursor.configure({
//           provider: this.provider,
//           user: this.currentUser,
//           onUpdate: users => {
//             this.users = users
//           },
//         }),
//         CharacterCount.configure({
//           limit: 10000,
//         }),
//       ],
//     })
//   },

//   methods: {

//     getRandomColor() {
//       return getRandomElement([
//         '#958DF1',
//         '#F98181',
//         '#FBBC88',
//         '#FAF594',
//         '#70CFF8',
//         '#94FADB',
//         '#B9F18D',
//       ])
//     },

//   },

//   beforeDestroy() {
//     this.editor.destroy()
//     this.provider.destroy()
//   },
// }