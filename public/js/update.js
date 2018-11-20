/**
 * Update Posts Component
 * 
 */

Vue.component('update-post', {
  template: `
    <form id="update-post" v-on:submit.prevent="submitPost()">
      <h1>Update Post</h1>
      <input type="text" name="subject" placeholder="Enter a subject" :value="post.subject">
      <textarea placeholder="Enter a message." :value="post.message"></textarea>
      <button type="submit">Submit</button>
    </form>
  `,
  data() {
    return {
      post: this.post || []
    }
  },
  methods: {
    getPosts() {
      const id = window.location.pathname.split('/')[2]
      return fetch(`/api/v1/blog/${id}`)
        .then(response => response.json())
        .then(json => {
          console.log(json.data[0])
          this.setPosts(json.data[0])
        })
        .catch(error => console.warn(error))
    },
    setPosts(data) {
      this.post = data
    },
    submitPost(event) {
      const id = window.location.pathname.split('/')[2]
      const data = {
        'subject': this.$el[0].value,
        'message': this.$el[1].value
      }
      return fetch(`/api/v1/blog/${id}`, {
        method: 'put',
        body: JSON.stringify(data),
        headers: { 
          'Content-Type': 'application/json'
        }
      }).then(response => {
        window.location.href = '/'
      }).catch(error => console.warn(error))
    }
  },
  mounted() {
    this.getPosts()
  }
})

const vm = new Vue({ el: '#blog-container' })