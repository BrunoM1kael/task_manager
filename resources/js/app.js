import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { createApp } from 'vue';
import App from './App.vue'; // Importando o componente Vue principal

// Cria a aplicação Vue e a monta no elemento com id "app"
createApp(App).mount('#app');
