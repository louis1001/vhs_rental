<template>
  <div>
    <h1>Nuevo Prestamo</h1>

    <div id="edit-form" class="container edit-movie-form">
      <b-field label="Película">
        <b-select
            placeholder="Selecciona una"
            v-model:="prestamo.pelicula"
            required
        >
          <option v-for="option in peliculas" :value="option" :key="option.id">
            {{ option.titulo }}
          </option>
        </b-select>
      </b-field>

      <b-field label="Cliente">
        <b-select
            placeholder="Selecciona uno"
            v-model:="prestamo.cliente"
            required
        >
          <option v-for="option in clientes" :value="option" :key="option.id">
            {{ `${option.nombre} ${option.apellido}` }}
          </option>
        </b-select>
      </b-field>

      <b-field label="Fecha de prestamo">
        <b-datepicker
            v-model:="prestamo.fecha_prestamo"
            required
        ></b-datepicker>
      </b-field>
    </div>

    <div class="submit-container container is-flex is-justify-content-space-between">
      <b-button type="is-danger" @click="discard">Descartar</b-button>
      <b-button type="is-primary" @click="saveRent">Guardar</b-button>
    </div>
  </div>
</template>

<script>
import { movies, clients, rents } from "@/service/services";

export default {
  name: 'NewRentView',
  data() {
    return {
      peliculas: [],
      clientes: [],
      prestamo: {
        fecha_prestamo: new Date(),
        fecha_devolucion: null,
        cliente: null,
        pelicula: {id: this.$route.params.movieId},
      }
    };
  },
  async mounted() {
    await this.loadMovies();
    await this.loadClients();
  },
  methods: {
    async loadMovies() {
      try {
        this.peliculas = await movies.getMovies();
      } catch (e) {
        console.error(e);
      }
    },
    async loadClients() {
      try {
        this.clientes = await clients.getClients();
      } catch (e) {
        console.error(e);
      }
    },
    discard() {
      this.$router.push({ name: 'peliculas' });
    },
    async saveRent() {
      try {
        const peliculaId = this.prestamo.pelicula.id;
        const clienteId = this.prestamo.cliente.id;

        if (!peliculaId || !clienteId) {
          throw new Error('Faltan datos');
        }

        const actualData = {
          pelicula_prestada_id: peliculaId,
          cliente_prestando_id: clienteId,
          // Date format: '2024-05-24 07:43:23'
          fecha_prestamo: this.prestamo.fecha_prestamo.toISOString().slice(0, 19).replace('T', ' '),
        }

        await rents.saveRent(actualData);
        this.$router.push({ name: 'peliculas' });
      } catch (e) {
        console.error(e);
      }
    }
  }
};
</script>