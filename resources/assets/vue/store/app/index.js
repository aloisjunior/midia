const SET_THEME_BG = 'SET_THEME_BG';
const GET_THEME_BG = 'GET_THEME_BG';
const SET_THEME_FORMS = 'SET_THEME_FORMS';
const GET_THEME_FORMS = 'GET_THEME_FORMS';

const c_dark = 'dark';
const c_light = 'light';

const AppModule = {
    state() {
        return {
            theme_bg: c_dark,
            theme_forms: c_light,
        }
    },

    mutations: {

        [SET_THEME_BG](state, theme_bg) {
            state.theme_bg = theme_bg;
        },
        [GET_THEME_BG](state) {
            return state.theme_bg;
        },
        [SET_THEME_FORMS](state, theme_forms) {
            state.theme_forms = theme_forms;
        },
        [GET_THEME_FORMS](state) {
            return state.theme_forms;
        },
    },

    getters: {
        getThemeBg: state => {
            return state.theme_bg;
        },

        getThemeForms: state => {
            return state.theme_forms;
        }
    },

    actions: {
        SetThemeBg({commit}, theme) {
            commit(SET_THEME_BG, theme)
        },
        SetThemeForms({commit}, theme) {
            commit(SET_THEME_FORMS, theme)
        }
    }

};

export default AppModule;