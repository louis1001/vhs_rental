<template>
  <div class="clients">
    <h1>Clientes</h1>

    <div style="text-align: left" class="container">
      <b-button type="is-primary" @click="goToNuevo">Agregar</b-button>
    </div>
    <b-table
      :loading="loading"
      :data="clients"
    >
      <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
        {{ props.row.id }}
      </b-table-column>
      <b-table-column field="nombre" label="Nombre" v-slot="props">
        <router-link :to="`/clientes/${props.row.id}`">
          {{ props.row.nombre }}
        </router-link>
      </b-table-column>

      <b-table-column field="apellido" label="Apellido" v-slot="props">
        {{ props.row.apellido }}
      </b-table-column>

      <b-table-column field="correo" label="Correo" v-slot="props">
        {{ props.row.correo }}
      </b-table-column>

      <b-table-column field="telefono" label="Telefono" v-slot="props">
        {{ props.row.telefono }}
      </b-table-column>
    </b-table>
  </div>
</template>

<script>
import { clients } from "@/service/services";

export default {
  name: "MoviesView",
  data() {
    return {
      clients: [],
      loading: true,
    };
  },
  async mounted() {
    try {
      this.clients = await clients.getClients();
      console.log(this.clients);
    } catch (e) {
      console.error(e);
    } finally {
      this.loading = false;
    }
  },
  methods: {
    goToNuevo() {
      this.$router.push({ path: "/clientes/nuevo" });
    },
  },
};
</script>
