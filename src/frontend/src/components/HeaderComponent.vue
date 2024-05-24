<template>
  <b-navbar>
    <template #brand>
      <b-navbar-item tag="router-link" :to="{ path: '/peliculas' }">
        <img alt="VHS Logo" src="@/assets/vhs.svg" />
      </b-navbar-item>
    </template>
    <template #start>
      <b-navbar-item tag="router-link" to="/peliculas">Películas</b-navbar-item>
      <b-navbar-item tag="router-link" to="/clientes">Clientes</b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
export default {};
</script>
