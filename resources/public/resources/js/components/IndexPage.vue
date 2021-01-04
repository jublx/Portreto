<template>
  <div class="page container-fluid px-5">
    <div class="row">
      <div class="col-xl">
        <div class="row">
          <h1><span>Portreto</span>, la plateforme qui regroupe les informations de contact qui <span>vous</span> intéressent.</h1>
        </div>
        <div class="row">
          <img src="../../images/profile.png" class="d-none d-xl-block">
        </div>
      </div>
      <div class="col-xl px-xl-5">
        <connection-formulary></connection-formulary>
      </div>
    </div>
  </div>
</template>

<script>
import Connection from './Connection';

export default {
    mounted() {
        console.log('Component mounted.')
    },
    components: {
      "connection-formulary": Connection
    }
}
</script>

<style>
h1 {
  font-family: Roboto, sans-serif;
  font-weight: 80;
  font-size: 3em;
  line-height: 70px;
}

img {
  max-width: 50%;
  margin: 6vh auto 0;
}
</style>