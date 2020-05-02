<template >

  <div class="content-wrapper">


      <div class="content">

        <h1 class="text-center mb-3 text-info text-uppercase text-bold">Administración restaurante LOS ÁNGELES</h1>

            <img src="img/redes/logo.png"  class=" portada" style="box-shadow:5px 5px 25px black;max-width:100%" width="900px">

      </div>




</div>


</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style >
    .portada{
        display: block!important;
        margin: 0 auto!important;
        transition: all .5s ease-in-out;

    }
    .portada:hover{
        transform:rotatey(30deg)!important;
        transform:rotateZ(30deg)!important;

        transform:scale(1.1)!important;

    }
</style>
