const {mix} = require('laravel-mix');


/***************************************************************
* Arquivo   : webpack.mix.js
* Descrição : Configurações para migração do vuetify para o v2.0
*              alteraçõs do WEBPACK.CONFIG via mix
*
* Criado por: Alóis Rothermel Júnior                           
* Alterações:
*   [ 05/06/2019 ] [v.: 1.0.0] - Criação inicial             
****************************************************************/
// mix.webpackConfig({
//     resolve: {
//         modules: [
//             'node_modules',
//             path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
//         ]
//     }
// });

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.LoaderOptionsPlugin({
                rules: [
                    {
                        test: /\.s(c|a)ss$/,
                        use: [
                            'vue-style-loader',
                            'css-loader',
                            {
                                loader: 'sass-loader',
                                options: {
                                    implementation: require('sass'),
                                    fiber: require('fibers'),
                                    indentedSyntax: true // optional
                                }
                            }
                        ]
                    }
                ]
            })
        ]
    };
});


//
// mix.webpackConfig(webpack => {
//     return {
//         plugins: [
//             new webpack.ProvidePlugin({
//                 $: 'jquery',
//                 jQuery: 'jquery',
//                 'window.jQuery': 'jquery'
//             })
//         ]
//     };
// });
/***************************************************************/


/***************************************************************
 * Rotina    : Componentes Backend
 * Descrição : Insira descrição da rotina
 * Criado por: Alóis Rothermel Júnior
 * Alterações:
 *   [ 15/12/2018 ] [v.: 1.0.0] - Criação inicial
 ****************************************************************/
mix
    .sass('resources/assets/_backend/scss/app_backend.scss', 'public/_backend/css')
    .combine(['resources/assets/_backend/css/style.css',
            'resources/assets/_backend/css/custom.css',],
        'public/_backend/css/custom_backend.css')

    .js('resources/assets/start_js/main_backend.js', 'public/_backend/js')


    /***************************************************************
     * Rotina    : Componentes FrontEnd
     * Descrição : Insira descrição da rotina
     * Criado por: Alóis Rothermel Júnior
     * Alterações:
     *   [ 15/12/2018 ] [v.: 1.0.0] - Criação inicial
     ****************************************************************/

    .sass('resources/assets/_frontend/scss/app_frontend.scss', 'public/_frontend/css')
    .combine(['resources/assets/_frontend/css/essentials.css',
            'resources/assets/_frontend/css/header-1.css',
            'resources/assets/_frontend/css/layout.css',
            // 'resources/assets/_frontend/css/layout-dark.css',
            'resources/assets/_frontend/css/orange.css',
            'resources/assets/_frontend/css/aton_custom.css'],
        'public/_frontend/css/custom_frontend.css')
    .combine(['resources/assets/_frontend/css/essentials.css',
        'resources/assets/_frontend/css/header-1.css',
        'resources/assets/_frontend/css/layout.css',
        'resources/assets/_frontend/css/orange.css',
        'resources/assets/_frontend/css/aton_landing.css'
    ], 'public/_frontend/css/custom_landing.css')
    .js('resources/assets/start_js/main_frontend.js', 'public/_frontend/js')


    /***************************************************************
     * Rotina    : JS de suporte ao login, e manifest
     * Descrição : Insira descrição da rotina
     * Criado por: Alóis Rothermel Júnior
     * Alterações:
     *   [ 15/12/2018 ] [v.: 1.0.0] - Criação inicial
     ****************************************************************/

    .js('resources/assets/start_js/main_backend_init.js', 'public/_backend/js/authInit.js') // main JS para o login e registro

    // o manifest e arquivo de vendor é sempre gerado no ultimo artido
    .extract(['jquery',
        'lodash',
        'vue',
        'vuetify',
        'tether',
        // 'dropzone',
        'vue2-dropzone',
        'vue-froala-wysiwyg',
        'vue-grid-layout',
        'vue-chartist',
        'chartist-plugin-tooltips',
        'vue-html2canvas',
        'vue-lottie',
        'vue-masked-input',
    ]);

if (mix.inProduction()) {
    mix.version();
}

// mix.browserSync('atonmidia.local');


// comentado em DEV
// mix.copy('resources/assets/_frontend/js_template/plugins', 'public/_frontend/js/plugins');
//
// // assets de usp comum
// mix.copy('resources/assets/img', 'public/img');
// mix.copy('resources/assets/fonts', 'public/fonts');



