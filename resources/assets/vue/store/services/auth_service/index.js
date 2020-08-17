import store from '../../store'

//mudando o valor do token diretamente na store!
export const setUser = function(user) {
    store.dispatch(SET_USER, user)
};
//recuperando o valor de token da store!
export const getUser = function() {
    return store.state.user_ativo;
};

