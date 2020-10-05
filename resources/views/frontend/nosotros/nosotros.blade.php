@extends('frontend.layout')

@section('content')
<section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window" data-parallax="scroll" style=" background-image: url(/frontend/images/nosotros.jpg);background-position: center;background-attachment: fixed;background-repeat: no-repeat; background-size: cover;">
	<div class="xs-solid-overlay xs-bg-black"></div>
	<div class="container">
		<div class="fundpress-inner-welcome-content">
		<h2 class="color-white">{{__('nosotros')}}</h2>
			<ul class="xs-breadcumb fundpress-breadcumb">
			<li><a href="index.html" class="color-white"> Home /</a> {{__('nosotros')}}</li>
			</ul>
		</div>
	</div>
</section>

<section class="xs-about-us-promo-section xs-content-section-padding fundpress-about-us-promo-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-6">
				<div class="fundpress-inner-about-content">
				<h2 class="color-navy-blue">{{__('frase_nosotros')}}</h2>
				<p>{{__('parrafo_nosotros')}}</p>
					<a href="#" class="xs-sign-logo">
						
					</a>
				</div>
				<!--  
					xs-inner-title 
					xs-padding-right 
					fundpress-inner-title 
					xs-equal-height-and-content-center
				-->
			</div>
			<div class="col-md-12 col-lg-6">
				<div class="fundpress-about-promo-image xs-box-shadow">
					<img src="frontend/images/nosotros/nosotros_1.jpg" alt="">
				</div>
				<!-- 
					fundpress-about-promo-image 
					xs-box-shadow
				 -->
			</div>
		</div>
	</div>
</section>	<!-- about us promo end -->

	<!-- about us video text -->
	<section class="fundpress-video-popup-with-text">
	<div class="fundpress-video-top-section xs-navy-blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-sm-12 col-lg-10 content-center">
					<div class="xs-heading-title fundpress-heading-title">
					<h2 class="color-white margin-bottom-0">“{{__('parrafo2_nosotros')}}”</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- about us video text -->
	<div class="funpress-video-popup xs-margin-top xs-margin-minus">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-lg-6 content-center">
				<div class="fundpress-popup-image xs-box-shadow">
					<img src="/frontend/images/nosotros.png" alt="">
					<div class="xs-popup-content icon-position-center">
						<a href="https://www.youtube.com/watch?v=LvGa1JnSRCk" class="xs-video-popup full-round icon-identify-btn green-btn xs-box-shadow xs-big-button"><i class="fa fa-play"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	<!-- about us video text end -->
</section>	<!-- about us video text end -->

	<!-- about us simple promo text -->
	<div class="fundpress-simple-promo-text-content">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-lg-9 content-center">
				<div class="fundpress-title-text-content">
				<h4 class="color-green margin-bottom-0">{{__('que_es')}}</h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="xs-text-content fundpress-text-content">
				<p>{{__('parrafo_que')}}</p>
					
				</div>
			</div>
		
		</div>
	</div>
