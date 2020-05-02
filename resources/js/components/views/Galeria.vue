<template>
    <div class="animated fadeIn">
        <div class="sub_header bg_4">
        	<div id="intro_txt">
			<h1>Atena campus <strong>Gallery</strong></h1>
            <p>Ex saepe accusata duo, vel ne summo option delenit.</p>
            </div>
		</div> <!--End sub_header -->

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Galeria</a></li>
                    <li>Página activa</li>
                </ul>
            </div>
        </div><!-- Position -->

        <div class="galeria">
            	<div class="container margin_60">
	<section class="grid">
            <div class="main_title">
                <h2 class="titulo-seccion">Nuestras fotos</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                </div>
                <div class="container">
                    	<div class="row">
					<ul class="magnific-gallery">
						<li>
							<figure>
								<img src="img/gallery/pic_4.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_4.jpg" title="Photo title" data-effect="mfp-move-horizontal">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
								</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_5.jpg" alt="">
								<figcaption>
								<div class="caption-content">
                                    	<a href="img/gallery/large/pic_5.jpg" title="Photo title" data-effect="mfp-move-horizontal">
                                        <i class="pe-7s-albums"></i>
										<p>Your caption</p>
									   </a>
								</div>

								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_6.jpg" alt="">
								<figcaption>
								<div class="caption-content">
										<a href="img/gallery/large/pic_6.jpg" title="Photo title" data-effect="mfp-move-horizontal">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_7.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_7.jpg" title="Photo title">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
					</ul>
				</div>
                </div>
				<div class="container">
                    <div class="row">
					<ul class="magnific-gallery">
						<li>
							<figure>
								<img src="img/gallery/pic_8.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_8.jpg" title="Photo title">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_9.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_9.jpg" title="Photo title">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_10.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_10.jpg" title="Photo title">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_11.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="img/gallery/large/pic_1.jpg" title="Photo title">
										<i class="pe-7s-albums"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
					</ul>
				</div>
                </div>
		</section>

        <section class="grid">
			<div class="container margin_60">
            <div class="main_title">
                <h2 class="titulo-seccion">Nuestros videos</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                </div>
                	<div class="row">
					<ul class="magnific-gallery">
						<li>
							<figure>
								<img src="img/gallery/pic_2.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="https://vimeo.com/45830194" class="video_pop" title="Video Vimeo">
										<i class="pe-7s-film"></i>
										<p>Your caption</p>
								</a>
								</div>
								</figcaption>
							</figure>
						</li>

						<li>
							<figure>
								<img src="img/gallery/pic_13.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									 <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video_pop" title="Video Youtube">
										<i class="pe-7s-film"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/pic_4.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="https://vimeo.com/45830194" class="video_pop" title="Video Vimeo">
										<i class="pe-7s-film"></i>
										<p>Your caption</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
					</ul>
				</div>
			</div>
		</section>
        	</div>
        </div>

                <ScrollUp :scroll-duration="1000" />
    </div>
</template>
<script>
import ScrollUp from 'vue-scroll-up';
import "vue-scroll-up/dist/style.css";
export default {
    components:{
        ScrollUp
    },
    mounted() {
        this.cargarDoom();
    },
    methods: {
        cargarDoom(){
          $('.video_pop').magnificPopup({type:'iframe'});	/* video modal*/
/* Gallery images modal*/
$('.magnific-gallery').each(function() {
    $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery:{enabled:true},
		removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
      // just a hack that adds mfp-anim class to markup
       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  closeOnContentClick: true,
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });
});
        }
    },
}
</script>
