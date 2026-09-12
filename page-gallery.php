<?php
/**
 * Template Name: Before and After Gallery
 *
 * Real before/after pairs from completed jobs, at /before-and-after/.
 *
 * WHERE THE PHOTOS COME FROM: Chris selects them in
 * 06-Trackers/LOC-Photo-Selection-Tracker.xlsx in the LOC knowledge-base repo,
 * one row per pair. Anything in that sheet is consent-cleared by the act of
 * being put there -- that is a standing rule, so do not add consent caveats
 * here. If a photo is not in the sheet, it is not approved and will not exist
 * in this array.
 *
 * The .webp files in images/gallery/ are generated from the originals in
 * 03-Operations/Job-Photos/. Portraits are cropped to 600x800, the one
 * odd-shaped pair to 700x700. Do NOT hand-edit the images -- regenerate them
 * from the tracker so the sheet stays the single source of truth.
 *
 * ORDER: newest job first. A gallery that opens on eight-week-old work reads
 * as a business that has gone quiet.
 *
 * OWN APPLIANCE: entries flagged 'own' are Chris's own cooker, not a
 * customer's. They are captioned as his so the page never passes his own
 * kitchen off as customer work. That flag comes from the tracker's
 * "Own Appliance" column -- keep it in step.
 */

get_header();

// SINGLE SOURCE OF TRUTH for this page. Mirrors the tracker; regenerate rather
// than editing by hand. 'square' switches the card to the 700x700 crop.
$loc_gallery = [
	[ "slug" => "megan-blaby-single-oven",         "appliance" => "Single oven",          "area" => "Blaby",           "when" => "September 2026" ],
	[ "slug" => "melissa-scraptoft-single-oven",   "appliance" => "Single oven",          "area" => "Scraptoft",       "when" => "September 2026" ],
	[ "slug" => "melissa-scraptoft-single-oven-2", "appliance" => "Single oven",          "area" => "Scraptoft",       "when" => "September 2026" ],
	[ "slug" => "mandy-mountsorrel-oven-exterior",  "appliance" => "Oven exterior",        "area" => "Mountsorrel",     "when" => "September 2026" ],
	[ "slug" => "nathan-coalville-grill",           "appliance" => "Grill",                "area" => "Coalville",       "when" => "August 2026", "square" => true ],
	[ "slug" => "janine-lutterworth-single-oven",     "appliance" => "Single oven",          "area" => "Lutterworth",     "when" => "August 2026" ],
	[ "slug" => "graham-thorpe-astley-single-oven",   "appliance" => "Single oven",          "area" => "Thorpe Astley",   "when" => "August 2026" ],
	[ "slug" => "aidan-clarendon-park-single-oven",   "appliance" => "Single oven",          "area" => "Clarendon Park",  "when" => "August 2026" ],
	[ "slug" => "jon-mountsorrel-single-oven",        "appliance" => "Single oven",          "area" => "Mountsorrel",     "when" => "August 2026" ],
	[ "slug" => "sunita-wigston-single-oven",         "appliance" => "Single oven",          "area" => "Wigston",         "when" => "August 2026" ],
	[ "slug" => "janet-syston-single-oven",           "appliance" => "Single oven",          "area" => "Syston",          "when" => "August 2026" ],
	[ "slug" => "disha-syston-double-oven",           "appliance" => "Double oven",          "area" => "Syston",          "when" => "August 2026" ],
	[ "slug" => "steve-enderby-single-oven",          "appliance" => "Single oven",          "area" => "Enderby",         "when" => "July 2026" ],
	[ "slug" => "tracy-birstall-single-oven",         "appliance" => "Single oven",          "area" => "Birstall",        "when" => "July 2026" ],
	[ "slug" => "rosemary-birstall-single-oven",      "appliance" => "Single oven",          "area" => "Birstall",        "when" => "July 2026" ],
	[ "slug" => "rosemary-birstall-extractor",        "appliance" => "Extractor hood",       "area" => "Birstall",        "when" => "July 2026" ],
	[ "slug" => "rosemary-birstall-door",             "appliance" => "Oven door glass",      "area" => "Birstall",        "when" => "July 2026", "square" => true ],
	[ "slug" => "home-syston-delonghi-range-cooker",  "appliance" => "DeLonghi range cooker", "area" => "Syston",         "when" => "July 2026", "own" => true ],
	[ "slug" => "home-syston-delonghi-range-cooker-2","appliance" => "DeLonghi range cooker", "area" => "Syston",         "when" => "July 2026", "own" => true ],
];


