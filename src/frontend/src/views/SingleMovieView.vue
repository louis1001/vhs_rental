<template>
  <div class="single-movie">
    <b-loading
      :is-full-page="false"
      v-model="loading"
      :can-cancel="true"
    ></b-loading>
    <h1>Editar película</h1>
    <EditMovieForm v-model:="movie" :topicos="topicos" />

    <div class="submit-container container is-flex is-justify-content-space-between">
      <b-button type="is-danger" @click="deleteMovie">Eliminar</b-button>
      <b-button type="is-primary" @click="saveMovie">Guardar</b-button>
    </div>

    <br/>

    <RentHistory :prestamos="movie.prestamos || []" :movie-id="movieId" :disponible="movie.disponible" />
  </div>
</template>

<script>
import EditMovieForm from "@/components/EditMovieForm.vue";
import RentHistory from "@/components/RentHistory.vue";
import { movies, topicos } from "@/service/services";

export default {
  name: "SingleMovieView",
  components: {
    EditMovieForm,
    RentHistory
  },
  create() {
    this.$watch(
        () => this.$route.params.id,
        () => {
          this.loadMovie();
        }
    )
  },
  data() {
    return {
      movie: {},
      topicos: [],
      loading: true,
    };
  },
  computed: {
    movieId() {
      return this.$route.params.id;
    },
  },
  async mounted() {
    await this.loadMovie();
  },
  methods: {
    async loadMovie() {
      try {
        this.movie = await movies.getMovie(this.$route.params.id);

        this.topicos = [this.movie.topico];

        this.topicos = await topicos.getTopicos();
      } catch (e) {
        console.error(e);
      } finally {
        this.loading = false;
      }
    },
    async saveMovie() {
      try {
        console.log(JSON.stringify(this.movie));
        await movies.updateMovie(this.movie.id, this.movie);

        this.$buefy.notification.open({
          message: "Película guardada!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al guardar la película`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    },
    deleteMovie() {
      this.$buefy.dialog.confirm({
        title: 'Eliminando película',
        message: '¿Seguro que deseas eliminar esta película?',
        confirmText: 'Sí, eliminar',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => this.actuallyDeleteMovie()
      })
    },
    async actuallyDeleteMovie() {
      try {
        await movies.deleteMovie(this.movie.id);

        this.$router.push({ path: `/peliculas` });

        this.$buefy.notification.open({
          message: "Película eliminada!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al eliminar la película`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    }
  },
};
</script>

<style>
.submit-container {
  margin-block: 2rem;
}
</style>
