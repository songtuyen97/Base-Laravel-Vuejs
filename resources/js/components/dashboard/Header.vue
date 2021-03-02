<template>
  <div class="header__container">
    {{ $t('work_order.title') }}
    <v-btn @click="onToggleLanguage">
      proclick
    </v-btn>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  data() {
    return {
      initLocale: true,
    }
  },
  methods: {
    ...mapActions('lang', ['setLocale']),

    onToggleLanguage() {
      if (this.initLocale) {
        this.setLocale('jp');
      } else {
        this.setLocale('en');
      }

      this.initLocale = !this.initLocale;
    },
  } 
}
</script>