/**
 * FINISHED RESULTS -- photos Chris selected where no usable "before" exists.
 *
 * These are NOT rejects. Standing rule from Chris (5 Sep 2026): every photo he
 * links in the tracker is a deliberate choice for that job, and a pair is not
 * always possible -- sometimes the before shot simply cannot be taken. Excluding
 * them, as this page did until now, threw away twelve chosen photos.
 *
 * Unlike the pairs, these are NOT cropped. A pair has to match itself, so it
 * gets a square crop; a single stands alone, so it keeps its own shape. That is
 * why the width/height differ per entry -- Saleha's range and Lin's extractor
 * are landscape and would be destroyed by a portrait crop.
 */
$loc_gallery_singles = [
	[ "slug" => "cassie-birstall-hob",             "appliance" => "Gas hob",        "area" => "Birstall",        "when" => "September 2026", "w" => 600, "h" => 800 ],
	[ "slug" => "melissa-scraptoft-oven-exterior", "appliance" => "Oven exterior",  "area" => "Scraptoft",       "when" => "September 2026", "w" => 600, "h" => 800 ],
	[ "slug" => "mandy-mountsorrel-oven-interior",   "appliance" => "Oven interior",  "area" => "Mountsorrel",     "when" => "September 2026", "w" => 600, "h" => 800 ],
	[ "slug" => "mandy-mountsorrel-oven-interior-2", "appliance" => "Oven interior",  "area" => "Mountsorrel",     "when" => "September 2026", "w" => 600, "h" => 800 ],
	[ "slug" => "lin-hamilton-extractor",            "appliance" => "Extractor hood", "area" => "Hamilton",        "when" => "September 2026", "w" => 600, "h" => 445 ],
	[ "slug" => "nathan-coalville-double-oven",      "appliance" => "Double oven",    "area" => "Coalville",       "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "saleha-oadby-range",                "appliance" => "Range cooker",   "area" => "Oadby",           "when" => "August 2026",    "w" => 600, "h" => 338 ],
	[ "slug" => "jenny-wigston-single-oven",         "appliance" => "Single oven",    "area" => "Wigston",         "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "teresa-aylestone-park-double-oven", "appliance" => "Double oven",    "area" => "Aylestone Park",  "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "disha-syston-double-oven-extra",    "appliance" => "Double oven",    "area" => "Syston",          "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "raakhi-syston-double-oven",         "appliance" => "Double oven",    "area" => "Syston",          "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "raakhi-syston-double-oven-2",       "appliance" => "Double oven",    "area" => "Syston",          "when" => "August 2026",    "w" => 600, "h" => 800 ],
	[ "slug" => "tracy-birstall-single-oven-extra",  "appliance" => "Single oven",    "area" => "Birstall",        "when" => "July 2026",      "w" => 600, "h" => 800 ],
	[ "slug" => "lindsey-coalville-single-oven",     "appliance" => "Single oven",    "area" => "Coalville",       "when" => "July 2026",      "w" => 600, "h" => 800 ],
];
$loc_gallery_dir = get_stylesheet_directory_uri() . "/images/gallery/";
?>

<main id="loc-gallery-page">

	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">Before &amp; After</p>
			<h1>Real ovens. <span>Real results.</span></h1>
			<p class="loc-page-header__intro">Every photo on this page is a job I&rsquo;ve done, shot on my phone before I started and again once I&rsquo;d finished. No stock images, no showroom kitchens, nothing borrowed from a supplier.</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
		</div>
	</section>

	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p>The honest reason this page exists: everyone in this trade says they do a good job, and you&rsquo;ve no way of telling until someone is stood in your kitchen. So here&rsquo;s the work instead. Same oven, same angle, an hour or two apart.</p>
		</div>
	</section>

	<section class="loc-gallery-section">
		<div class="loc-gallery-section__inner">
			<div class="loc-gallery">
				<?php foreach ( $loc_gallery as $i => $g ) :
					$square = ! empty( $g["square"] );
					$w = $square ? 700 : 600;
					$h = $square ? 700 : 800;
					$own = ! empty( $g["own"] );
					$caption = $own
						? $g["appliance"] . " &mdash; my own, " . $g["area"]
						: $g["appliance"] . " &mdash; " . $g["area"];
					// First two load eagerly so the page has something above the
					// fold immediately; the rest are lazy.
					$loading = $i < 2 ? "eager" : "lazy";
				?>
				<figure class="loc-gallery__item<?php echo $square ? " loc-gallery__item--square" : ""; ?>">
					<div class="loc-gallery__pair">
						<div class="loc-gallery__shot">
							<img src="<?php echo esc_url( $loc_gallery_dir . $g["slug"] . "-before.webp" ); ?>"
							     width="<?php echo $w; ?>" height="<?php echo $h; ?>"
							     loading="<?php echo $loading; ?>" decoding="async"
							     alt="<?php echo esc_attr( $g["appliance"] . " in " . $g["area"] . " before cleaning" ); ?>">
							<span class="loc-gallery__tag loc-gallery__tag--before">Before</span>
						</div>
						<div class="loc-gallery__shot">
							<img src="<?php echo esc_url( $loc_gallery_dir . $g["slug"] . "-after.webp" ); ?>"
							     width="<?php echo $w; ?>" height="<?php echo $h; ?>"
							     loading="<?php echo $loading; ?>" decoding="async"
							     alt="<?php echo esc_attr( $g["appliance"] . " in " . $g["area"] . " after cleaning" ); ?>">
							<span class="loc-gallery__tag loc-gallery__tag--after">After</span>
						</div>
					</div>
					<figcaption class="loc-gallery__caption">
						<span class="loc-gallery__what"><?php echo $caption; ?></span>
						<span class="loc-gallery__when"><?php echo esc_html( $g["when"] ); ?></span>
					</figcaption>
				</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- FINISHED RESULTS -- the singles. Every one of these is a photo Chris
	     deliberately chose for that job; a pair simply was not possible. They
	     keep their own aspect ratio rather than being cropped to match, so the
	     grid has a ragged bottom edge by design. -->
	<section class="loc-gallery-section loc-gallery-section--alt">
		<div class="loc-gallery-section__inner">
			<p class="section-eyebrow">Finished Results</p>
			<h2>Where I couldn&rsquo;t get a before shot</h2>
			<p class="loc-gallery-singles__intro">A before photo isn&rsquo;t always possible &mdash; sometimes the oven&rsquo;s already half apart before I think to reach for my phone. These are finished results from jobs where I only have the after.</p>

			<div class="loc-gallery-singles">
				<?php foreach ( $loc_gallery_singles as $s ) : ?>
					<figure class="loc-gallery-singles__item">
						<div class="loc-gallery-singles__shot">
							<img src="<?php echo esc_url( $loc_gallery_dir . $s["slug"] . ".webp" ); ?>"
							     width="<?php echo (int) $s["w"]; ?>" height="<?php echo (int) $s["h"]; ?>"
							     loading="lazy" decoding="async"
							     alt="<?php echo esc_attr( $s["appliance"] . " in " . $s["area"] . " after cleaning" ); ?>">
							<span class="loc-gallery__tag loc-gallery__tag--after">After</span>
						</div>
						<figcaption class="loc-gallery__caption">
							<span class="loc-gallery__what"><?php echo esc_html( $s["appliance"] ); ?> &mdash; <?php echo esc_html( $s["area"] ); ?></span>
							<span class="loc-gallery__when"><?php echo esc_html( $s["when"] ); ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- HONEST LIMITS -- deliberately on the page that shows the best results,
	     not hidden on the FAQ. Matches the wording used on the range pricing
	     page and in page-faq.php; do not soften it to "like new". -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What these photos don&rsquo;t show</h2>
			<p>Every oven on this page cleaned up well, or it wouldn&rsquo;t be worth showing you. But I&rsquo;d rather say this plainly than have you expecting something I can&rsquo;t deliver: I get the carbon and grease off, and on most ovens the difference is bigger than people expect. What I won&rsquo;t promise is showroom condition.</p>
			<p>Discolouration, staining, pitting, scratches and heat damage are marks in the material itself rather than dirt sitting on top of it, and nobody can clean those out. If that&rsquo;s what you&rsquo;re looking at, I&rsquo;ll tell you before I start rather than after I&rsquo;ve finished.</p>
			<p><a href="/faq">Read the FAQs &rarr;</a></p>
		</div>
	</section>

	<section class="loc-location-cta">
		<div class="loc-location-cta__inner">
			<p class="loc-location-cta__tagline">Want yours on here?</p>
			<a href="/reserve-step-1" class="btn-primary">Reserve Your Slot &rarr;</a>
			<p class="loc-location-cta__sub">No card needed to reserve. I&rsquo;ll call to confirm the price before anything is booked in.</p>
			<p class="loc-location-cta__back"><a href="/services">&larr; See everything I clean</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
