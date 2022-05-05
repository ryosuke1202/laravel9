import './bootstrap'
import Vue from 'vue'
import CartsOrderNumberInput from './components/CartsOrderNumberInput'
import Modal from './components/Modal'
Vue.config.devtools = true;

const app = new Vue({
  el: '#app',
  components: {
    CartsOrderNumberInput,
    Modal,
  },
})
