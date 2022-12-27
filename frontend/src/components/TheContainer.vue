<template>
<div class="main-header">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <img src="http://gbm-stg.webike.net/sm-new/img/logo.png" width="30" height="30" alt="">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div style="margin-left: auto;">
     
    </div>
</nav>
</div>

<div class="content-wrapper" >
  <router-view></router-view>
</div>

</template>

<script>

    export default {

    data() {
       return {

       }
   },
   created() {

   },
   computed: {

    },
   methods: {


   }
}
</script>