</div>	<!-- about us simple promo text end -->

	

	

	<!-- team section -->
	<section class="xs-gray-bg xs-team-section fundpress-team-section xs-section-padding">
	<div class="container">
		<div class="xs-section-heading row xs-margin-0">
			<div class="fundpress-heading-title xs-padding-0 col-md-9 col-xl-9">
			<h2 class="color-navy-blue">{{__('conoce_nosotros')}}</h2>
				<span class="xs-separetor dashed-separetor fundpress-separetor"></span>				
			</div><!-- .xs-heading-title .fundpress-heading-title .xs-col-9 END -->
			<div class="xs-btn-wraper xs-padding-0 col-xl-3 col-md-3 d-flex-center-end">
				<a href="#" class="xs-btn round-btn navy-blue-btn">Team</a>
			</div><!-- .xs-btn-wraper .d-flex-center-end .xs-col-3 END -->
		</div><!-- .xs-section-heading .fundpress-section-heading .xs-spilit-container END -->
		<div class="row">
			<div class="col-md-3">
				<div class="xs-box-shadow  fundpress-single-team-member">
					<div class="fundpress-item-header ">
						<img src="frontend/images/avatar/team-1.jpg" alt="">
						<div class="xs-hover-content fundpress-hover-content text-center">
							<ul class="xs-social-list fundpress-social-list xs-social-list-v2">
								<li><a href="" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
								<li><a href="" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
								<li><a href="" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
							</ul>
						</div>
					</div>
					<!--fundpress-item-header -->
					<div class="xs-item-footer xs-content-padding bg-color-white  fundpress-team-details text-center">
						<a href="#" class="color-navy-blue">
							Kene Williamson
						</a>
						<h5 class="color-green">Manager</h5>
					</div>
					<!-- 
						xs-item-footer 
						xs-content-padding 
						bg-color-white 
						fundpress-team-details 
						text-center
					 -->
				</div>
				<!-- 
					xs-box-shadow 
					fundpress-single-team-member
				 -->
			</div>
			<div class="col-md-3">
				<div class="xs-box-shadow  fundpress-single-team-member">
					<div class="fundpress-item-header ">
						<img src="frontend/images/avatar/team-2.jpg" alt="">
						<div class="xs-hover-content fundpress-hover-content text-center">
							<ul class="xs-social-list fundpress-social-list xs-social-list-v2">
								<li><a href="" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
								<li><a href="" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
								<li><a href="" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
							</ul>
						</div>
					</div>
					<!--fundpress-item-header -->
					<div class="xs-item-footer xs-content-padding bg-color-white  fundpress-team-details text-center">
						<a href="#" class="color-navy-blue">
							Thomas Muller
						</a>
						<h5 class="color-green">Cantante</h5>
					</div>
					<!-- 
						xs-item-footer 
						xs-content-padding 
						bg-color-white 
						fundpress-team-details 
						text-center
					 -->
				</div>
				<!-- 
					xs-box-shadow 
					fundpress-single-team-member
				 -->
			</div>
			<div class="col-md-3">
				<div class="xs-box-shadow  fundpress-single-team-member">
					<div class="fundpress-item-header ">
						<img src="frontend/images/avatar/team-3.jpg" alt="">
						<div class="xs-hover-content fundpress-hover-content text-center">
							<ul class="xs-social-list fundpress-social-list xs-social-list-v2">
								<li><a href="" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
								<li><a href="" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
								<li><a href="" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
							</ul>
						</div>
					</div>
					<!--fundpress-item-header -->
					<div class="xs-item-footer xs-content-padding bg-color-white  fundpress-team-details text-center">
						<a href="#" class="color-navy-blue">
							Arian Roben
						</a>
						<h5 class="color-green">Empresario</h5>
					</div>
					<!-- 
						xs-item-footer 
						xs-content-padding 
						bg-color-white 
						fundpress-team-details 
						text-center
					 -->
				</div>
				<!-- 
					xs-box-shadow 
					fundpress-single-team-member
				 -->
			</div>
			<div class="col-md-3">
				<div class="xs-box-shadow  fundpress-single-team-member">
					<div class="fundpress-item-header ">
						<img src="frontend/images/avatar/team-4.jpg" alt="">
						<div class="xs-hover-content fundpress-hover-content text-center">
							<ul class="xs-social-list fundpress-social-list xs-social-list-v2">
								<li><a href="" class="color-facebook full-round"><i class="fa fa-facebook"></i></a></li>
								<li><a href="" class="color-twitter full-round"><i class="fa fa-twitter"></i></a></li>
								<li><a href="" class="color-dribbble full-round"><i class="fa fa-dribbble"></i></a></li>
							</ul>
						</div>
					</div>
					<!--fundpress-item-header-->
					<div class="xs-item-footer xs-content-padding bg-color-white  fundpress-team-details text-center">
						<a href="#" class="color-navy-blue">
							Pencil Henrics
						</a>
						<h5 class="color-green">Patrocinador</h5>
					</div>
					<!-- 
						xs-item-footer 
						xs-content-padding 
						bg-color-white 
						fundpress-team-details 
						text-center
					 -->
				</div>
				<!-- 
					xs-box-shadow 
					fundpress-single-team-member
				 -->
			</div>
		</div>
	</div>
