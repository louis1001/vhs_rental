<template>
  <div class="single-client">
    <b-loading
      :is-full-page="false"
      v-model="loading"
      :can-cancel="true"
    ></b-loading>
    <h1>Editar cliente</h1>
    <EditClientForm v-model:="client" />
    <div class="submit-container container is-flex is-justify-content-space-between">
      <b-button type="is-danger" @click="deleteClient">Eliminar</b-button>
      <b-button type="is-primary" @click="saveClient">Guardar</b-button>
    </div>
  </div>
</template>

<script>
import EditClientForm from "@/components/EditClientForm.vue";
import { clients } from "@/service/services";

export default {
  name: "SingleMovieView",
  components: {
    EditClientForm,
  },
  data() {
    return {
      client: {},
      loading: true,
    };
  },
  async mounted() {
    const clientId = this.$route.params.id;
    try {
      this.client = await clients.getClient(clientId);
    } catch (e) {
      console.error(e);
      this.$buefy.notification.open({
        duration: 3000,
        message: `No se encontró el cliente con id "${clientId}"`,
        position: "is-bottom-right",
        type: "is-danger",
        hasIcon: false,
      });

      this.$router.push({ path: "/clientes" });
    } finally {
      this.loading = false;
    }
  },
  methods: {
    async saveClient() {
      try {
        console.log(JSON.stringify(this.client));
        await clients.updateClient(this.client.id, this.client);

        this.$buefy.notification.open({
          message: "Cliente guardado!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al guardar el cliente`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    },
    deleteClient() {
      this.$buefy.dialog.confirm({
        title: 'Eliminando cliente',
        message: '¿Seguro que deseas eliminar este cliente?',
        confirmText: 'Sí, eliminar',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => this.actuallyDeleteClient()
      })
    },
    async actuallyDeleteClient() {
      try {
        await clients.deleteClient(this.client.id);

        this.$router.push({ path: `/clientes` });

        this.$buefy.notification.open({
          message: "Cliente eliminado!",
          type: "is-success",
        });
      } catch (e) {
        this.$buefy.notification.open({
          duration: 5000,
          message: `Error al eliminar el cliente`,
          position: "is-bottom-right",
          type: "is-danger",
          hasIcon: false,
        });
        console.error(e);
      }
    },
  },
};
</script>

<style>
.submit-container {
  margin-block: 2rem;
}
</style>
