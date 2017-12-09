
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import tinymce from 'vue-tinymce-editor';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('tinymce', tinymce);

Vue.component('example', require('./components/Example.vue'));

Vue.component('template-component', require('./components/Templates.vue'));
Vue.component('template-edit', require('./components/TemplateEdit.vue'));
Vue.component('template-create', require('./components/TemplateCreate.vue'));
Vue.component('qualificacao-component', require('./components/QualificacaoComponent.vue'));

const app = new Vue({
    el: '#app'
});
