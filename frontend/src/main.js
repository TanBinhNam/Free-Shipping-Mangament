import { createApp } from 'vue'

import App from './App.vue'


import VueAxios from 'vue-axios'
import axios from 'axios'
import router from './router'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";


import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

import './assets/main.css'
import './assets/bootstrap.min.css'
import './assets/style.min.css'

const app = createApp(App)
app.use(router, axios, VueAxios)
app.use(VueSweetalert2)
app.use(Toast)
app.component('Datepicker', Datepicker)
app.component('v-select', vSelect)
app.mount('#app')