import store from '../../store'

//mudando o valor do token diretamente na store!
const setThemeBg = function(theme) {
    store.dispatch(SET_THEME_BG, theme)
};
//recuperando o valor de token da store!
const getThemeBg = function() {
    return store.state.theme_bg;
};

const setThemeForms = function(theme) {
    store.dispatch(SET_THEME_FORMS, theme)
};
//recuperando o valor de token da store!
const getThemeForms = function() {
    return store.state.theme_forms;
};

