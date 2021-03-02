<template>
  <div>
    <DashboardHeader />
    <router-view></router-view>
  </div>
</template>

<script>
import DashboardHeader from '@/components/dashboard/Header';

export default {
  components: {
    DashboardHeader,
  },
}
</script>
