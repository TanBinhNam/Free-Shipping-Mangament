<template>

<router-view ></router-view>

<TheFooter></TheFooter>
</template>

<script>
import TheFooter from './components/TheFooter.vue'

 export default {
  components: {
    TheFooter
  }
 }
</script>
