<!-- FOOTER -->
<footer>
		<div id="footer-top-wrap">
			<section id="footer-top" class="clearfix">
				<article>
					<h6>About Yamaduta</h6>
					<p>Welcome to YAMADUTA, your trusted source for stylish and high-quality clothing right here in [Pasig City].
Founded with a passion for fashion and a deep commitment to our community, we've been dressing the people of [Pinag uhatan] in the latest trends and timeless classics since 2017.</p>
					<!-- LOGO -->
					<a href="/">
						<figure class="logo">
							<img src="{{ asset('images/yamaduta.jpeg') }}" alt="logo" style="width: 150px; margin-top: -20px; margin-left: 50px;">
							<figcaption>yamaduta</figcaption>
						</figure>
					</a>
					<!-- /LOGO -->

					<!-- CONTACT INFO -->
					<ul class="contact-info">
						<li class="address">
							<!-- SVG PIN -->
							<svg class="svg-pin">
								<use xlink:href="#svg-pin"></use>
							</svg>
							<!-- /SVG PIN -->
							<p>{{ App\Models\Contact::find(1)->first()->value('location') }}</p>
						</li>
						<li class="phone">
							<!-- SVG PHONE -->
							<svg class="svg-phone">
								<use xlink:href="#svg-phone"></use>
							</svg>
							<!-- /SVG PHONE -->
							<p>{{ App\Models\Contact::find(1)->first()->value('contact_number') }}</p>
						</li>
						<li class="email">
							<!-- SVG ENVELOPE -->
							<svg class="svg-envelope">
								<use xlink:href="#svg-envelope"></use>
							</svg>
							<!-- /SVG ENVELOPE -->
							<p><a href="mailto:{{ App\Models\Contact::find(1)->first()->value('email') }}">{{ App\Models\Contact::find(1)->first()->value('email') }}</a></p>
						</li>
					</ul>
					<!-- /CONTACT INFO -->


				</article>

				<article>
					<h6>Site Information</h6>
					<nav id="footer-menu">
						<ul>
							<li>
								<a href="{{ url('/')}}">Home</a>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</li>
							<li>
								<a href="{{ route('shop') }}">Shop</a>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</li>

							<li>
								<a href="{{ route('aboutUs') }}">About us</a>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</li>
							<li>
								<a href="{{ route('contact') }}">Contact</a>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</li>

						</ul>
					</nav>
				</article>


			</section>
		</div>
		<div id="footer-bottom-wrap">
			<section id="footer-bottom">
				<p><a href="index.html">Yamaduta </a> Clothing <br> <span>|</span> All Rights Reserved 2021</p>
				<!-- SOCIAL LINKS -->
				<ul class="social-links">
					<li class="fb"><a href="#"></a></li>
					<li class="twt"><a href="#"></a></li>

				</ul>
				<!-- /SOCIAL LINKS -->
			</section>
		</div>
	</footer>
	<!-- /FOOTER -->
