<?php
/**
 * Template Name: Location Page
 *
 * Shared template for the per-town location pages (/areas/syston/ etc).
 * Same slug-driven pattern as page-legal.php.
 *
 * Structure built from a teardown of four real UK location pages that rank:
 * Ovensupport Leicester, Ovenu Leicester North East, Local Expert Cleaning
 * Dudley, Ovenclean. Patterns taken; all wording my own.
 *
 * Copied because every ranking page did it: postcode-level coverage with named
 * neighbourhoods, named reviews, a stated process, an FAQ block, CTAs repeated
 * through the page rather than saved for the bottom, and a housing-stock and
 * appliance-mix tie-in.
 *
 * Where I beat them: Ovensupport and Ovenu both hide pricing, use generic
 * stock photography, carry no genuinely local reviews and run 60-80%
 * boilerplate per page. I show real prices, real photos of real local jobs,
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

$loc_towns = [

	'syston' => [
		'town'       => 'Syston',
		'postcode'   => 'LE7',
		'price_from' => '55',
		'subline'    => 'LE7 &middot; North Leicester &middot; One of my most regular areas',

		'intro'   => 'Syston is one of the areas I cover most often &mdash; more jobs here than almost anywhere else I go. It sits just north of Leicester on the A46 corridor, which makes it a short, direct run for me, and that is a large part of why I am up here so regularly.',
		'intro_2' => 'That matters more than it sounds. Being in an area often means I know the housing, I have a fair idea what is behind the kitchen door before I open it, and I can be realistic with you about a job before I take it on.',

		'coverage_lead'   => 'I cover the whole of Syston and the surrounding LE7 villages, along with the neighbouring LE4 areas just down the road.',
		'coverage_groups' => [
			'Syston and LE7'     => [ 'Syston', 'Queniborough', 'Anstey', 'Cropston' ],
			'Neighbouring (LE4)' => [ 'Thurmaston', 'Birstall' ],
		],
		'coverage_note'   => 'Syston is one of many areas I cover across Leicester and the wider county. Put your postcode into the booking page and it will confirm in seconds &mdash; I reach a good deal further than most people expect.',

		'kitchens'   => 'Most of the Syston kitchens I work in fall into two groups &mdash; older semis, and the newer estates around the edges of the village. In both, the appliance is usually an integrated double oven, which is the most common thing I clean here by some distance. Towards the centre of Syston there is more of the older Victorian housing, and those kitchens tend to be a different job again.',
		'kitchens_2' => 'Integrated doubles are worth knowing about before you book. There are two cavities rather than one, so there is more glass, more shelving and more door seal to work through than a single oven &mdash; which is why a double starts higher than a single, and why it takes longer on the day.',

		'photos' => [
			[ 'file' => 'images/locations/syston-oven-clean.webp',   'alt' => 'A cleaned double oven in a Syston kitchen' ],
			[ 'file' => 'images/locations/syston-oven-clean-2.webp', 'alt' => 'A cleaned oven interior from a job in Syston' ],
		],
		'photos_cap' => 'A double oven clean in Syston, finished before the new owners moved in.',

		'reviews' => [
			[
				'quote'  => 'Chris was so fantastic, I wish I had before pictures. We got Chris over for a double oven clean before we moved in and it was amazing. We had ovens like brand new! So happy and he&rsquo;s so friendly and kind too!',
				'author' => 'Raakhi T.',
			],
			[
				'quote'  => 'Chris did an amazing job with the oven cleaning. It absolutely looks quite new now! He did a brilliant job with microwave, cooker and hood cleaning as well. I would highly recommend Chris and the price is quite reasonable as well.',
				'author' => 'Disha R.',
			],
		],

		'faqs' => [
			[
				'q' => 'What if I am outside the Syston area?',
				'a' => 'You are almost certainly still covered. I work right across the LE postcodes &mdash; Leicester city, north to Loughborough, Coalville and Ashby, east to Melton and Rutland, south to Lutterworth and Market Harborough, and west to Hinckley. There is no travel surcharge anywhere on that list; the price depends on the appliance, not the postcode.',
			],
			[
				'q' => 'How long will it take?',
				'a' => 'Most single ovens take under two hours. A double takes longer, because both cavities are cleaned separately, and adding a hob or an extractor adds time on top. I will give you a realistic figure when I confirm.',
			],
			[
				'q' => 'What if my oven is in a worse state than expected?',
				'a' => 'I tell you before I start, not after I finish. If it needs significantly longer than a standard clean I will re-quote on the spot and you can decide. You will never be handed a bigger number at the end than the one you agreed.',
			],
			[
				'q' => 'Do I need to be at home?',
				'a' => 'Someone needs to let me in and be there at the end so you can look over the result. I also need access to power and hot water. Beyond that, you are free to get on with your day.',
			],
		],

		// Cross-links to sibling town pages. Empty until those pages exist —
		// never link to a page that has not been built.
		'nearby' => [
			[ 'name' => 'Oven cleaning in Birstall', 'url' => '/areas/birstall/' ],
		],
	],


	/**
	 * BIRSTALL. Two completed jobs, four before/after pairs, one review.
	 *
	 * What makes this page different from Syston's, deliberately: the appliance
	 * mix is the OPPOSITE. Both Birstall jobs were single ovens; Syston runs to
	 * integrated doubles. That is a real observed difference, not a rewording,
	 * and it is what the kitchens section is built on.
	 *
	 * The housing description below is geography, not invented experience.
	 * Chris has not yet given his own read of Birstall kitchens the way he did
	 * for Syston -- when he does, this section should be rewritten around it,
	 * because first-hand detail beats description every time.
	 */
	'birstall' => [
		'town'       => 'Birstall',
		'postcode'   => 'LE4',
		'price_from' => '55',
		'subline'    => 'LE4 &middot; North Leicester &middot; Between the city and Syston',

		'intro'   => 'Birstall sits just north of Leicester on the A6, with Watermead Country Park along its eastern edge and Thurmaston across the water. It is a straightforward run for me and one of the areas I have worked in most since I started.',
		'intro_2' => 'It is also one of the few areas where I can show you the work rather than describe it. Four of the before and after pairs on this site are Birstall kitchens, from two separate jobs &mdash; so you can judge the standard yourself before you call me.',

		'coverage_lead'   => 'I cover the whole of Birstall and the rest of LE4, along with the LE7 villages immediately north.',
		'coverage_groups' => [
			'Birstall and LE4'  => [ 'Birstall', 'Hallam Fields', 'Watermead', 'Thurmaston' ],
			'Just north (LE7)'  => [ 'Syston', 'Wanlip', 'Rothley' ],
		],
		'coverage_note'   => 'If you are out on the edge of Birstall and not sure which side of the line you fall, put your postcode into the booking page &mdash; it confirms in seconds. I reach a good deal further across the county than most people assume.',

		'kitchens'   => 'Both of the Birstall jobs behind the photos on this site were single ovens rather than doubles &mdash; which is the reverse of what I usually find a few miles up the road in Syston. Birstall runs from the older housing around the village centre and Greengate Lane out to the newer estates at Hallam Fields, and what is behind the kitchen door changes with it.',
		'kitchens_2' => 'One of those jobs was a single oven, an extractor hood and heavily stained door glass, all in the same visit. That combination is worth understanding before you book, because it is priced by the appliance rather than as a package: the oven price plus the hood price, added up, with no bundle discount and no second call-out charge for doing both at once. The door glass is part of the oven clean, not an extra &mdash; the door comes apart so both sides of the glass get done.',

		// Before/after pairs, reusing the compressed WebP already generated for
		// /before-and-after/. Rosemary's job is used here rather than Tracy's:
		// Tracy's pair is the homepage hero, and repeating it across pages makes
		// the site look thinner than it is.
		'pairs' => [
			[ 'slug' => 'rosemary-birstall-single-oven', 'label' => 'Single oven &mdash; Birstall',   'alt' => 'A single oven in a Birstall kitchen' ],
			[ 'slug' => 'rosemary-birstall-extractor',   'label' => 'Extractor hood &mdash; Birstall', 'alt' => 'An extractor hood in a Birstall kitchen' ],
		],
		'photos_cap' => 'A single oven and the extractor hood above it, both cleaned in the same visit in Birstall.',

		'reviews' => [
			[
				'quote'  => 'Excellent Job, everything was done throughly &amp; really pleased with my oven clean, highly recommend and will definitely use again in the future',
				'author' => 'Amy G.',
			],
		],

		'faqs' => [
			[
				'q' => 'I need the oven and the extractor hood doing. Is there a discount for both?',
				'a' => 'No &mdash; I price by the appliance and add them up, so it is the oven price plus the hood price. What you do save is the second visit: both get done in one appointment, and there is no extra call-out for the hood. Hoods start at &pound;25 and vary with how much grease has built up in the filters.',
			],
			[
				'q' => 'The glass in my oven door is stained on the inside. Can that be cleaned?',
				'a' => 'Usually, yes. The door comes apart so both faces of the glass are cleaned properly rather than just the side you can reach &mdash; that is included in the oven price, not an extra. The exception is when the marking is etched into the glass rather than sitting on it, which happens on older doors. If that is what I find, I will tell you before I start rather than let you expect something I cannot deliver.',
			],
			[
				'q' => 'How long does a single oven take?',
				'a' => 'Most take under two hours. Adding an extractor hood or a hob adds time on top of that, and a heavily built-up oven takes longer than a well-kept one. I give you a realistic window when I call to confirm, rather than a number that suits my diary.',
			],
		],

		'nearby' => [
			[ 'name' => 'Oven cleaning in Syston', 'url' => '/areas/syston/' ],
		],
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
		<p class="loc-location-inline-cta__text">See live availability and reserve in minutes. I&rsquo;ll call to confirm.</p>
		<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
	</div>
	<?php
}
?>

