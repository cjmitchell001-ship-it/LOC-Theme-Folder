<?php
/**
 * Template Name: Service Page
 *
 * Per-appliance pages at /services/single-oven/, /services/extractor-hood/,
 * /services/hob/. Slug-driven, same pattern as page-location.php.
 *
 * WHY THESE EXIST. /services/ lists eleven appliances on one page, so it
 * competes for every appliance query at once and wins none of them
 * specifically. "extractor cleaning leicester" and "hob cleaning leicester"
 * are real searches with nothing on this site aimed at them.
 *
 * THE 85% RULE DOES NOT BITE HERE, and that is the point. Location pages are
 * hard because two towns genuinely are similar; an extractor hood has almost
 * nothing in common with a hob, so these pages differ naturally rather than by
 * effort. If a future service page ever reads like a reworded sibling, that is
 * a sign the page has nothing real to say and should not be published.
 *
 * WHAT MAKES THESE WORTH READING: the process section. Competitors publish a
 * price and a promise. Nobody publishes what actually happens to the appliance,
 * or what will not come off. That is the whole differentiator -- do not let it
 * get trimmed into marketing copy.
 *
 * PHOTOS reuse the .webp already generated for /before-and-after/, so a service
 * page costs no new images. 'pairs' is empty where no photo has been approved
 * in the tracker; the section then does not render at all rather than showing
 * a placeholder. 'singles' does the same job for an appliance where the
 * tracker has an after shot but no usable before -- a hob is often half
 * apart before there is any point reaching for a phone.
 */

get_header();

$slug = get_post_field( 'post_name', get_the_ID() );