</section>	<!-- team section end -->

	<!-- testimonial section -->
	<div class="xs-content-section-padding xs-testimonial-section fundpress-testimonial-section">
	<div class="container">
		<div class="xs-testimonial-slider slider-double-item xs-owl-dot owl-carousel">
			<div class="xs-testimonial-item">
				<blockquote class="xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote">
					<span class="xs-blockquote-icon fundpress-blockquote-icon">
						<img src="frontend/images/quote-left.png" alt="">
					</span>
					"En caza talentos pude encontrar el apoyo que necesitaba para mi carrera, 
					ahora soy un cantante reconocido y todo gracias a esta plataforma."
				</blockquote><!-- xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote END -->
				<div class="xs-spilit-container xs-testimonial-bio content-center width-70" >
					<div class="xs-avatar full-round fundpress-avatar-big">
						<img src="frontend/images/avatar/testimonial-1.jpg" alt="" class="xs-box-shadow-2">
					</div>
					<div class="xs-item-footer fundpress-team-details fundpress-testimonial-details text-left">
						<a href="#" class="color-navy-blue">
							Mark Williamson
						</a>
						<h5 class="color-green">Cantante.</h5>
					</div>
				</div><!-- xs-spilit-container xs-testimonial-bio content-center width-70 END -->
			</div><!-- xs-testimonial-item END -->
			<div class="xs-testimonial-item">
				<blockquote class="xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote">
					<span class="xs-blockquote-icon fundpress-blockquote-icon">
						<img src="frontend/images/quote-left.png" alt="">
					</span>
					"Estoy agradecido con caza talentos, este año mis resultados fueron fantásticos.este año se recauó $457,000, 
					lo que es un nuevo récord para nosotros".
				</blockquote><!-- xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote END -->
				<div class="xs-spilit-container xs-testimonial-bio content-center width-70">
					<div class="xs-avatar full-round fundpress-avatar-big">
						<img src="frontend/images/avatar/testimonial-2.jpg" alt="" class="xs-box-shadow-2">
					</div>
					<div class="xs-item-footer fundpress-team-details fundpress-testimonial-details text-left">
						<a href="#" class="color-navy-blue">
							Mark Henricks
						</a>
						<h5 class="color-green">Compositor	</h5>
					</div>
				</div><!-- xs-spilit-container xs-testimonial-bio content-center width-70 END -->
			</div><!-- xs-testimonial-item END -->
			{{-- <div class="xs-testimonial-item">
				<blockquote class="xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote">
					<span class="xs-blockquote-icon fundpress-blockquote-icon">
						<img src="frontend/images/quote-left.png" alt="">
					</span>
					" We are so glad that we made the switch to use FundPress this year and our results were fantastic. Our 8th Annual Race For Grace raised $457,000, which is a new record for us."
				</blockquote><!-- xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote END -->
				<div class="xs-spilit-container xs-testimonial-bio content-center width-70">
					<div class="xs-avatar full-round fundpress-avatar-big">
						<img src="frontend/images/avatar/testimonial-3.jpg" alt="" class="xs-box-shadow-2">
					</div>
					<div class="xs-item-footer fundpress-team-details fundpress-testimonial-details text-left">
						<a href="#" class="color-navy-blue">
							Mark Henricks
						</a>
						<h5 class="color-green">Founder, UI Hub Inc.</h5>
					</div>
				</div><!-- xs-spilit-container xs-testimonial-bio content-center width-70 END -->
			</div><!-- xs-testimonial-item END --> --}}
			{{-- <div class="xs-testimonial-item">
				<blockquote class="xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote">
					<span class="xs-blockquote-icon fundpress-blockquote-icon">
						<img src="frontend/images/quote-left.png" alt="">
					</span>
					" We are so glad that we made the switch to use FundPress this year and our results were fantastic. Our 8th Annual Race For Grace raised $457,000, which is a new record for us."
				</blockquote><!-- xs-blockquote bg-color-white xs-box-shadow xs-content-padding fundpress-blockquote END -->
				<div class="xs-spilit-container xs-testimonial-bio content-center width-70">
					<div class="xs-avatar full-round fundpress-avatar-big">
						<img src="frontend/images/avatar/testimonial-4.jpg" alt="" class="xs-box-shadow-2">
					</div>
					<div class="xs-item-footer fundpress-team-details fundpress-testimonial-details text-left">
						<a href="#" class="color-navy-blue">
							Mark Williamson
						</a>
						<h5 class="color-green">CEO, Pranklin Agency</h5>
					</div>
				</div><!-- xs-spilit-container xs-testimonial-bio content-center width-70 END -->
			</div><!-- xs-testimonial-item END --> --}}
		</div>
	</div>
</div>	<!-- testimonial section end -->


	<!-- sponsor section -->
	<section class="xs-gray-bg xs-bg xs-section-padding fundpress-sponsor-section" style="background-image: url(assets/images/background/sponsor_section_bg.jpg);">
	<div class="xs-solid-overlay xs-bg-white"></div>
	<div class="container fundpress-partners-wraper">
		<div class="fundpress-heading-title">
		<h2 class="color-navy-blue xs-mb-0">{{__('ventajas_nosotros')}}</h2>
		</div><!-- .xs-heading-title .fundpress-heading-title END -->
		<div class="content-center">
			<ul class="fundpress-partners">
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-1.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-2.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-3.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-4.png" alt=""></a></li>
			</ul><!-- .fundpress-partners END -->
		</div>
		<div class="content-center">
			<ul class="fundpress-partners">
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-5.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-6.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-7.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-8.png" alt=""></a></li>
				<li><a href="#" class="full-round fundpress-single-partner"><img src="/frontend/images/partner/partner-9.png" alt=""></a></li>
			</ul><!-- .fundpress-partners END -->
		</div>
	</div>
</section>
@stop