<main id="loc-location-page">

	<!-- 1. HERO — town plus price anchor. Dudley put the price in the heading
	     area and it was the strongest conversion element on any page I saw. -->
	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">Areas I Serve</p>
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
			<h2>Where I cover around <?php echo $t['town']; ?></h2>
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

	<!-- 4. PRICES — competitors hide these. I do not. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Prices</p>
			<h2>What I clean, and what it costs</h2>
			<p>The same prices in <?php echo $t['town']; ?> as everywhere else I cover &mdash; there is no travel surcharge.</p>

			<div class="loc-location-prices">
				<div class="loc-location-price"><span>Single oven</span><span>From &pound;55</span></div>
				<div class="loc-location-price"><span>Double oven</span><span>From &pound;70</span></div>
				<div class="loc-location-price"><span>Free-standing cooker</span><span>From &pound;55</span></div>
				<div class="loc-location-price"><span>Range cooker</span><span>from &pound;125</span></div>
				<div class="loc-location-price"><span>Gas, ceramic or induction hob</span><span>from &pound;25</span></div>
				<div class="loc-location-price"><span>Extractor hood</span><span>from &pound;25</span></div>
				<div class="loc-location-price"><span>Microwave</span><span>&pound;15</span></div>
				<div class="loc-location-price"><span>Combi microwave</span><span>&pound;20</span></div>
			</div>

			<p>Range cookers vary more than anything else I clean, so the price does too. The from-price covers all the cavities, the grill compartment and the exterior; a hob is priced separately. If you only want part of it cleaned, say so when you reserve and I will price what you actually want doing.</p>
			<p>Prices are confirmed before I start, not after I finish. If an oven turns out to be heavily soiled and needs longer than a standard clean, I will say so and re-quote before any work begins.</p>
			<p><a href="/services">See everything I clean &rarr;</a></p>

			<?php loc_location_cta(); ?>
		</div>
	</section>

	<!-- 5. HOUSING STOCK / APPLIANCE MIX — the section that most separates one
	     town page from another. Needs real local knowledge to write. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Local Detail</p>
			<h2>What I find in <?php echo $t['town']; ?> kitchens</h2>
			<p><?php echo $t['kitchens']; ?></p>
			<p><?php echo $t['kitchens_2']; ?></p>
		</div>
	</section>

	<!-- 6. RECENT WORK — real before/after pairs where the town has them,
	     finished-result shots otherwise. The old "no dirty-oven imagery" rule
	     in this comment was REVOKED by Chris on 29 Aug 2026. Before/after is
	     now the strongest asset the site has, and neither Ovenu nor
	     Ovensupport can match it -- one has no local reviews, the other no
	     real photos. Pairs reuse the .loc-gallery classes from
	     page-gallery.php rather than inventing a second set of components. -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Recent Work</p>
			<h2><?php echo empty( $t['pairs'] ) ? 'A job I did in ' . $t['town'] : 'Work I have done in ' . $t['town']; ?></h2>
			<p><?php echo $t['photos_cap']; ?></p>

			<?php if ( ! empty( $t['pairs'] ) ) : ?>
				<div class="loc-gallery">
					<?php foreach ( $t['pairs'] as $pr ) : ?>
						<figure class="loc-gallery__item">
							<div class="loc-gallery__pair">
								<div class="loc-gallery__shot">
									<img src="<?php echo get_stylesheet_directory_uri() . '/images/gallery/' . $pr['slug'] . '-before.webp'; ?>"
									     width="600" height="800" loading="lazy" decoding="async"
									     alt="<?php echo esc_attr( $pr['alt'] . ' before cleaning' ); ?>">
									<span class="loc-gallery__tag loc-gallery__tag--before">Before</span>
								</div>
								<div class="loc-gallery__shot">
									<img src="<?php echo get_stylesheet_directory_uri() . '/images/gallery/' . $pr['slug'] . '-after.webp'; ?>"
									     width="600" height="800" loading="lazy" decoding="async"
									     alt="<?php echo esc_attr( $pr['alt'] . ' after cleaning' ); ?>">
									<span class="loc-gallery__tag loc-gallery__tag--after">After</span>
								</div>
							</div>
							<figcaption class="loc-gallery__caption">
								<span class="loc-gallery__what"><?php echo $pr['label']; ?></span>
							</figcaption>
						</figure>
					<?php endforeach; ?>
				</div>
				<p><a href="/before-and-after">See more before and afters &rarr;</a></p>
			<?php else : ?>
				<div class="loc-location-gallery">
					<?php foreach ( $t['photos'] as $ph ) : ?>
						<figure class="loc-location-gallery__item">
							<img src="<?php echo get_stylesheet_directory_uri() . '/' . $ph['file']; ?>"
							     alt="<?php echo esc_attr( $ph['alt'] ); ?>"
							     width="900" height="1200" loading="lazy" decoding="async">
						</figure>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- 7. REVIEWS — real customers from this town, placed BEFORE the honest
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

	<!-- 8. THE PRE-CLEAN CHECK — worded as a screen, never as a guarantee. See
	     03-Operations/Post-Clean-Electrical-Faults.md: a visual check screens
	     for the obvious, it does not certify that nothing is wrong. Do not
	     reword this into a promise. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Before I Start</p>
			<h2>The check I do first</h2>
			<p>Before any product touches your appliance I look it over with you &mdash; the condition of the seals and the glass, any damage that is already there, and anything that needs flagging rather than cleaning. It takes a couple of minutes, and it means the price is agreed on what is actually in front of me.</p>
			<p>I will also be straight about what that check can and cannot tell me. It catches the obvious. It is not a guarantee that an older appliance has no underlying fault, because some things simply are not visible from the outside &mdash; and I would rather say so up front than pretend otherwise.</p>
		</div>
	</section>

	<!-- 9. HONEST EXPECTATIONS — must stay in step with page-faq.php's "Will my
	     oven look brand new?" answer. Never soften to "like new". -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What the result actually looks like</h2>
			<p>I will get the carbon and grease off &mdash; and on most ovens the difference is bigger than people expect. What I will not do is promise showroom condition. Discolouration, staining, pitting, scratches and heat damage are marks in the material itself, not dirt sitting on top of it, and nobody can clean those out. If I think that is what you are looking at, I will tell you before I start rather than after.</p>
			<p><a href="/faq">Read my FAQs &rarr;</a></p>
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
				<h2>Other areas I cover</h2>
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
			<p class="loc-location-cta__back"><a href="/areas">&larr; See all the areas I cover</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
