try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
    require('../vendor/slick.min.js');
    require('../vendor/materialize/bin/materialize.min.js');
} catch (e) {}

window.axios = require('axios');
