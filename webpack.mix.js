const mix = require('laravel-mix');

mix.js('resources/js/ventas.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/venta-bus.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/venta-asiento.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/venta-modal.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/venta-form.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/encomienda-form.js', 'public/js/dist').vue({version: 2}).extract(['vue']);

mix.js('resources/js/encomiendas.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/buses.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/itinerarios.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
mix.js('resources/js/bus.js', 'public/js/dist').vue({version: 2}).extract(['vue']);
