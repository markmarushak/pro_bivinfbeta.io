
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

const option = require('./socket-option.js')
// var fs = require('fs')
io = require('socket.io-client')

window.socket = io(':6001', option);

// window.socket = io.connect(location.host, {secure: true, port: '6001'})
// window.socket = io(':300')
// window.socket = io('http://in-touch.ooo/:6001')
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example', require('./components/Example.vue').default);
// Vue.component('groups', require('./components/Groups.vue').default);
// Vue.component('create-group', require('./components/CreateGroup.vue').default);
// Vue.component('group-chat', require('./components/GroupChat.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
