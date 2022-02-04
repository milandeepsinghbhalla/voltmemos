import Vue from "vue";

import testcomponent from './vue-components/testcomponent.vue';
import Editor from 'vue-editor-js/src/index'

Vue.use(Editor);

const app = new Vue({
    el: '#app',
    components: {
        testcomponent: testcomponent
    }
})
