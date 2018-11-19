/**
 * Blog Posts Component
 * 
 */

Vue.component('blog-posts', {
  template: `
    <div>
      <div class="blog-post" v-for="(post, index) in posts" :key="index">
        <div class="blog-subject">
            <h2>
            <a href="">{{ post.subject }}</a>
            </h2>
        </div>
        <div class="blog-message">{{ post.message }}</div>
      </div>
    </div>
  `,
  data() {
    return {
      posts: this.posts
    }
  },
  methods: {
    getPosts() {
      return fetch('/api/v1/blog')
        .then(response => response.json())
        .then(json => this.setPosts(json.data))
        .catch(error => console.warn(error))
    },
    setPosts(data) {
      this.posts = data
    }
  },
  mounted() {
    this.getPosts()
  }
})

const vm = new Vue({ el: '#blog-container' })