<template>
  <div>
    <div class="submit-container container is-flex is-justify-content-space-between">
      <h2 class="subtitle">Historial de prestamos</h2>

      <b-button type="is-secondary" :disabled="!disponible" @click="goToRentForm">Prestar</b-button>
    </div>

    <div id="empty-message" v-if="prestamos.length === 0">
      <p class="is-family-secondary is-flex is-justify-content-center">No han habido prestamos</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RentHistory',
  props: ['movieId', 'prestamos', 'disponible'],
  methods: {
    goToRentForm() {
      this.$router.push({ name: 'nuevo_prestamo', params: { movieId: this.movieId } });
    },
  }
};
</script>

<style scoped>
#empty-message {
  margin-block: 2rem;
  opacity: 0.7;
}
</style>