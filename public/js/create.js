/**
 * Create Posts Component
 * 
 */

Vue.component('create-post', {
  template: `
    <form id="create-post" v-on:submit.prevent="submitPost()">
        <h1>Create Post</h1>
        <input type="text" name="subject" placeholder="Enter a subject">
        <textarea placeholder="Enter a message."></textarea>
        <button type="submit">Submit</button>
    </form>
  `,
  methods: {
    submitPost(event) {
      const data = {
        'subject': this.$el[0].value,
        'message': this.$el[1].value
      }
      return fetch('/api/v1/blog', {
        method: 'post',
        body: JSON.stringify(data),
        headers: { 
          'Content-Type': 'application/json'
        }
      }).then(response => {
        window.location.href = '/'
      }).catch(error => console.warn(error))
    }
  }
})

const vm = new Vue({ el: '#blog-container' })