<template>
  <div class="container-fluid bg-custom shadow">
    <ul class="nav custom-shadow">
      <li class="nav-item">
        <router-link class="nav-link" to="/progress">AVANCEMENT</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/about">À PROPOS</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/contact">CONTACT</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  
}
</script>

<style scoped>
.bg-custom {
  background-color: #1e1e1e;
  position: fixed;
  bottom: 0;
}

.bg-custom ul {
  justify-content: center;
}

.nav-link {
  font-size: 1.2em;
}
.nav-item {
  cursor: pointer;
}

.nav-item a {
  color: #f8fafc;
  text-decoration: none;
  font-size: 1.1em;
}

.nav-item a:after {
  content: '';
  position: relative;
  width: 0; 
  height: 2px;
  display: block;
  margin-top: -6px;
  z-index: -1;
  background: #08A873;
  opacity: 1;
  transition: width .2s ease;
}

.nav-item a:hover:after {
  width: 75%;
  left: 0;
}
  
</style>