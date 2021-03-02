<template>
  <AuthHeader>
    <router-view></router-view>
  </AuthHeader>
</template>

<script>
import AuthHeader from '@/layouts/auth.vue';

export default {
  components: {
    AuthHeader,
  },
  created() {
    console.log('sds');
  }
}
</script>
