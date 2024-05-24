<template>
  <div id="edit-form" class="container edit-movie-form">
    <b-field label="Titulo">
      <b-input
        :modelValue="modelValue.titulo"
        @update:modelValue="updateTitulo"
        required
      ></b-input>
    </b-field>

    <b-field label="Resumen">
      <b-input
        type="textarea"
        :modelValue="modelValue.resumen"
        @update:modelValue="updateResumen"
      ></b-input>
    </b-field>

    <b-field label="Tópico">
      <b-select
        placeholder="Selecciona uno"
        :modelValue="modelValue.topico"
        @update:modelValue="updateTopico"
        required
      >
        <option v-for="option in topicos" :value="option" :key="option.id">
          {{ option.nombre }}
        </option>
      </b-select>
    </b-field>

    <b-field label="Año">
      <b-numberinput
        :modelValue="modelValue.anio"
        @update:modelValue="updateAnio"
        min="1888"
        max="2060"
        controls-alignment="left"
        controls-position="compact"
      ></b-numberinput>
    </b-field>

    <b-field>
      <b-checkbox
        :modelValue="modelValue.disponible"
        @update:modelValue="updateDisponible"
        >Disponible</b-checkbox
      >
    </b-field>
  </div>
</template>
<script>
export default {
  props: ["modelValue", "topicos"],
  emits: ["update:modelValue"],
  methods: {
    sendUpdate(name, value) {
      let result = { ...this.modelValue };
      result[name] = value;
      this.$emit("update:modelValue", result);
    },
    updateTitulo(value) {
      this.sendUpdate("titulo", value);
    },
    updateResumen(value) {
      this.sendUpdate("resumen", value);
    },
    updateTopico(value) {
      this.sendUpdate("topico", value);
    },
    updateAnio(value) {
      this.sendUpdate("anio", value);
    },
    updateDisponible(value) {
      this.sendUpdate("disponible", value);
    },
  },
};
</script>
