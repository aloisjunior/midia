/**
 * Vuex
 *
 * @library
 *
 * https://vuex.vuejs.org/en/
 */

// Lib imports
import Vue from 'vue';
import Vuex from 'vuex';

// Store functionality
// import actions from './actions';
// import getters from './getters';
// import modules from './modules'
import AuthModule from './auth';
import AppModule from './app';

Vue.use(Vuex);

// Create a new store
const store = new Vuex.Store({
    // actions,
    // getters,
    modules: {
        auth: AuthModule,
        app: AppModule
    },
    // mutations,
    // state
});

export default store;
