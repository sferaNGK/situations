import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap"
const app = createApp(App)

export const link = 'http://192.168.10.124:8000';

app.use(router)

app.mount('#app')
