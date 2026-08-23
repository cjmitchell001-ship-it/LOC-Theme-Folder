<?php
/**
 * Template Name: Location Page
 *
 * Shared template for the per-town location pages (/areas/syston/ etc).
 * Same pattern as page-legal.php: one template, content selected by slug.
 *
 * IMPORTANT — the template is shared, the CONTENT MUST NOT BE.
 * Google's scaled content abuse policy targets near-duplicate pages, and the
 * working test is that two pages which are 85%+ identical with one variable
 * swapped will fail. Every town added to $loc_towns below needs genuinely
 * different material: its own local detail, its own housing and appliance mix,
 * its own photo, its own reviews. If a town cannot fill those out with real
 * detail, it does not get a page yet.
 *
 * NEVER publish slot patterns, working hours or day-of-week availability on
 * these pages. It reveals more about how the business is staffed than it does
 * about the service. Availability lives in the booking calendar only.
 */

get_header();

$slug = get_post_field( 'post_name', get_the_ID() );

$loc_towns = [

	'syston' => [
		'town'     => 'Syston',
		'postcode' => 'LE7',
		'subline'  => 'LE7 &middot; North Leicester &middot; One of our most regular areas',

		'intro'    => 'Syston is one of the areas we cover most often &mdash; more jobs here than almost anywhere else we go. It sits just north of Leicester on the A46 corridor, which makes it a short, direct run for us, and that is a large part of why we are up here so regularly.',
		'intro_2'  => 'We clean ovens, hobs, extractors and microwaves across Syston and the rest of LE7, including Queniborough and Anstey, and the neighbouring LE4 villages of Thurmaston and Birstall.',


		'expect'   => 'Most of the Syston kitchens we work in fall into two groups &mdash; older semis, and the newer estates around the edges of the village. In both, the appliance is usually an integrated double oven, which is the most common thing we clean here by some distance. Towards the centre of Syston there&rsquo;s more of the older Victorian housing, and those kitchens tend to be a different job again.',
		'expect_2' => 'Integrated doubles are worth knowing about before you book. There are two cavities rather than one, so there&rsquo;s more glass, more shelving and more door seal to work through than a single oven &mdash; which is why a double is priced from &pound;70 rather than from &pound;55, and why it takes longer on the day.',

		'photo'     => 'images/locations/syston-oven-clean.webp',
		'photo_alt' => 'A cleaned double oven in a Syston kitchen',
		'photo_cap' => 'A double oven clean in Syston, before the new owners moved in.',

		'reviews' => [
			[
				'quote'  => 'Chris was so fantastic, I wish I had before pictures. We got Chris over for a double oven clean before we moved in and it was amazing. We had ovens like brand new! So happy and he&rsquo;s so friendly and kind too!',
				'author' => 'Raakhi Tanvi',
			],
			[
				'quote'  => 'Chris did an amazing job with the oven cleaning. It absolutely looks quite new now! He did a brilliant job with microwave, cooker and hood cleaning as well. I would highly recommend Chris and the price is quite reasonable as well.',
				'author' => 'Disha Darpan Rathod',
			],
		],
	],

];

// Unknown slug should not render a half-empty page.
if ( ! isset( $loc_towns[ $slug ] ) ) {
	get_template_part( '404' );
	get_footer();
	return;
}

$t      = $loc_towns[ $slug ];
$loc_eb = loc_earlybird_active();
?>

