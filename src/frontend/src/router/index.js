import { createRouter, createWebHashHistory } from "vue-router";

const routes = [
  {
    path: "/",
    redirect: "/peliculas"
  },
  {
    path: "/peliculas",
    name: "peliculas",
    component: function () {
      return import(
        /* webpackChunkName: "peliculas" */ "../views/MovieIndexView.vue"
      );
    },
  },
  {
    path: "/peliculas/nueva",
    name: "nueva_pelicula",
    component: function () {
      return import(
        /* webpackChunkName: "nueva_pelicula" */ "../views/AddMovieView.vue"
      );
    },
  },
  {
    path: "/peliculas/:id",
    name: "pelicula",
    component: function () {
      return import(
        /* webpackChunkName: "pelicula" */ "../views/SingleMovieView.vue"
      );
    },
  },
  {
    path: "/clientes",
    name: "clientes",
    component: function () {
      return import(
        /* webpackChunkName: "clientes" */ "../views/ClientIndexView.vue"
      );
    },
  },
  {
    path: "/clientes/nuevo",
    name: "nuevo_cliente",
    component: function () {
      return import(
        /* webpackChunkName: "nueva_pelicula" */ "../views/AddClientView.vue"
      );
    },
  },
  {
    path: "/clientes/:id",
    name: "cliente",
    component: function () {
      return import(
        /* webpackChunkName: "pelicula" */ "../views/SingleClientView.vue"
      );
    },
  },
  {
    path: "/prestamos/nuevo/:movieId?",
    name: "nuevo_prestamo",
    component: function () {
      return import(
        /* webpackChunkName: "prestamos" */ "../views/NewRentView.vue"
        );
    },
  }
  // {
  //   path: "/about",
  //   name: "about",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: function () {
  //     return import(/* webpackChunkName: "about" */ "../views/AboutView.vue");
  //   },
  // },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
