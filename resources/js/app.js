import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler'
import App from './vue/App.vue';
import VueAxios from 'vue-axios';
import axios from "axios";
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content
axios.defaults.baseURL = window.origin

const app = createApp(App);
app.use(VueAxios, axios).mount('#app');
