import Vue from "vue";
import VueRouter from "vue-router";
import App from "./App.vue";
import store from "./store/index";
import { routes } from "./routes";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHatWizard,
    faPlus,
    faTrashAlt,
    faTimes,
    faPen,
    faSave,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import VModal from "vue-js-modal/dist/index.nocss.js";
import "vue-js-modal/dist/styles.css";
import Vuex from "vuex";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

Vue.use(VueToast);
Vue.use(VueSweetalert2);
window.Vue = require("vue").default;
require("./bootstrap");
require("../sass/app.scss");
library.add(faHatWizard, faPlus, faTrashAlt, faTimes, faPen, faSave);
Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.use(VueRouter);
Vue.use(VModal);
Vue.use(Vuex);
Vue.use(require("vue-moment"));

const router = new VueRouter({
    mode: "history",
    routes,
});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    store,
});
