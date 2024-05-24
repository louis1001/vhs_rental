<template>
  <HeaderComponent />
  <main>
    <router-view />
  </main>
</template>

<script>
import HeaderComponent from "@/components/HeaderComponent.vue";

export default {
  name: "App",
  components: {
    HeaderComponent,
  },
};
</script>

<style lang="sass">
main
  padding-inline: 2rem
  max-width: 1000px
  margin: 0 auto

h1
  text-align: center
  font-size: 2rem
  font-weight: bolder
  margin-block: 1em
</style>
