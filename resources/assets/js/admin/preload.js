try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
    require('../vendor/materialize/bin/materialize.min.js');
} catch (e) {}
