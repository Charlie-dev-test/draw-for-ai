<template>
  <component :is="layout">
    <router-view/>
  </component>
</template>
<script>
  import ruMessages from 'devextreme/localization/messages/ru.json';
  import { locale, loadMessages} from 'devextreme/localization';
  import authService from "./services/auth.service";
  import offerServices from "./services/offer.service";
  export default {
    computed: {
      layout() {
        let layoutName = this.$route.meta.layout || "Default";
        if(authService.isLoggedIn() && authService.getStatus() === '2'){
            layoutName = "Identified";
        }
        if(authService.isLoggedIn() && authService.getStatus() === '0'){
          layoutName = "NotChecked";
        }
        if(authService.isLoggedIn() && authService.getStatus() === '1'){
          layoutName = "NotChecked";
        }
        return () => import(`@/layouts/${layoutName}.vue`)
      }
    },
    created() {
      loadMessages(ruMessages);
      locale('ru');
    },
    async  mounted() {
      await offerServices.getActiveOfferToken();
      //интервал минута 60000
      setInterval(this.checkOffer, 120000);
    },
    methods: {
      async checkOffer(){
        await offerServices.getActiveOfferToken();
      }
    }
  }
</script>

<style lang="scss">
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }

  #nav {
    padding: 30px;
  }

  #nav a {
    font-weight: bold;
    color: #2c3e50;
  }

  #nav a.router-link-exact-active {
    color: #42b983;
  }
</style>