$loc_services = [

	/* ---------------------------------------------------------------- */
	'single-oven' => [
		'name'     => 'Single Oven',
		'add'      => 'Single Oven',
		'h1'       => 'Single Oven Cleaning',
		'price'    => 'From &pound;55',
		'subline'  => 'Around two hours &middot; Leicester and Leicestershire',
		'intro'    => 'The most common job I do, and the one people are most surprised by &mdash; not because of the result, but because of how much comes out of an oven that looked "not that bad" with the door shut.',
		'intro_2'  => 'It is a strip-down clean, and the appliance goes back together before I leave.',

		'process_lead' => 'What actually happens to your oven:',
		'process' => [
			'The door comes apart so both faces of the inner glass are cleaned. This is the bit most people have never seen done &mdash; the film between the panes is why an oven still looks dirty after it has been wiped out.',
			'Racks, runners and trays come out and are soaked separately rather than scrubbed in place.',
			'The fan housing and the back panel are cleaned behind, not just around.',
			'Seals, the door frame and the hinge area are cleaned by hand, because they are the parts that hold grease and the parts a spray-and-wipe misses.',
			'Everything is reassembled and you look at it with me before I pack up.',
		],

		'price_note' => 'A single oven starts at &pound;55. A heavily built-up oven takes longer, and if that is what I find I will say so and re-quote before I start &mdash; never after I have finished.',

		'pairs' => [
			[ 'slug' => 'tracy-birstall-single-oven',       'label' => 'Birstall' ],
			[ 'slug' => 'graham-thorpe-astley-single-oven', 'label' => 'Thorpe Astley' ],
			[ 'slug' => 'janine-lutterworth-single-oven',   'label' => 'Lutterworth' ],
		],
		'photos_cap' => 'Three single ovens, before and after. All shot on my phone on the day.',

		'limits' => 'I will get the carbon and grease off, and on most ovens the difference is bigger than people expect. What I will not promise is showroom condition. Discolouration, staining, pitting, scratches and heat damage are marks in the material itself rather than dirt sitting on top of it, and nobody can clean those out. If that is what I think you are looking at, I will tell you before I start.',

		'faqs' => [
			[
				'q' => 'How long does a single oven take?',
				'a' => 'Usually under two hours. A well-kept oven can be quicker; one that has not been cleaned in several years takes longer. I give you a realistic window on the confirmation call rather than a number that suits my diary.',
			],
			[
				'q' => 'Can you get the inside of the door glass clean?',
				'a' => 'Yes &mdash; the door comes apart so both faces get done, and that is included in the price rather than charged as an extra. The exception is glass that is etched or heat-marked rather than dirty, which will not come back however long it is worked on.',
			],
			[
				'q' => 'Do I need to do anything before you arrive?',
				'a' => 'Take anything out of the oven that you want to keep, and make sure I can get to it. I need power and access to hot water. Beyond that, nothing &mdash; you do not need to pre-clean anything, and please do not run a self-clean cycle first.',
			],
			[
				'q' => 'Is my oven too old to be worth cleaning?',
				'a' => 'Usually not, but age changes what is realistic. Older appliances are more likely to have seals that have hardened, elements that are near the end of their life, or enamel that has already discoloured. I look the appliance over with you before anything starts and tell you honestly what a clean will and will not achieve.',
			],
		],

		'related' => [
			[ 'name' => 'Extractor hood cleaning', 'url' => '/services/extractor-hood/' ],
			[ 'name' => 'Hob cleaning',            'url' => '/services/hob/' ],
		],
	],

	/* ---------------------------------------------------------------- */
	'extractor-hood' => [
		'name'     => 'Extractor Hood',
		'add'      => 'Extractor Hood',
		'h1'       => 'Extractor Hood Cleaning',
		'price'    => 'From &pound;25',
		'subline'  => 'Usually added to an oven clean &middot; Leicester and Leicestershire',
		'intro'    => 'The appliance people forget, and the one that quietly does the most work. An extractor pulls grease out of the air every time you cook, and most of it never leaves &mdash; it collects in the filters and on the underside of the canopy.',
		'intro_2'  => 'It is also the job with the clearest safety argument. A filter saturated with grease sitting directly above a gas flame is not a cosmetic problem.',

		'process_lead' => 'What actually happens to your extractor:',
		'process' => [
			'The metal mesh filters come out and are soaked rather than wiped &mdash; grease in a mesh filter sits in the layers, not on the surface, so wiping only cleans what you can see.',
			'The underside of the canopy is degreased, including the recess around the filter housing where the build-up is usually worst.',
			'The visible exterior is cleaned to match, so it does not end up clean underneath and greasy on top.',
			'Filters go back in once they are dry.',
		],


		'price_note' => 'Extractor hoods start at &pound;25 and vary with how much has built up in the filters. Most are done alongside an oven clean in the same visit &mdash; there is no second call-out charge for adding one.',

		'pairs' => [
			[ 'slug' => 'rosemary-birstall-extractor', 'label' => 'Birstall' ],
		],
		'photos_cap' => 'An extractor hood in Birstall, before and after.',

		'limits' => 'Filters that have been left long enough will come out clean but not new &mdash; aluminium mesh discolours permanently once grease has been baked into it, and that staining is in the metal rather than on it. If a filter is perished or misshapen, cleaning it will not fix that and a replacement is cheap. I will tell you if that is what I am looking at.',

		'faqs' => [
			[
				'q' => 'How often should an extractor be cleaned?',
				'a' => 'It depends far more on how you cook than on how long it has been. Frying and roasting load the filters quickly; a household that mostly boils and bakes can go a great deal longer. If you hold a filter up to the light and cannot see through the mesh, it is overdue.',
			],
			[
				'q' => 'Can you clean the ducting or the fan itself?',
				'a' => 'What I clean is the filters, the canopy and the exterior &mdash; that is where the grease actually collects, and it is what makes the difference to how the hood performs. Ducting and internal parts are a separate job; tell me what the hood is doing and I will let you know whether it is something I can help with.',
			],
			[
				'q' => 'My filters are the paper or carbon type. Can those be cleaned?',
				'a' => 'Carbon filters cannot be cleaned &mdash; they are consumable and are meant to be replaced, usually every six to twelve months. Only metal mesh filters can be degreased. If yours are carbon I will say so rather than charge you to wash something that needs binning.',
			],
		],

		'related' => [
			[ 'name' => 'Single oven cleaning', 'url' => '/services/single-oven/' ],
			[ 'name' => 'Hob cleaning',         'url' => '/services/hob/' ],
		],
	],

	/* ---------------------------------------------------------------- */
	/* HOB. Two approved afters, no pair. Both are in the tracker; neither job
	 * has a usable before, which is normal for a hob -- the caps and crowns are
	 * usually off before there is anything worth photographing. The two are
	 * deliberately different appliances, a stainless gas hob and a black glass
	 * one, because "will you wreck my glass hob" is the question this page
	 * exists to answer. */
	'hob' => [
		'name'     => 'Hob',
		'add'      => '',
		'h1'       => 'Hob Cleaning',
		'price'    => 'From &pound;25',
		'subline'  => 'Gas, ceramic or induction &middot; Leicester and Leicestershire',
		'intro'    => 'Hobs are where burnt-on spills live. Most people keep the surface wiped and assume that is that &mdash; the build-up is underneath the burners, around the seals and in the pan support feet, where a cloth never reaches.',
		'intro_2'  => 'How a hob is cleaned depends entirely on what sort it is, and getting that wrong causes damage. So it is worth saying what I actually do to each.',

		'process_lead' => 'What actually happens, by hob type:',
		'process' => [
			'<strong>Gas.</strong> Burner caps, crowns and pan supports come off and are soaked, so the carbon on the underside comes away rather than being scrubbed around. The recesses beneath are cleaned by hand.',
			'<strong>Ceramic and induction.</strong> The glass is cleaned with the right product and a bit of patience, so burnt-on residue lifts away rather than being forced.',
			'<strong>All types.</strong> Control knobs, the surround and the seal line where the hob meets the worktop &mdash; the last of these is usually the dirtiest part and almost always the part that has never been cleaned.',
		],


		'price_note' => 'Hobs start at &pound;25 whether they are gas, ceramic or induction. A six-burner range hob with heavy build-up sits above that, and I will confirm before starting.',

		'pairs' => [],
		'singles' => [
			[ 'slug' => 'cassie-birstall-hob', 'label' => 'Birstall',  'w' => 600, 'h' => 800 ],
			[ 'slug' => 'lin-hamilton-hob',    'label' => 'Hamilton',  'w' => 600, 'h' => 800 ],
		],
		'photos_cap' => 'Two gas hobs, finished. Different appliances, same job.',

		'limits' => 'Marks already etched into ceramic glass will not come back &mdash; that is damage in the surface rather than dirt on it. Gas burner caps discolour with heat and stay discoloured however clean they are; that is the enamel changing, not dirt. Pan supports usually clean up very well, but cast iron ones that have started to rust will still be rusty afterwards.',

		'faqs' => [
			[
				'q' => 'How long does a hob take?',
				'a' => 'On its own, usually well under an hour. A six-burner gas hob with a lot of build-up around the burners takes longer than a flat ceramic surface. Most hobs are done alongside an oven in the same visit, so it adds time to the appointment rather than making a separate one.',
			],
			[
				'q' => 'Can you clean the hob at the same time as the oven?',
				'a' => 'Yes, and most people do. It is priced per appliance and added up rather than bundled, but it is one visit and there is no second call-out charge.',
			],
			[
				'q' => 'My gas hob has not been lighting properly. Can you fix that while you are here?',
				'a' => 'Not gas work, no &mdash; that needs a Gas Safe registered engineer. I will clean the hob and tell you anything I notice while I am there.',
			],
		],

		'related' => [
			[ 'name' => 'Single oven cleaning',    'url' => '/services/single-oven/' ],
			[ 'name' => 'Extractor hood cleaning', 'url' => '/services/extractor-hood/' ],
		],
	],

];

