/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import indexComponent from "./components/indexComponent";

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue';
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";

import Vuetify from "vuetify";

Vue.use(Vuetify);
import VueRouter from 'vue-router';
import cardCmponent from "./components/cardCmponent";
import CardCheckoutCompoent from "./components/CardCheckoutCompoent";
import Flutterwave from 'vue-flutterwave';
import previewcardComponent from "./components/previewcardComponent";

Vue.use(Flutterwave, { publicKey: 'FLWPUBK_TEST-4105a671a4bcb87e63bec80792b076f3-X' });


Vue.use(VueRouter);
const routes = [
    { path: '/', component: indexComponent },
    { path: '/buycard', component: cardCmponent },
    { path: '/checkoutcard/:id', component: CardCheckoutCompoent },
    { path: '/previewcard/:id', component: previewcardComponent },
];

const router = new VueRouter({
    routes,
    mode:'history'
});

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,

    data(){
        return{
            count: 0
        }
    }
});