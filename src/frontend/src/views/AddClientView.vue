<template>
  <div class="single-client">
    <b-loading
      :is-full-page="false"
      v-model="loading"
      :can-cancel="true"
    ></b-loading>
    <h1>Nuevo cliente</h1>
    <EditClientForm v-model:="client" />
    <div class="submit-container container is-flex is-justify-content-space-between">
      <b-button type="is-danger" @click="cancelarCreacion">Descartar</b-button>
      <b-button type="is-primary" @click="saveClient">Guardar</b-button>
    </div>
  </div>
</template>

<script>
import EditClientForm from "@/components/EditClientForm.vue";
import { clients } from "@/service/services";

export default {
  name: "AddClientView",
  components: {
    EditClientForm,
  },
  data() {
    return {
      client: {
        nombre: "",
        apellido: "",
        correo: "",
        telefono: "",
      },
      loading: true,
    };
  },
  mounted() {
    this.loading = false;
  },
  methods: {
    async saveClient() {
      try {
        await clients.createClient(this.client);

        this.$router.push({ path: `/clientes` });

        this.$buefy.notification.open({
          message: "Cliente creado!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al crear el cliente`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    },
    cancelarCreacion() {
      this.$router.push({ path: `/clientes` });
    },
  },
};
</script>

<style>
.submit-container {
  margin-block: 2rem;
}
</style>
