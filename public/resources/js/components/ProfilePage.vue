<template>
  <div v-if="user.name" class="container-fluid page">
    <h1>Bienvenue <span>{{user.name}}</span> !</h1>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    }
  },
  created() {
    if(this.$root.$data.isUserLogged) {
      this.user = this.$root.$data.user;
    } else {
      this.$router.push('/');
    }
  }
}
</script>

<style scoped>
div {
  text-align: center;
}
</style>