if ( ! isset( $loc_services[ $slug ] ) ) {
	get_template_part( '404' );
	get_footer();
	return;
}

$s = $loc_services[ $slug ];
$loc_gallery_dir = get_stylesheet_directory_uri() . '/images/gallery/';
?>

<main id="loc-service-page">

	<section class="loc-page-header">
		<div class="loc-page-header__inner">
			<p class="loc-page-header__eyebrow section-eyebrow">What I Clean</p>
			<h1><?php echo $s['h1']; ?></h1>
			<p class="loc-location__price-anchor"><?php echo $s['price']; ?> &middot; no travel charge</p>
			<p class="loc-location__subline"><?php echo $s['subline']; ?></p>
			<a href="<?php echo empty( $s['add'] ) ? '/reserve-step-1/' : '/reserve-step-1/?add=' . rawurlencode( $s['add'] ); ?>" class="btn-primary">Reserve Your Slot &rarr;</a>
		</div>
	</section>

	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p><?php echo $s['intro']; ?></p>
			<p><?php echo $s['intro_2']; ?></p>
		</div>
	</section>

	<!-- THE PROCESS — the reason this page is worth reading. Competitors
	     publish a price and a promise; none of them publish this. -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">The Job Itself</p>
			<h2>What I actually do</h2>
			<p><?php echo $s['process_lead']; ?></p>
			<ul class="loc-service-process">
				<?php foreach ( $s['process'] as $step ) : ?>
					<li><?php echo $step; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php if ( ! empty( $s['process_note'] ) ) : ?>
				<p class="loc-service-note"><?php echo $s['process_note']; ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Price</p>
			<h2>What it costs</h2>
			<p><?php echo $s['price_note']; ?></p>
			<p>Prices are confirmed before I start, not after I finish.</p>
			<p><a href="/services/">See everything I clean &rarr;</a></p>
		</div>
	</section>

	<?php if ( ! empty( $s['pairs'] ) || ! empty( $s['singles'] ) ) : ?>
	<section class="loc-gallery-section loc-gallery-section--alt">
		<div class="loc-gallery-section__inner">
			<p class="section-eyebrow">Real Work</p>
			<h2>Jobs I&rsquo;ve done</h2>
			<p class="loc-gallery-singles__intro"><?php echo $s['photos_cap']; ?></p>
			<div class="loc-gallery">
				<?php foreach ( $s['pairs'] as $p ) : ?>
					<figure class="loc-gallery__item">
						<div class="loc-gallery__pair">
							<div class="loc-gallery__shot">
								<img src="<?php echo esc_url( $loc_gallery_dir . $p['slug'] . '-before.webp' ); ?>"
								     width="600" height="800" loading="lazy" decoding="async"
								     alt="<?php echo esc_attr( $s['name'] . ' in ' . $p['label'] . ' before cleaning' ); ?>">
								<span class="loc-gallery__tag loc-gallery__tag--before">Before</span>
							</div>
							<div class="loc-gallery__shot">
								<img src="<?php echo esc_url( $loc_gallery_dir . $p['slug'] . '-after.webp' ); ?>"
								     width="600" height="800" loading="lazy" decoding="async"
								     alt="<?php echo esc_attr( $s['name'] . ' in ' . $p['label'] . ' after cleaning' ); ?>">
								<span class="loc-gallery__tag loc-gallery__tag--after">After</span>
							</div>
						</div>
						<figcaption class="loc-gallery__caption">
							<span class="loc-gallery__what"><?php echo esc_html( $s['name'] . ' &mdash; ' . $p['label'] ); ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
			<?php if ( ! empty( $s['singles'] ) ) : ?>
			<div class="loc-gallery-singles">
				<?php foreach ( $s['singles'] as $p ) : ?>
					<figure class="loc-gallery-singles__item">
						<div class="loc-gallery-singles__shot">
							<img src="<?php echo esc_url( $loc_gallery_dir . $p['slug'] . '.webp' ); ?>"
							     width="<?php echo (int) $p['w']; ?>" height="<?php echo (int) $p['h']; ?>"
							     loading="lazy" decoding="async"
							     alt="<?php echo esc_attr( $s['name'] . ' in ' . $p['label'] . ' after cleaning' ); ?>">
							<span class="loc-gallery__tag loc-gallery__tag--after">After</span>
						</div>
						<figcaption class="loc-gallery__caption">
							<span class="loc-gallery__what"><?php echo esc_html( $s['name'] ); ?> &mdash; <?php echo esc_html( $p['label'] ); ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			<p><a href="/before-and-after/">See more before and afters &rarr;</a></p>
		</div>
	</section>
	<?php endif; ?>

	<!-- HONEST LIMITS — must stay in step with page-faq.php's "Will my oven
	     look brand new?" answer. Never soften to "like new". -->
	<section class="loc-location-section loc-location-section--alt">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Honest Expectations</p>
			<h2>What won&rsquo;t come off</h2>
			<p><?php echo $s['limits']; ?></p>
			<p><a href="/faq">Read my FAQs &rarr;</a></p>
		</div>
	</section>

	<section class="loc-location-section">
		<div class="loc-location-section__inner">
			<p class="section-eyebrow">Questions</p>
			<h2><?php echo $s['name']; ?> cleaning &mdash; common questions</h2>
			<div class="loc-location-faqs">
				<?php foreach ( $s['faqs'] as $f ) : ?>
					<details class="loc-location-faq">
						<summary class="loc-location-faq__q"><?php echo $f['q']; ?></summary>
						<p class="loc-location-faq__a"><?php echo $f['a']; ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $s['related'] ) ) : ?>
		<section class="loc-location-section loc-location-section--alt">
			<div class="loc-location-section__inner">
				<p class="section-eyebrow">Also</p>
				<h2>Other things I clean</h2>
				<ul class="loc-location-nearby">
					<?php foreach ( $s['related'] as $r ) : ?>
						<li><a href="<?php echo $r['url']; ?>"><?php echo $r['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<section class="loc-location-cta">
		<div class="loc-location-cta__inner">
			<p class="loc-location-cta__tagline">Ready to get it sorted?</p>
			<a href="<?php echo empty( $s['add'] ) ? '/reserve-step-1/' : '/reserve-step-1/?add=' . rawurlencode( $s['add'] ); ?>" class="btn-primary">Reserve Your Slot &rarr;</a>
			<p class="loc-location-cta__sub">No card needed to reserve. I&rsquo;ll call to confirm the price before anything is booked in.</p>
			<p class="loc-location-cta__back"><a href="/services/">&larr; See everything I clean</a></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
