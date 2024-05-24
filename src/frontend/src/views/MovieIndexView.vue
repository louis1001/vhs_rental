<template>
  <div class="movies">
    <h1>Películas</h1>

    <div style="text-align: left" class="container">
      <b-button type="is-primary" @click="goToNueva">Agregar</b-button>
    </div>
    <b-table
      :loading="loading"
      :data="movies"
    >
      <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
        {{ props.row.id }}
      </b-table-column>

      <b-table-column searchable field="titulo" label="Titulo" v-slot="props">
        <router-link :to="`/peliculas/${props.row.id}`">
          {{ props.row.titulo }}
        </router-link>
      </b-table-column>

      <b-table-column searchable field="resumen" label="Resumen" v-slot="props">
        {{
          props.row.resumen.length > 60
            ? props.row.resumen.substring(0, 60) + "..."
            : props.row.resumen
        }}
      </b-table-column>

      <b-table-column searchable field="anio" label="Año" v-slot="props">
        {{ props.row.anio }}
      </b-table-column>

      <b-table-column searchable field="topico" label="Tópico" v-slot="props">
        {{ props.row.topico.nombre }}
      </b-table-column>

      <b-table-column
        field="disponible"
        label="Disponible"
        v-slot="props"
      >
        {{ props.row.disponible ? "Sí" : "No" }}
      </b-table-column>
    </b-table>
  </div>
</template>

<script>
import { movies } from "@/service/services";

export default {
  name: "MoviesView",
  data() {
    return {
      movies: [],
      loading: true,
    };
  },
  async mounted() {
    try {
      const clientItems = await movies.getMovies();

      this.movies = clientItems;
      console.log(clientItems);
    } catch (e) {
      console.error(e);
    } finally {
      this.loading = false;
    }
  },
  methods: {
    goToNueva() {
      this.$router.push({ path: "/peliculas/nueva" });
    },
  },
};
</script>
