// https://vuex.vuejs.org/en/getters.html

export default {
  getters: {
      isBackground_Dark: (state, getters) => {
          return getters.background_dark ===true;
      },
      isBackground_Light: (state, getters) => {
          return getters.background_light ===true;
      },

      isForm_Dark: (state, getters) => {
          return getters.form_dark ===true;
      },
      isForm_Light: (state, getters) => {
          return getters.form_light ===true;
      },

      getUserAtivo: (state, getters) => {
          return getters.userAtivo;
      },

  },
}
