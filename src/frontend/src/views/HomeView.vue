<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" />
  </div>
</template>

<script>
// @ is an alias to /src
import { topicos } from "@/service/services";

export default {
  name: "HomeView",
  data() {
    return {
      loading: true,
    };
  },
  async mounted() {
    try {
      const clientItems = await topicos.getTopicos();
      console.log(clientItems);
    } catch (e) {
      console.error(e);
    } finally {
      this.loading = false;
    }
  },
};
</script>
