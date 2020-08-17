import Vue from 'vue';
// import 'chartist/dist/chartist.css';
// import chartist_tooltip from 'chartist-plugin-tooltips';
import * as ChartistTooltips from 'chartist-plugin-tooltips';

Vue.use(require('vue-chartist'), {
    plugins: [ChartistTooltips],
});

// Vue.use(require('vue-chartist'));

