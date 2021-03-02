<template>
  <DashboardLayout>
    <router-view></router-view>
  </DashboardLayout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import DashboardLayout from  '@/layouts/dashboard';

export default {
  components: {
    DashboardLayout,
  },
  computed: {
    ...mapGetters('wellcome', ['initValue']),
  },
  methods: {
    ...mapActions('wellcome', ['setInitValue'])
  },
  created() {
  },
}
</script>
