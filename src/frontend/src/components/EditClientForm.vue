<template>
  <div id="edit-form" class="container edit-movie-form">
    <b-field label="Nombre">
      <b-input
        :modelValue="modelValue.nombre"
        @update:modelValue="updateNombre"
        required
      ></b-input>
    </b-field>

    <b-field label="Apellido">
      <b-input
        :modelValue="modelValue.apellido"
        @update:modelValue="updateApellido"
        required
      ></b-input>
    </b-field>

    <b-field label="Correo">
      <b-input
        type="email"
        :modelValue="modelValue.correo"
        @update:modelValue="updateCorreo"
        required
      ></b-input>
    </b-field>

    <b-field label="Teléfono">
      <b-input
        type="tel"
        :modelValue="modelValue.telefono"
        @update:modelValue="updateTelefono"
        required
      ></b-input>
    </b-field>
  </div>
</template>
<script>
export default {
  props: ["modelValue"],
  emits: ["update:modelValue"],
  methods: {
    sendUpdate(name, value) {
      let result = { ...this.modelValue };
      result[name] = value;
      this.$emit("update:modelValue", result);
    },
    updateNombre(value) {
      this.sendUpdate("nombre", value);
    },
    updateApellido(value) {
      this.sendUpdate("apellido", value);
    },
    updateCorreo(value) {
      this.sendUpdate("correo", value);
    },
    updateTelefono(value) {
      this.sendUpdate("telefono", value);
    },
  },
};
</script>
