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
  background-color: #f8fafc;
  position: fixed;
  bottom: 0;
}

.bg-custom ul {
  justify-content: flex-end;
}

.nav-link {
  font-size: 1.2em;
}
.nav-item {
  cursor: pointer;
}

.nav-item a {
  color: #212529;
  text-decoration: none;
  font-size: 1.1em;
}

.nav-item a:after {
  content: '';
  position: relative;
  width: 0; 
  height: 10px;
  display: block;
  margin-top: -12px;
  z-index: -1;
  background: #08A873;
  opacity: 0.4;
  transition: width .2s ease;
}

.nav-item a:hover:after {
  width: 90%;
  left: 0;
}

@media (max-width: 750px) {
  .bg-custom ul {
    justify-content: center;
  }
}
  
</style>