<main id="loc-location-page">

	<!-- PAGE HEADER -->
	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">Areas We Serve</p>
			<h1>Oven Cleaning in <span><?php echo $t['town']; ?></span></h1>
			<p class="loc-location__subline"><?php echo $t['subline']; ?></p>
		</div>
	</section>

	<!-- INTRO -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p><?php echo $t['intro']; ?></p>
			<p><?php echo $t['intro_2']; ?></p>
		</div>
	</section>

	<!-- PRICES -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Prices</p>
			<h2>What we clean, and what it costs</h2>
			<p>Same prices in <?php echo $t['town']; ?> as everywhere else we cover &mdash; there&rsquo;s no travel surcharge.</p>

			<div class="loc-location-prices">
				<div class="loc-location-price"><span>Single oven</span><span><?php echo $loc_eb ? 'from &pound;55 <s class="loc-price-was">from &pound;70</s>' : 'from &pound;70'; ?></span></div>
				<div class="loc-location-price"><span>Double oven</span><span><?php echo $loc_eb ? 'from &pound;70 <s class="loc-price-was">from &pound;90</s>' : 'from &pound;90'; ?></span></div>
				<div class="loc-location-price"><span>Free-standing cooker</span><span><?php echo $loc_eb ? 'from &pound;55 <s class="loc-price-was">from &pound;70</s>' : 'from &pound;70'; ?></span></div>
				<div class="loc-location-price"><span>Range cooker</span><span>from &pound;125</span></div>
				<div class="loc-location-price"><span>Gas, ceramic or induction hob</span><span>from &pound;25</span></div>
				<div class="loc-location-price"><span>Extractor hood</span><span>from &pound;25</span></div>
				<div class="loc-location-price"><span>Microwave</span><span>&pound;15</span></div>
				<div class="loc-location-price"><span>Combi microwave</span><span>&pound;20</span></div>
			</div>

			<p>Prices are confirmed before we start, not after we finish. If an oven turns out to be heavily soiled and needs longer than a standard clean, we&rsquo;ll say so and re-quote before any work begins &mdash; you&rsquo;re never presented with a bigger number at the end.</p>
			<p><a href="/services">See everything we clean &rarr;</a></p>
		</div>
	</section>

	<!-- WORK WE'VE DONE HERE -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner loc-location-work">
			<div class="loc-location-work__text">
				<p class="section-eyebrow">Recent Work</p>
				<h2>Work we&rsquo;ve done in <?php echo $t['town']; ?></h2>
				<p><?php echo $t['photo_cap']; ?></p>
				<p><?php echo $t['expect']; ?></p>
				<p><?php echo $t['expect_2']; ?></p>
			</div>
			<figure class="loc-location-work__figure">
				<img src="<?php echo get_stylesheet_directory_uri() . '/' . $t['photo']; ?>"
				     alt="<?php echo esc_attr( $t['photo_alt'] ); ?>"
				     width="900" height="1200" loading="lazy" decoding="async">
			</figure>
		</div>
	</section>

	<!-- REVIEWS — real customers from this town, placed BEFORE the standard-of-clean
	     section so the page reads as delight then honest caveat, not a claim that is
	     immediately contradicted. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Reviews</p>
			<h2>What <?php echo $t['town']; ?> customers say</h2>
			<div class="loc-location-reviews">
				<?php foreach ( $t['reviews'] as $r ) : ?>
					<blockquote class="loc-location-review">
						<p class="loc-location-review__quote"><?php echo $r['quote']; ?></p>
						<footer>
							<cite class="loc-location-review__author"><?php echo $r['author']; ?></cite>
							<span class="loc-location-review__stars" role="img" aria-label="Rated 5 out of 5">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
						</footer>
					</blockquote>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- STANDARD OF CLEAN — wording must stay in step with page-faq.php's
	     "Will my oven look brand new?" answer. Never soften to "like new". -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What the result actually looks like</h2>
			<p>We&rsquo;ll get the carbon and grease off &mdash; and on most ovens the difference is bigger than people expect. What we won&rsquo;t do is promise showroom condition. Discolouration, staining, pitting, scratches and heat damage are marks in the material itself, not dirt sitting on top of it, and nobody can clean those out. If we think that&rsquo;s what you&rsquo;re looking at, we&rsquo;ll tell you before we start rather than after.</p>
			<p><a href="/faq">Read our FAQs &rarr;</a></p>
		</div>
	</section>

	<!-- CTA -->
	<section class="loc-location-cta">
		<div class="loc-location-cta__inner">
			<p class="loc-location-cta__tagline">See live availability and reserve in minutes. We&rsquo;ll call to confirm.</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
			<p class="loc-location-cta__sub">No card needed to reserve. A &pound;25 deposit is arranged by bank transfer on the confirmation call, with the balance by transfer or cash on the day.</p>
			<p class="loc-location-cta__back"><a href="/areas">&larr; See all the areas we cover</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
