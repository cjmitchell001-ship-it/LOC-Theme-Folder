<?php
/**
 * Template Name: Location Page
 *
 * Shared template for the per-town location pages (/areas/syston/ etc).
 * Same slug-driven pattern as page-legal.php.
 *
 * Structure built from a teardown of four real UK location pages that rank:
 * Ovensupport Leicester, Ovenu Leicester North East, Local Expert Cleaning
 * Dudley, Ovenclean. Patterns taken; all wording our own.
 *
 * Copied because every ranking page did it: postcode-level coverage with named
 * neighbourhoods, named reviews, a stated process, an FAQ block, CTAs repeated
 * through the page rather than saved for the bottom, and a housing-stock and
 * appliance-mix tie-in.
 *
 * Where we beat them: Ovensupport and Ovenu both hide pricing, use generic
 * stock photography, carry no genuinely local reviews and run 60-80%
 * boilerplate per page. We show real prices, real photos of real local jobs,
 * reviews from customers in that actual town, and an honest statement of what
 * will not come off.
 *
 * TWO STANDING RULES FOR EVERY TOWN ADDED HERE:
 *
 * 1. NEVER publish slot patterns, working hours or day-of-week availability.
 *    That reveals how the business is staffed, not just when it is free.
 *    Availability lives in the booking calendar only.
 *
 * 2. The template is shared; the CONTENT MUST NOT BE. Google's scaled content
 *    abuse policy targets near-duplicate pages, and the working test is that
 *    two pages 85%+ identical with one variable swapped will fail. Every town
 *    needs its own coverage list, housing and appliance mix, photos, reviews
 *    and local FAQs. A town that cannot fill those in with real detail does
 *    not get a page yet.
 */

get_header();

$slug   = get_post_field( 'post_name', get_the_ID() );
$loc_eb = loc_earlybird_active();

$loc_towns = [

	'syston' => [
		'town'       => 'Syston',
		'postcode'   => 'LE7',
		'price_from' => $loc_eb ? '55' : '70',
		'subline'    => 'LE7 &middot; North Leicester &middot; One of our most regular areas',

		'intro'   => 'Syston is one of the areas we cover most often &mdash; more jobs here than almost anywhere else we go. It sits just north of Leicester on the A46 corridor, which makes it a short, direct run for us, and that is a large part of why we are up here so regularly.',
		'intro_2' => 'That matters more than it sounds. Being in an area often means we know the housing, we have a fair idea what is behind the kitchen door before we open it, and we can be realistic with you about a job before we take it on.',

		'coverage_lead'   => 'We cover the whole of Syston and the surrounding LE7 villages, along with the neighbouring LE4 areas just down the road.',
		'coverage_groups' => [
			'Syston and LE7'     => [ 'Syston', 'Queniborough', 'Anstey', 'Cropston' ],
			'Neighbouring (LE4)' => [ 'Thurmaston', 'Birstall' ],
		],
		'coverage_note'   => 'Not sure whether you are inside the line? Put your postcode into the booking page and it will tell you straight away.',

		'kitchens'   => 'Most of the Syston kitchens we work in fall into two groups &mdash; older semis, and the newer estates around the edges of the village. In both, the appliance is usually an integrated double oven, which is the most common thing we clean here by some distance. Towards the centre of Syston there is more of the older Victorian housing, and those kitchens tend to be a different job again.',
		'kitchens_2' => 'Integrated doubles are worth knowing about before you book. There are two cavities rather than one, so there is more glass, more shelving and more door seal to work through than a single oven &mdash; which is why a double starts higher than a single, and why it takes longer on the day.',

		'photos' => [
			[ 'file' => 'images/locations/syston-oven-clean.webp',   'alt' => 'A cleaned double oven in a Syston kitchen' ],
			[ 'file' => 'images/locations/syston-oven-clean-2.webp', 'alt' => 'A cleaned oven interior from a job in Syston' ],
		],
		'photos_cap' => 'A double oven clean in Syston, finished before the new owners moved in.',

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

		'faqs' => [
			[
				'q' => 'Do you cover all of Syston?',
				'a' => 'Yes &mdash; the whole of Syston and the wider LE7 area, plus Thurmaston and Birstall next door. If you are slightly outside that it is still worth asking, and we will be honest if it is not practical.',
			],
			[
				'q' => 'Does it cost more because I am outside Leicester?',
				'a' => 'No. There is no travel surcharge for Syston or anywhere else we cover. The price depends on the appliance, not the postcode.',
			],
			[
				'q' => 'How long will it take?',
				'a' => 'Most single ovens take under two hours. A double takes longer, because both cavities are cleaned separately, and adding a hob or an extractor adds time on top. We will give you a realistic figure when we confirm.',
			],
			[
				'q' => 'What if my oven is in a worse state than expected?',
				'a' => 'We tell you before we start, not after we finish. If it needs significantly longer than a standard clean we will re-quote on the spot and you can decide. You will never be handed a bigger number at the end than the one you agreed.',
			],
			[
				'q' => 'Do I need to be at home?',
				'a' => 'Someone needs to let us in and be there at the end so you can look over the result. We also need access to power and hot water. Beyond that, you are free to get on with your day.',
			],
		],

		// Cross-links to sibling town pages. Empty until those pages exist —
		// never link to a page that has not been built.
		'nearby' => [],
	],

];

