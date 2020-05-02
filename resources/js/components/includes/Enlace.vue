<template>
      <div class="container_gray_bg" id="home_feat_1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="home_feat_1_box">
                        <router-link :to="{name:'about'}">
                            <img src="img/gallery/nosotros.png" class="img-responsive" alt="">
                            <div class="short_info"><h3>Nosotros</h3><i class="arrow_carrot-right_alt2"></i></div>
                        </router-link>




                        </div>
                </div>
                <div class="col-md-4 col-sm-4">
            <div class="home_feat_1_box">
                           <router-link :to="{name:'nuestra-carta'}">
                                <img src="img/gallery/carta.png" class="img-responsive" alt="">
                                <div class="short_info"><h3>Nuestra Carta</h3><i class="arrow_carrot-right_alt2"></i></div>
                            </router-link>
                        </div>
                </div>
                <div class="col-md-4 col-sm-4">
            <div class="home_feat_1_box">
                            <router-link :to="{name:'galeria'}">
                            <img src="img/gallery/bg_galeria.png" class="img-responsive" alt="">
                            <div class="short_info"><h3>Galeria de Fotos</h3><i class="arrow_carrot-right_alt2"></i></div>
                            </router-link>
                        </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </div><!-- End container_gray_bg -->
</template>

<script>
    export default {

    }
</script>
