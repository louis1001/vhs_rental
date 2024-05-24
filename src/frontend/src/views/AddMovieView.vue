<template>
  <div class="single-movie">
    <b-loading
      :is-full-page="false"
      v-model="loading"
      :can-cancel="true"
    ></b-loading>
    <h1>Nueva película</h1>
    <EditMovieForm v-model:="movie" :topicos="topicos" />
    <div
      id="submit-container"
      class="submit-container container is-flex is-justify-content-space-between"
    >
      <b-button type="is-danger" @click="cancelarCreacion">Descartar</b-button>
      <b-button type="is-primary" @click="saveMovie">Guardar</b-button>
    </div>
  </div>
</template>

<script>
import EditMovieForm from "@/components/EditMovieForm.vue";
import { movies, topicos } from "@/service/services";

export default {
  name: "AddMovieView",
  components: {
    EditMovieForm,
  },
  data() {
    return {
      movie: {
        titulo: "",
        resumen: "",
        anio: 2024,
        topico: null,
        disponible: false,
      },
      topicos: [],
      loading: true,
    };
  },
  async mounted() {
    try {
      this.topicos = await topicos.getTopicos();
    } catch (e) {
      console.error(e);
    } finally {
      this.loading = false;
    }
  },
  methods: {
    async saveMovie() {
      try {
        await movies.createMovie(this.movie);

        this.$router.push({ path: `/peliculas` });

        this.$buefy.notification.open({
          message: "Película creada!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al crear la película`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    },
    cancelarCreacion() {
      this.$router.push({ path: `/peliculas` });
    },
  },
};
</script>

<style lang="sass">
.submit-container
  margin-block: 2rem
</style>
