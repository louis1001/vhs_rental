import { createApp } from "vue";

import Buefy from "buefy";
import "buefy/dist/buefy.css";

import App from "./App.vue";
import router from "./router";
import store from "./store";

createApp(App).use(store).use(router).use(Buefy).mount("#app");
