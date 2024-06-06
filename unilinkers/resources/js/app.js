/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import { createPinia } from 'pinia';
import 'vuetify/dist/vuetify.min.css';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import vuetify from './vuetify';
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Components
import dashboardComponent from './components/dashboardComponent.vue';

// AlpineJS & ApexCharts are assumed to be initialized elsewhere as they are not Vue plugins

// Routes configuration
const routes = [
    { path: '/', component: dashboardComponent },
];

// Router instance
const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Pinia state management
const pinia = createPinia();

// App instance
const app = createApp(App);

// Use plugins
app.use(router);
app.use(pinia);
app.use(vuetify);


// Global properties
app.config.globalProperties.$http = axios;

// Define components globally if needed
app.component('dashboard-component', dashboardComponent);


app.mount('#app');
