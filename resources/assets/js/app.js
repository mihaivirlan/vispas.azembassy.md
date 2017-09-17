// require('vue-resource');
require("babel-polyfill");

window.Vue = require('vue');

// import VueResource from 'vue-resource';
// window.Vue.use(VueResource);

import VeeValidate from 'vee-validate';
window.Vue.use(VeeValidate);

// import VueYouTubeEmbed from 'vue-youtube-embed'
// Vue.use(VueYouTubeEmbed)

window.$ = window.jQuery = require('jquery');

// window.velocity = require('velocity-animate');

var loadTouchEvents = require('jquery-touch-events');
loadTouchEvents($);

require('viewport-units-buggyfill').init();

require('lightbox2');

require('slick-carousel');

require('./plugin');