if ( ! isset( $loc_towns[ $slug ] ) ) {
	get_template_part( '404' );
	get_footer();
	return;
}

$t = $loc_towns[ $slug ];

/**
 * Inline CTA, repeated through the page. The teardown was unanimous on this:
 * every page that ranks repeats its CTA rather than saving it for the bottom.
 */
function loc_location_cta() {
	?>
	<div class="loc-location-inline-cta">
		<p class="loc-location-inline-cta__text">See live availability and reserve in minutes. We&rsquo;ll call to confirm.</p>
		<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
	</div>
	<?php
}
?>

<main id="loc-location-page">

	<!-- 1. HERO — town plus price anchor. Dudley put the price in the heading
	     area and it was the strongest conversion element on any page we saw. -->
	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">Areas We Serve</p>
			<h1>Oven Cleaning in <span><?php echo $t['town']; ?></span></h1>
			<p class="loc-location__price-anchor">Ovens from &pound;<?php echo $t['price_from']; ?> &middot; hobs and extractors from &pound;25 &middot; no travel charge</p>
			<p class="loc-location__subline"><?php echo $t['subline']; ?></p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
		</div>
	</section>

	<!-- 2. INTRO -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p><?php echo $t['intro']; ?></p>
			<p><?php echo $t['intro_2']; ?></p>
		</div>
	</section>

	<!-- 3. COVERAGE — postcode level. Every page in the teardown did this. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Coverage</p>
			<h2>Where we cover around <?php echo $t['town']; ?></h2>
			<p><?php echo $t['coverage_lead']; ?></p>

			<div class="loc-location-coverage">
				<?php foreach ( $t['coverage_groups'] as $group => $places ) : ?>
					<div class="loc-location-coverage__group">
						<h3 class="loc-location-coverage__title"><?php echo $group; ?></h3>
						<ul class="loc-location-coverage__list">
							<?php foreach ( $places as $p ) : ?>
								<li><?php echo $p; ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

			<p><?php echo $t['coverage_note']; ?></p>
		</div>
	</section>

	<!-- 4. PRICES — competitors hide these. We do not. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Prices</p>
			<h2>What we clean, and what it costs</h2>
			<p>The same prices in <?php echo $t['town']; ?> as everywhere else we cover &mdash; there is no travel surcharge.</p>

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

			<p>Prices are confirmed before we start, not after we finish. If an oven turns out to be heavily soiled and needs longer than a standard clean, we will say so and re-quote before any work begins.</p>
			<p><a href="/services">See everything we clean &rarr;</a></p>

			<?php loc_location_cta(); ?>
		</div>
	</section>

	<!-- 5. HOUSING STOCK / APPLIANCE MIX — the section that most separates one
	     town page from another. Needs real local knowledge to write. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Local Detail</p>
			<h2>What we find in <?php echo $t['town']; ?> kitchens</h2>
			<p><?php echo $t['kitchens']; ?></p>
			<p><?php echo $t['kitchens_2']; ?></p>
		</div>
	</section>

	<!-- 6. RECENT WORK — finished results only. Brand rule: no dirty-oven
	     before/after imagery. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Recent Work</p>
			<h2>A job we did in <?php echo $t['town']; ?></h2>
			<p><?php echo $t['photos_cap']; ?></p>
			<div class="loc-location-gallery">
				<?php foreach ( $t['photos'] as $ph ) : ?>
					<figure class="loc-location-gallery__item">
						<img src="<?php echo get_stylesheet_directory_uri() . '/' . $ph['file']; ?>"
						     alt="<?php echo esc_attr( $ph['alt'] ); ?>"
						     width="900" height="1200" loading="lazy" decoding="async">
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 7. THE PRE-CLEAN CHECK — worded as a screen, never as a guarantee. See
	     03-Operations/Post-Clean-Electrical-Faults.md: a visual check screens
	     for the obvious, it does not certify that nothing is wrong. Do not
	     reword this into a promise. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Before We Start</p>
			<h2>The check we do first</h2>
			<p>Before any product touches your appliance we look it over with you &mdash; the condition of the seals and the glass, any damage that is already there, and anything that needs flagging rather than cleaning. It takes a couple of minutes, and it means the price is agreed on what is actually in front of us.</p>
			<p>We will also be straight about what that check can and cannot tell us. It catches the obvious. It is not a guarantee that an older appliance has no underlying fault, because some things simply are not visible from the outside &mdash; and we would rather say so up front than pretend otherwise.</p>
		</div>
	</section>

	<!-- 8. REVIEWS — real customers from this town, placed BEFORE the honest
	     expectations section so the page reads as delight then caveat, rather
	     than a claim immediately contradicted. -->
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
			<?php loc_location_cta(); ?>
		</div>
	</section>

	<!-- 9. HONEST EXPECTATIONS — must stay in step with page-faq.php's "Will my
	     oven look brand new?" answer. Never soften to "like new". -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What the result actually looks like</h2>
			<p>We will get the carbon and grease off &mdash; and on most ovens the difference is bigger than people expect. What we will not do is promise showroom condition. Discolouration, staining, pitting, scratches and heat damage are marks in the material itself, not dirt sitting on top of it, and nobody can clean those out. If we think that is what you are looking at, we will tell you before we start rather than after.</p>
			<p><a href="/faq">Read our FAQs &rarr;</a></p>
		</div>
	</section>

	<!-- 10. FAQ — at least two genuinely local questions per town. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Questions</p>
			<h2>Oven cleaning in <?php echo $t['town']; ?> &mdash; common questions</h2>
			<div class="loc-location-faqs">
				<?php foreach ( $t['faqs'] as $f ) : ?>
					<details class="loc-location-faq">
						<summary class="loc-location-faq__q"><?php echo $f['q']; ?></summary>
						<p class="loc-location-faq__a"><?php echo $f['a']; ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 11. NEARBY AREAS — only renders once sibling pages actually exist. -->
	<?php if ( ! empty( $t['nearby'] ) ) : ?>
		<section class="loc-location-section loc-location-section--alt">
			<div class="loc-location-section__inner">
				<p class="section-eyebrow">Nearby</p>
				<h2>Other areas we cover</h2>
				<ul class="loc-location-nearby">
					<?php foreach ( $t['nearby'] as $n ) : ?>
						<li><a href="<?php echo $n['url']; ?>"><?php echo $n['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<!-- 12. FINAL CTA -->
	<section class="loc-location-cta">
		<div class="loc-location-cta__inner">
			<p class="loc-location-cta__tagline">Ready to get your oven sorted?</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
			<p class="loc-location-cta__sub">No card needed to reserve. A &pound;25 deposit is arranged by bank transfer on the confirmation call, with the balance by transfer or cash on the day.</p>
			<p class="loc-location-cta__back"><a href="/areas">&larr; See all the areas we cover</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
