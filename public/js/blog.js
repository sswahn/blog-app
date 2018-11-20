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
        <div class="blog-modifiers">
          <a :post-id="post.id" :href="'/update/' + post.id">update</a>
          <span>|</span>
          <a :post-id="post.id" href="" @click="deletePost">delete</a>
        </div>
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
    },
    updatePost(event) {
      event.preventDefault()
      const id = event.target.getAttribute('post-id')
      console.log(id); return;
      // open modal with button that executes api call
    },
    deletePost(event) {
      event.preventDefault()
      const id = event.target.getAttribute('post-id')
      if (window.confirm('Delete this post?')) {
        return fetch(`/api/v1/blog/${id}`, { method: 'delete' })
        .then(response => response.text())
        .then(data => this.getPosts())
        .catch(error => console.warn(error))
      }
    }
  },
  mounted() {
    this.getPosts()
  }
})

const vm = new Vue({ el: '#blog-container' })