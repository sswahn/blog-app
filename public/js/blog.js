/**
 * Blog Posts Component
 * 
 */

Vue.component('blog-posts', {
  props: ['post'],
  template: `
    <div class="blog-post">
    <div class="blog-subject">
        <h2>
        <a href="">{{ post.subject }}</a>
        </h2>
    </div>
    <div class="blog-message">{{ post.message }}</div>
    </div>
  `
})

const vm = new Vue({
  el: '#blog-container',
  data: {
    posts: this.posts
  },
  methods: {
    getPosts() {
    return fetch('/api/v1/blog')
        .then(response => {
            console.log(response)
            return response.json()
        })
        .then(json => {
            console.log(json.data)
            this.setPosts(json.data)
        })
        .catch(console.error)
    },
    setPosts(data) {
    this.posts = data
    }
  },
  mounted() {
    this.getPosts()
  }
})