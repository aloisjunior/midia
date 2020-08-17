const SET_USER = 'SET_USER';
const SET_USER_CONFIG = 'SET_USER_CONFIG';
const GET_USER = 'GET_USER';

const AuthModule = {
    state() {
        return {
            userAtivo: {
                ativo: 1,
                config: {
                    players_tempo_notifica: 0,
                    tema_formularios: 'Escuro',
                    tema_fundo: 'Claro',

                    primaryColorModel: {
                        text: 'green',
                        value: '#4caf50',
                    },
                    secundaryColorModel: {
                        text: 'blue-grey darken-1',
                        value: '#546E7A',
                    },
                },
                created_at: "",
                email: "",
                email_verified_at: "",
                first_name: "",
                id: 1,
                name: "",
                password_md5: "",
                updated_at: "",
            },
        }
    },

    mutations: {
        [SET_USER](state, user) {
            state.userAtivo = user;
        },
        [SET_USER_CONFIG](state, config) {
            state.userAtivo.config = config;
        },
        [GET_USER](state) {
            return state.userAtivo;
        },
    },

    getters: {
        getUser: state => {
            return state.userAtivo;
        },
        isDarkForm: state => {
            return ((state.userAtivo != null) && (state.userAtivo.config.tema_formularios == 'Escuro'))
                || false;
        },
        isLightForm: state => {
            return ((state.userAtivo != null) && (state.userAtivo.config.tema_formularios != 'Escuro'))
                || false;
        },
        isDarkBG: state => {
            return ((state.userAtivo != null) && (state.userAtivo.config.tema_fundo == 'Escuro'))
                || false;
        },
        isLightBG: state => {
            return ((state.userAtivo != null) && (state.userAtivo.config.tema_fundo != 'Escuro'))
                || false;
        },


    },

    actions: {
        SetUser({commit}, user) {
            commit(SET_USER, user)
        },

        SetUserConfig({commit}, config) {
            commit(SET_USER_CONFIG, config)
        }
    }
};

export default AuthModule;