<?php
/**
 * Template Name: Range Cooker Pricing
 *
 * The detailed range cooker breakdown, at /services/range-cooker-prices/.
 *
 * WHY THIS PAGE EXISTS: a range cooker used to be one indivisible £125 job,
 * so anyone who only wanted a single cavity cleaned was quoted for the whole
 * appliance and walked away. This page shows the parts and their prices so a
 * customer can work out their own number before they call.
 *
 * The component prices below are Chris's, from 30 Aug 2026. If they change,
 * they change HERE, on the Services cards, in Step 1 and Step 2, in
 * LOC-Pricing.md, on the Google Business Profile and on Facebook. Chris
 * raised that himself -- the price lives in more places than the website.
 *
 * WHY THE CAVITY PRICES DIFFER: it is purely SIZE, not how many ovens the
 * range has. An extra large full width oven is simply a lot more cavity --
 * more surface, more shelving, more glass -- so it takes longer and costs
 * more. An earlier draft explained it as "the only oven, so it does all the
 * cooking", which was wrong and confusing; Chris corrected it. Because the
 * ladder is now plainly by size, it needs no defending on the page.
 */

get_header();
?>

<main id="loc-range-pricing">

	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">Range Cookers</p>
			<h1>What a range cooker <span>actually costs</span></h1>
			<p class="loc-page-header__intro">Got a big or complicated range? Don&rsquo;t assume it&rsquo;s out of reach. Prices start at &pound;55 for a single cavity &mdash; tell me what you want cleaning and that&rsquo;s what you&rsquo;ll pay for.</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
		</div>
	</section>

	<!-- THE POINT OF THE PAGE -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p>Most oven cleaners quote a range cooker as one price, whatever you actually want doing. That works fine if you want the lot. It&rsquo;s no use at all if you just want the main oven sorted before Christmas and you&rsquo;d rather not spend a fortune.</p>
			<p>So I price a range by its parts. Count what you want cleaned, add it up, and that&rsquo;s roughly your number. I&rsquo;ll confirm it properly before I start &mdash; but you won&rsquo;t get a surprise.</p>
		</div>
	</section>

	<!-- COMPONENT PRICES -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">The Parts</p>
			<h2>What each bit costs</h2>

			<div class="loc-location-prices">
				<div class="loc-location-price"><span>Extra large full width oven</span><span>&pound;90</span></div>
				<div class="loc-location-price"><span>Main cavities</span><span>&pound;55</span></div>
				<div class="loc-location-price"><span>Side cavities</span><span>&pound;35</span></div>
				<div class="loc-location-price"><span>Grill cavities</span><span>&pound;15</span></div>
				<div class="loc-location-price"><span>Hob &mdash; 4 rings</span><span>&pound;25</span></div>
				<div class="loc-location-price"><span>Hob &mdash; 5 or 6 rings</span><span>&pound;35</span></div>
				<div class="loc-location-price"><span>Hob &mdash; 7 or 8 rings</span><span>&pound;45</span></div>
			</div>

			<p>The outside of the cooker is included &mdash; door fronts, handles, knobs and pan supports all come as part of whatever you have cleaned. There is no separate charge for it.</p>

		</div>
	</section>

	<!-- WORKED EXAMPLES -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Real Examples</p>
			<h2>Find the one that looks like yours</h2>

			<?php
			// SINGLE SOURCE OF TRUTH for this section: the figures a customer
			// reads and the payload carried into the funnel both come from this
			// array, so they cannot disagree.
			//
			// DURATION: every example below is a whole-appliance clean, so they
			// all book the Full Range Clean slot -- 240 minutes, matching
			// baseDurations in functions.php. Do NOT add per-example durations
			// here; a second place that knows about timings is a second place to
			// drift out of sync, which is exactly how a renamed panel silently
			// booked zero minutes earlier in this build.
			$loc_range_examples = [
				[
					"title" => "One big oven and a hob",
					"sum"   => "Extra large full width oven &pound;90 &nbsp;+&nbsp; 5-ring hob &pound;35",
					"total" => 125,
					"label" => "Range cooker: full width oven + hob",
				],
				[
					"title" => "Two ovens and a hob",
					"sum"   => "Main cavity &pound;55 &nbsp;+&nbsp; side cavity &pound;35 &nbsp;+&nbsp; 5-ring hob &pound;35",
					"total" => 125,
					"label" => "Range cooker: main + side cavity + hob",
				],
				[
					"title" => "Three cavities and a hob",
					"sum"   => "Main &pound;55 &nbsp;+&nbsp; side cavity &pound;35 &nbsp;+&nbsp; grill &pound;15 &nbsp;+&nbsp; 5-ring hob &pound;35",
					"total" => 140,
					"label" => "Range cooker: main + side + grill + hob",
				],
				[
					"title" => "Four cavities and a big hob",
					"sum"   => "Two mains &pound;110 &nbsp;+&nbsp; two grills &pound;30 &nbsp;+&nbsp; 6-ring hob &pound;35",
					"total" => 175,
					"label" => "Range cooker: 2 mains + 2 grills + hob",
				],
			];
			?>
			<div class="loc-rangecalc">
				<?php foreach ( $loc_range_examples as $ex ) : ?>
					<div class="loc-rangecalc__item">
						<h3 class="loc-rangecalc__title"><?php echo $ex["title"]; ?></h3>
						<p class="loc-rangecalc__sum"><?php echo $ex["sum"]; ?></p>
						<p class="loc-rangecalc__total">&pound;<?php echo (int) $ex["total"]; ?></p>
						<button type="button" class="btn-primary loc-rangecalc__cta" data-duration="240" data-total="<?php echo esc_attr( $ex["total"] ); ?>" data-label="<?php echo esc_attr( $ex["label"] ); ?>">Reserve this &rarr;</button>
					</div>
				<?php endforeach; ?>
				<!-- Fallback card: someone whose range matches none of the examples can
				     still convert here rather than leaving the page. Books the Partial
				     slot (120), not the Full 240, because the scope is unknown until
				     the call. -->
				<div class="loc-rangecalc__item">
					<h3 class="loc-rangecalc__title">Yours isn&rsquo;t listed?</h3>
					<p class="loc-rangecalc__sum">Nothing here is fixed in stone. Tell me what&rsquo;s in your range and I&rsquo;ll price it exactly the same way.</p>
					<p class="loc-rangecalc__total">From &pound;55</p>
					<button type="button" class="btn-primary loc-rangecalc__cta" data-duration="120" data-total="55" data-label="Range cooker: partial clean, details on the call">Reserve this &rarr;</button>
				</div>
			</div>
		</div>
	</section>

	<!-- WHAT YOU DON'T HAVE TO DO -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">You Choose</p>
			<h2>You don&rsquo;t have to have it all done</h2>
			<p>This is the bit worth knowing. If the hob is fine and it&rsquo;s only the main oven that&rsquo;s bothering you, then that&rsquo;s all I&rsquo;ll clean and that&rsquo;s all you&rsquo;ll pay for &mdash; a single cavity on its own starts at &pound;55, the same as an ordinary single oven.</p>
			<p>When you reserve, pick <strong>Partial Range Clean</strong> and tell me on the call what you want doing. Pick <strong>Full Range Clean</strong> if you want the lot.</p>
			<p>Storage drawers, warming compartments and anything unusual &mdash; mention them on the call and I&rsquo;ll sort it then.</p>
		</div>
	</section>

	<!-- HONEST LIMITS -->
	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What the result looks like</h2>
			<p>Ranges are usually older and harder worked than a built-in oven, so it&rsquo;s worth saying plainly: I&rsquo;ll get the carbon and grease off, and on most ranges the difference is bigger than people expect. What I won&rsquo;t do is promise showroom condition. Discolouration, staining, pitting, scratches and heat damage are marks in the material itself rather than dirt sitting on top of it, and nobody can clean those out.</p>
			<p>If a range is far heavier going than it looked, I&rsquo;ll say so and re-quote before I start &mdash; never after I&rsquo;ve finished.</p>
			<p><a href="/faq">Read the FAQs &rarr;</a></p>
		</div>
	</section>

	<!-- CTA -->
	<section class="loc-location-cta">
		<div class="loc-location-cta__inner">
			<p class="loc-location-cta__tagline">Not sure which bits you need doing?</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
			<p class="loc-location-cta__sub">Reserve a slot and we&rsquo;ll work it out on the call. No card needed, and nothing is booked in until you&rsquo;re happy with the price.</p>
			<p class="loc-location-cta__back"><a href="/services">&larr; See everything I clean</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
