<template>
    <div id="create-users-form">
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Name" value="" v-model="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" value="" v-model="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" value="" v-model="password">
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="file" id="file" placeholder="file" value="">
            </div>

            <button type="submit" id="create-user-form" class="btn btn-primary">Create</button>
        </form>
    </div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  },
  data() {
    return {
        name: '',
        email: '',
        password: '',
        file: ''
    }
  },
  methods: {
    submit() {
      window.axios.post('/api/v1/users', {
        name: this.name,
        email: this.email,
        password: this.password,
        file: this.file
      }).then(function (response) {
        console.log(response);
      }).catch(function (error) {
        console.log(error);
      });
    }
  }
}
</script>
