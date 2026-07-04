<?php
/**
 * Leicester Oven Cleaning — functions.php
 *
 * Standalone theme — no parent theme dependency.
 * Loads Google Fonts and the theme stylesheet.
 */

require_once get_stylesheet_directory() . '/calendar-api.php';
require_once get_stylesheet_directory() . '/reservation-handler.php';

add_action( 'wp_ajax_nopriv_loc_reservation', 'loc_handle_reservation' ); // unauthenticated visitors
add_action( 'wp_ajax_loc_reservation',        'loc_handle_reservation' ); // logged-in users

// ============================================================
// GOOGLE CALENDAR AVAILABILITY — WordPress AJAX endpoint
// Replaces direct calendar-ajax.php access, which SiteGround's
// NGINX blocks (all requests routed through WordPress).
// Called via /wp-admin/admin-ajax.php?action=loc_calendar_availability
// ============================================================

function loc_handle_calendar_availability() {
    header( 'Content-Type: application/json' );

    $zone             = isset( $_GET['zone'] )             ? sanitize_text_field( wp_unslash( $_GET['zone'] ) ) : '';
    $duration_minutes = isset( $_GET['duration_minutes'] ) ? intval( $_GET['duration_minutes'] )                : 0;

    if ( $zone === '' || $duration_minutes <= 0 ) {
        echo json_encode( [ 'error' => 'Missing or invalid parameters: zone and duration_minutes are required.' ] );
        wp_die();
    }

    $result = loc_get_available_slots( $zone, $duration_minutes, 180 );

    if ( is_string( $result ) && strpos( $result, 'AUTH_REQUIRED:' ) === 0 ) {
        echo json_encode( [ 'error' => 'Calendar not authorised. Please complete the OAuth flow.' ] );
        wp_die();
    }

    echo json_encode( $result );
    wp_die();
}
add_action( 'wp_ajax_nopriv_loc_calendar_availability', 'loc_handle_calendar_availability' );
add_action( 'wp_ajax_loc_calendar_availability',        'loc_handle_calendar_availability' );

// ============================================================
// GOOGLE CALENDAR OAUTH — WordPress-routed endpoint
// Access: https://leicesterovencleaning.co.uk/?loc_calendar_auth=1
// Must be visited while logged in as a WordPress admin.
// ============================================================

add_action( 'template_redirect', function() {
    if ( empty( $_GET['loc_calendar_auth'] ) || $_GET['loc_calendar_auth'] !== '1' ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorised.', '', [ 'response' => 403 ] );
    }

    $redirectUri = 'https://leicesterovencleaning.co.uk/?loc_calendar_auth=1';
    $client      = loc_get_google_client();
    $client->setRedirectUri( $redirectUri );

    global $_LOC_TOKEN_FILE;

    if ( isset( $_GET['code'] ) ) {
        $token = $client->fetchAccessTokenWithAuthCode( sanitize_text_field( wp_unslash( $_GET['code'] ) ) );

        if ( isset( $token['error'] ) ) {
            wp_die( 'Google OAuth error: ' . esc_html( $token['error_description'] ?? $token['error'] ) );
        }

        $client->setAccessToken( $token );
        file_put_contents( $_LOC_TOKEN_FILE, json_encode( $token ) );

        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Calendar Connected</title></head><body style="font-family:sans-serif;padding:2em;">';
        echo '<h2 style="color:#1A3A6E;">&#10003; Calendar connected successfully.</h2>';
        echo '<p>You can close this window.</p>';
        echo '<p style="color:#888;font-size:0.9em;">token.json has been saved to the theme folder.</p>';
        echo '</body></html>';
        exit;
    }

    $authUrl = $client->createAuthUrl();
    wp_redirect( filter_var( $authUrl, FILTER_SANITIZE_URL ) );
    exit;
} );
// ============================================================
// ENQUEUE GOOGLE FONTS + THEME STYLESHEET
// ============================================================

function loc_enqueue_styles() {

    // 1. Load Google Fonts — Montserrat (headings) + Open Sans (body)
    wp_enqueue_style(
        'loc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&family=Open+Sans:wght@400;600&display=swap',
        array(),
        null
    );

    // 2. Load theme stylesheet
    wp_enqueue_style(
        'loc-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'loc-google-fonts' ),
        wp_get_theme()->get( 'Version' )
    );

}
add_action( 'wp_enqueue_scripts', 'loc_enqueue_styles' );


// ============================================================
// ADD CUSTOM FUNCTIONS BELOW THIS LINE
// ============================================================

// (Nothing else needed here yet — add template-specific
//  functions as each page is built.)
// Hamburger menu toggle
function loc_hamburger_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var hamburger = document.getElementById('loc-hamburger');
        var mobileMenu = document.getElementById('loc-mobile-menu');

        if (hamburger && mobileMenu) {

            // Click hamburger — toggle menu and X animation
            hamburger.addEventListener('click', function() {
                var isOpen = mobileMenu.classList.contains('is-open');

                if (isOpen) {
                    // Close
                    mobileMenu.classList.remove('is-open');
                    hamburger.classList.remove('is-open');
                } else {
                    // Open
                    mobileMenu.classList.add('is-open');
                    hamburger.classList.add('is-open');
                }

                // Remove focus from button immediately so it never persists highlighted
                hamburger.blur();
            });

            // Click anywhere outside dropdown — close menu
            document.addEventListener('click', function(event) {
                var clickedInsideMenu = mobileMenu.contains(event.target);
                var clickedHamburger = hamburger.contains(event.target);

                if (!clickedInsideMenu && !clickedHamburger) {
                    mobileMenu.classList.remove('is-open');
                    hamburger.classList.remove('is-open');
                    hamburger.blur();
                }
            });
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'loc_hamburger_script');
// Hero carousel and rotating taglines
function loc_hero_script() {
    if ( ! is_front_page() ) return;
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // TAGLINES — edit these freely without touching anything else
        var taglines = [
            'Professional oven cleaning in Leicester & Leicestershire',
            'Extractor hoods cleaned and degreased — same visit, same fixed price',
            'Gas hobs restored to factory clean — no hidden extras',
            'Ceramic and induction hobs — spotless without the scratches',
            'Small business? We work around you — minimal disruption guaranteed',
            'Staff kitchens and office facilities — ask about our business rates',
            'Multiple appliances, single visit — enquire about our commercial service'
        ];

        var slides = document.querySelectorAll('.loc-hero__slide');
        var tagline = document.getElementById('loc-hero-tagline');
        var current = 0;

        function goToSlide(index) {
            // Remove active from current slide
            slides[current].classList.remove('is-active');

            // Fade out tagline
            tagline.classList.add('is-fading');

            // After tagline fades out, swap text and fade back in
            setTimeout(function() {
                current = index;
                tagline.textContent = taglines[current];
                tagline.classList.remove('is-fading');

                // Fade in new slide
                slides[current].classList.add('is-active');
            }, 600);
        }

        function nextSlide() {
            var next = (current + 1) % slides.length;
            goToSlide(next);
        }

        // Auto advance every 5 seconds
        var timer = setInterval(nextSlide, 5000);

        // Pause on hover
        var hero = document.getElementById('loc-hero');
        if (hero) {
            hero.addEventListener('mouseenter', function() {
                clearInterval(timer);
            });
            hero.addEventListener('mouseleave', function() {
                timer = setInterval(nextSlide, 5000);
            });
        }

    });
    </script>
    <?php
}
add_action('wp_footer', 'loc_hero_script');
// Contact page enquiry type selector
function loc_contact_script() {
    if (is_page('contact')) {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var btns = document.querySelectorAll('.loc-enquiry-btn');
        btns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                btns.forEach(function(b) {
                    b.classList.remove('loc-enquiry-btn--selected');
                });
                btn.classList.add('loc-enquiry-btn--selected');
            });
        });
    });
    </script>
    <?php
    }
}
add_action('wp_footer', 'loc_contact_script');
// Auto-assign legal page template by slug
function loc_legal_template($template) {
    $legal_slugs = [
        'privacy-policy',
        'terms-and-conditions',
        'cancellation-policy',
        'cookie-policy',
    ];
    if (is_page() && in_array(get_post_field('post_name', get_the_ID()), $legal_slugs)) {
        $new_template = get_stylesheet_directory() . '/page-legal.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'loc_legal_template');
// ============================================================
// STEP 1 — APPLIANCE SELECTION SCRIPT
// Paste this function into functions.php
// ============================================================

function loc_step1_script() {
    if ( ! is_page( 'reserve-step-1' ) ) return;
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // ── STATE ──
        var selections  = {};
        var isSkipped   = false;
        var skipBtn     = document.getElementById('loc-skip-btn');

        // ── STANDARD CARDS (qty stepper) ──
        var cards = document.querySelectorAll('.loc-appliance-card:not(.loc-appliance-card--aga)');
        cards.forEach(function(card) {
            var stepperPanel = card.querySelector('.loc-aga-options');
            var minusBtn     = card.querySelector('.loc-qty-btn--minus');
            var plusBtn      = card.querySelector('.loc-qty-btn--plus');
            var priceEl      = card.querySelector('.loc-appliance-card__price');
            var basePrice    = parseInt(card.dataset.price, 10);
            var name         = card.dataset.name;
            var qty          = 0;

            function updateCard() {
                if (qty === 0) {
                    delete selections[name];
                    card.classList.remove('is-selected');
                    stepperPanel.classList.remove('is-visible');
                    priceEl.textContent = '£' + basePrice;
                } else {
                    var total = basePrice * qty;
                    selections[name] = qty === 1 ? basePrice : { price: total, qty: qty, basePrice: basePrice };
                    card.classList.add('is-selected');
                    stepperPanel.classList.add('is-visible');
                    priceEl.textContent = '£' + basePrice + ' ×' + qty;
                }
                updateSummary();
            }

            card.addEventListener('click', function(e) {
                if (e.target.closest('.loc-aga-options')) return;
                if (isSkipped) return;
                if (qty === 0) { qty = 1; updateCard(); }
            });

            plusBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                qty++;
                updateCard();
            });

            minusBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (qty > 0) { qty--; updateCard(); }
            });
        });

                // ── AGA CARD ──
        var agaCard = document.getElementById('loc-aga-card');
        if (agaCard) {
            agaCard.addEventListener('click', function() {
                if (agaCard.classList.contains('is-selected')) {
                    agaCard.classList.remove('is-selected');
                    delete selections['AGA / Large Range'];
                } else {
                    agaCard.classList.add('is-selected');
                    selections['AGA / Large Range'] = { tbc: true, price: 0 };
                }
                updateSummary();
            });
        }
        // ── BBQ CARD ──
        var bbqCard = document.getElementById('loc-bbq-card');
        if (bbqCard) {
            bbqCard.addEventListener('click', function() {
                if (bbqCard.classList.contains('is-selected')) {
                    bbqCard.classList.remove('is-selected');
                    delete selections['BBQ'];
                } else {
                    bbqCard.classList.add('is-selected');
                    selections['BBQ'] = { tbc: true, price: 0 };
                }
                updateSummary();
            });
        }
        // ── SKIP BUTTON ──
        function setSkipActive() {
            isSkipped = true;
            skipBtn.classList.add('is-active');
            skipBtn.textContent = 'Undo \u2014 Select Appliances Instead';
            sessionStorage.setItem('loc_skip', 'true');

            selections  = {};
            document.querySelectorAll('.loc-appliance-card').forEach(function(c) {
                c.classList.remove('is-selected', 'is-expanded');
                var priceEl      = c.querySelector('.loc-appliance-card__price');
                var stepperPanel = c.querySelector('.loc-aga-options');
                var basePrice    = parseInt(c.dataset.price, 10);
                if (priceEl && basePrice) { priceEl.textContent = '£' + basePrice; }
                if (stepperPanel) { stepperPanel.classList.remove('is-visible'); }
            });
            var stickyTotal  = document.getElementById('loc-step1-sticky-total');
            var stickyBtn    = document.getElementById('loc-step1-sticky-btn');
            var stickyBar    = document.getElementById('loc-step1-sticky-bottom');
            var inflowAmount = document.getElementById('loc-step1-inflow-amount');
            var inflowBtn    = document.getElementById('loc-step1-inflow-btn');

            if (stickyTotal)  stickyTotal.innerHTML = '<span>\u00a3</span>TBC';
            if (inflowAmount) inflowAmount.innerHTML = '<span>\u00a3</span>TBC';
            if (stickyBtn)    stickyBtn.classList.remove('loc-step1-sticky-bottom__btn--disabled');
            if (inflowBtn)    inflowBtn.classList.remove('loc-step1-sticky-bottom__btn--disabled');
            if (stickyBar)    stickyBar.classList.add('is-visible');
            positionStep1StickyBar();

        }

        function setSkipInactive() {
            isSkipped = false;
            skipBtn.classList.remove('is-active');
            skipBtn.textContent = 'Discuss on the Call';
            sessionStorage.removeItem('loc_skip');
            updateSummary();
        }

        skipBtn.addEventListener('click', function() {
            if (isSkipped) {
                setSkipInactive();
            } else {
                setSkipActive();
            }
        });

        // ── SUMMARY ──
        function updateSummary() {
            // Reset skip state if user manually selects an appliance
            if (isSkipped) {
                isSkipped = false;
                skipBtn.classList.remove('is-active');
                skipBtn.textContent = 'Discuss on the Call';
                sessionStorage.removeItem('loc_skip');
            }

            var stickyTotal  = document.getElementById('loc-step1-sticky-total');
            var stickyBtn    = document.getElementById('loc-step1-sticky-btn');
            var stickyBar    = document.getElementById('loc-step1-sticky-bottom');
            var inflowAmount = document.getElementById('loc-step1-inflow-amount');
            var inflowBtn    = document.getElementById('loc-step1-inflow-btn');
            var keys         = Object.keys(selections);

            if (keys.length === 0) {
                if (stickyTotal)  stickyTotal.innerHTML = '<span>\u00a3</span>0';
                if (inflowAmount) inflowAmount.innerHTML = '<span>\u00a3</span>0';
                if (stickyBtn)    stickyBtn.classList.add('loc-step1-sticky-bottom__btn--disabled');
                if (inflowBtn)    inflowBtn.classList.add('loc-step1-sticky-bottom__btn--disabled');
                if (stickyBar)    stickyBar.classList.remove('is-visible');
                hideScrollHint();
                return;
            }

            var total = 0;
            keys.forEach(function(name) {
                var val   = selections[name];
                var price = (typeof val === 'object') ? val.price : val;
                total += price;
            });

            var fromPfx = total > 0 ? 'From ' : '';
            if (stickyTotal)  stickyTotal.innerHTML = fromPfx + '<span>\u00a3</span>' + total;
            if (inflowAmount) inflowAmount.innerHTML = fromPfx + '<span>\u00a3</span>' + total;
            if (stickyBtn)    stickyBtn.classList.remove('loc-step1-sticky-bottom__btn--disabled');
            if (inflowBtn)    inflowBtn.classList.remove('loc-step1-sticky-bottom__btn--disabled');
            if (stickyBar)    stickyBar.classList.add('is-visible');
            positionStep1StickyBar();
            showScrollHint();

        }

        // ── SESSION STORAGE HANDOFF ──
        var confirmBtn   = document.getElementById('loc-step1-sticky-btn');
        var inflowBtnEl  = document.getElementById('loc-step1-inflow-btn');

        function handleConfirm(e) {
            var btn = e.currentTarget;
            if (btn.classList.contains('loc-step1-sticky-bottom__btn--disabled')) {
                e.preventDefault();
                return;
            }

            e.preventDefault();

            if (isSkipped) {
                sessionStorage.setItem('loc_skip', 'true');
                sessionStorage.removeItem('loc_selections');
                sessionStorage.removeItem('loc_total');
                sessionStorage.setItem('loc_duration', 0);
                sessionStorage.setItem('loc_from_step1', 'true');
            } else {
                sessionStorage.removeItem('loc_skip');
                var serialised = {};
                Object.keys(selections).forEach(function(name) {
                    var val = selections[name];
                    if (name === 'AGA / Large Range' || (typeof val === 'object' && val.tbc)) {
                        serialised[name] = 'TBC';
                    } else if (typeof val === 'object' && val.qty) {
                        serialised[name + ' ×' + val.qty] = val.price;
                    } else {
                        serialised[name] = val;
                    }
                });
                var total = Object.values(serialised).reduce(function(sum, p) { return typeof p === 'number' ? sum + p : sum; }, 0);
                sessionStorage.setItem('loc_selections', JSON.stringify(serialised));
                sessionStorage.setItem('loc_total', total);

                // ── DURATION CALCULATION ──
                var baseDurations = {
                    'Single Oven':        105,
                    'Double Oven':        135,
                    'Range Cooker':        150,
                    'Free-Standing Oven':  105
                };
                var extraDurations = {
                    'Gas Hob':                 30,
                    'Ceramic / Induction Hob': 30,
                    'Extractor Hood':           30,
                    'Microwave':                15,
                    'Combi Microwave':          20
                };
                var duration = 0;
                var hasBase  = false;
                var hasAga   = selections.hasOwnProperty('AGA / Large Range');
                if (!hasAga) {
                    Object.keys(selections).forEach(function(name) {
                        var val = selections[name];
                        var qty = (typeof val === 'object' && val.qty) ? val.qty : 1;
                        if (baseDurations.hasOwnProperty(name)) {
                            duration += baseDurations[name] * qty;
                            hasBase   = true;
                        } else if (extraDurations.hasOwnProperty(name)) {
                            duration += extraDurations[name] * qty;
                        }
                    });
                    if (!hasBase) { duration = 0; }
                }
                sessionStorage.setItem('loc_duration', duration);

                sessionStorage.setItem('loc_from_step1', 'true');
            }

            // Navigate after writing session storage
            window.location.href = btn.getAttribute('href');
        }

        confirmBtn.addEventListener('click', handleConfirm);
        if (inflowBtnEl) inflowBtnEl.addEventListener('click', handleConfirm);

        // ── SCROLL HINT (601px+) ──
        var scrollHint  = document.getElementById('loc-step1-scroll-hint');
        var inflowPanel = document.getElementById('loc-step1-inflow-total');

        function showScrollHint() {
            if (!scrollHint || !inflowPanel) return;
            if (window.innerWidth < 781) return;
            var rect = inflowPanel.getBoundingClientRect();
            // Hide once the panel is scrolled into view
            if (rect.top < window.innerHeight - 40) {
                scrollHint.classList.remove('is-visible');
            } else {
                scrollHint.classList.add('is-visible');
            }
        }

        function hideScrollHint() {
            if (scrollHint) scrollHint.classList.remove('is-visible');
        }

        window.addEventListener('scroll', function() {
            if (!scrollHint || !scrollHint.classList.contains('is-visible')) return;
            showScrollHint();
        });

        scrollHint && scrollHint.addEventListener('click', function() {
            inflowPanel && inflowPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });

        // ── STICKY BAR FOOTER-LIFT ──
        function positionStep1StickyBar() {
            var stickyBar = document.getElementById('loc-step1-sticky-bottom');
            if (!stickyBar) return;
            var footer = document.querySelector('.loc-footer');
            if (!footer) return;
            var footerTop    = footer.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;
            if (footerTop <= windowHeight) {
                stickyBar.style.position = 'absolute';
                stickyBar.style.bottom   = 'auto';
                stickyBar.style.top      = (window.scrollY + footerTop - stickyBar.offsetHeight - 8) + 'px';
            } else {
                stickyBar.style.position = 'fixed';
                stickyBar.style.bottom   = '0';
                stickyBar.style.top      = 'auto';
            }
        }
        window.addEventListener('scroll', positionStep1StickyBar);

    });
    </script>
    <?php
}
add_action('wp_footer', 'loc_step1_script');
// ============================================================
// STEP 2 — POSTCODE & AREAS SCRIPT
// ============================================================

function loc_step2_script() {
    if ( ! is_page( 'reserve-step-2' ) ) return;
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        var postcodeInput  = document.getElementById('loc-postcode-input');
        var confirmBtn     = document.getElementById('loc-confirm-btn');
        var stickyBar      = document.getElementById('loc-sticky-bar');
        var stickyAnchor   = document.getElementById('loc-sticky-anchor');
        var confirmedBanner = document.getElementById('loc-confirmed-banner');
        var confirmedText  = document.getElementById('loc-confirmed-text');
        var inlineSection  = document.getElementById('loc-inline-section');
        var continueWrap   = document.getElementById('loc-continue-wrap');
        var fromStep1      = sessionStorage.getItem('loc_from_step1') === 'true';

        // ── CARRIED-OVER TOTAL FROM STEP 1 (static continue bar) ──
        (function () {
            if (sessionStorage.getItem('loc_from_step1') !== 'true') return;
            var totalEl = document.getElementById('loc-continue-total');
            if (!totalEl) return;
            if (sessionStorage.getItem('loc_skip') === 'true') {
                totalEl.innerHTML = '<span>\u00a3</span>TBC';
                return;
            }
            var total = parseInt(sessionStorage.getItem('loc_total'), 10) || 0;
            totalEl.innerHTML = (total > 0 ? 'From ' : '') + '<span>\u00a3</span>' + total;
        })();


        // ── STICKY BAR — activate on scroll past anchor ──
        window.addEventListener('scroll', function() {
            var anchorTop = stickyAnchor.getBoundingClientRect().top;
            if (anchorTop <= 0) {
                stickyBar.classList.add('is-sticky');
            } else {
                stickyBar.classList.remove('is-sticky');
            }
        });

        // ── CLICKABLE AREA TAGS ──
        var areaTags = document.querySelectorAll('.loc-step2-area-tags li');
        areaTags.forEach(function(tag) {
            tag.addEventListener('click', function() {
                // Deselect all
                areaTags.forEach(function(t) { t.classList.remove('is-selected'); });
                // Select clicked
                tag.classList.add('is-selected');
                // Populate input
                var newPostcode = tag.dataset.postcode;
                postcodeInput.value = newPostcode;
                // If postcode was already confirmed, keep sessionStorage in sync
                if (continueWrap.style.display !== 'none' && continueWrap.style.display !== '' ||
                    inlineSection.style.display !== 'none' && inlineSection.style.display !== '') {
                    sessionStorage.setItem('loc_postcode', newPostcode);
                    confirmedText.textContent = newPostcode + ' saved — we\'ll show you the best available dates for your area.';
                    confirmedBanner.style.display = 'flex';
                    var postcodeEl = document.getElementById('loc-continue-postcode');
                    if (postcodeEl) postcodeEl.textContent = newPostcode;
                    var inlinePostcodeEl = document.getElementById('loc-inline-postcode');
                    if (inlinePostcodeEl) inlinePostcodeEl.textContent = newPostcode;
                    var stickyPostcodeEl = document.getElementById('loc-step2-sticky-postcode');
                    if (stickyPostcodeEl) stickyPostcodeEl.textContent = newPostcode;
                }
            });
        });

        // Clear area highlight and reset confirmed state when user types their own postcode
        postcodeInput.addEventListener('input', function() {
            areaTags.forEach(function(t) { t.classList.remove('is-selected'); });
            sessionStorage.removeItem('loc_postcode');
            confirmedBanner.style.display = 'none';
            continueWrap.style.display = 'none';
            inlineSection.style.display = 'none';
        });

        // ── CONFIRM POSTCODE ──
        var UK_POSTCODE = /^([A-Z]{1,2}\d[A-Z\d]?)(\s?\d[A-Z]{2})?$/;

        confirmBtn.addEventListener('click', function() {
            var postcode = postcodeInput.value.trim().toUpperCase().replace(/\s+/g, ' ');
            var errorEl  = document.getElementById('loc-postcode-error');

            if (!postcode) { postcodeInput.focus(); return; }

            if (!UK_POSTCODE.test(postcode)) {
                if (errorEl) {
                    errorEl.textContent = 'Please enter a valid UK postcode (e.g. LE2 7AB).';
                    errorEl.style.display = 'block';
                }
                postcodeInput.focus();
                return;
            }
            if (errorEl) errorEl.style.display = 'none';

            // …existing save + routing code continues unchanged…

            // Clear from session so refresh doesn't repopulate
            sessionStorage.removeItem('loc_postcode');
            // Save fresh
            sessionStorage.setItem('loc_postcode', postcode);

            // ── POSTCODE ZONE LOOKUP ──
            var districtMatch = postcode.match(/^([A-Z]{1,2}\d{1,2})/i);
            var district = districtMatch ? districtMatch[1].toUpperCase() : '';
            var zoneMap = {
                'LE4': 'North', 'LE6': 'North', 'LE7': 'North', 'LE11': 'North', 'LE12': 'North', 'LE65': 'North', 'LE67': 'North',
                'LE5': 'East',  'LE13': 'East',  'LE14': 'East',  'LE15': 'East',
                'LE2': 'South', 'LE8': 'South',  'LE18': 'South', 'LE16': 'South', 'LE17': 'South',
                'LE3': 'West',  'LE9': 'West',   'LE10': 'West',  'LE19': 'West',
                'LE1': 'Central'
            };
            var zone = zoneMap[district] || 'unknown';
            sessionStorage.setItem('loc_zone', zone);

            // Show confirmed banner
            confirmedText.textContent = postcode + ' saved — we\'ll show you the best available dates for your area.';
            confirmedBanner.style.display = 'flex';

            // Update location in all bars
            var postcodeEl = document.getElementById('loc-continue-postcode');
            if (postcodeEl) postcodeEl.textContent = postcode;
            var inlinePostcodeEl = document.getElementById('loc-inline-postcode');
            if (inlinePostcodeEl) inlinePostcodeEl.textContent = postcode;
            var stickyPostcodeEl = document.getElementById('loc-step2-sticky-postcode');
            if (stickyPostcodeEl) stickyPostcodeEl.textContent = postcode;

            // Routing
            if (fromStep1) {
                continueWrap.style.display = 'block';
                inlineSection.style.display = 'none';
                continueWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                inlineSection.style.display = 'block';
                inlineSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });

        // Allow Enter key
        postcodeInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') confirmBtn.click();
        });

        // ── INLINE APPLIANCE SELECTION ──
        var inlineSelections = {};
        var inlineCards = document.querySelectorAll('.loc-appliance-card--inline:not(.loc-appliance-card--aga)');
        inlineCards.forEach(function(card) {
            card.addEventListener('click', function() {
                var name  = card.dataset.name;
                var price = parseInt(card.dataset.price, 10);
                if (inlineSelections[name] !== undefined) {
                    delete inlineSelections[name];
                    card.classList.remove('is-selected');
                } else {
                    inlineSelections[name] = price;
                    card.classList.add('is-selected');
                }
                updateInlineSummary();
            });
        });

        // AGA inline
        var agaCard = document.getElementById('loc-aga-inline-card');
        if (agaCard) {
            agaCard.addEventListener('click', function() {
                if (agaCard.classList.contains('is-selected')) {
                    agaCard.classList.remove('is-selected');
                    delete inlineSelections['AGA / Large Range'];
                } else {
                    agaCard.classList.add('is-selected');
                    inlineSelections['AGA / Large Range'] = { tbc: true, price: 0 };
                }
                updateInlineSummary();
            });
        }
        // BBQ inline
        var bbqInlineCard = document.getElementById('loc-bbq-inline-card');
        if (bbqInlineCard) {
            bbqInlineCard.addEventListener('click', function() {
                if (bbqInlineCard.classList.contains('is-selected')) {
                    bbqInlineCard.classList.remove('is-selected');
                    delete inlineSelections['BBQ'];
                } else {
                    bbqInlineCard.classList.add('is-selected');
                    inlineSelections['BBQ'] = { tbc: true, price: 0 };
                }
                updateInlineSummary();
            });
        }

                function updateInlineSummary() {
            // Reset skip state if user manually selects
            if (isStep2Skipped) {
                isStep2Skipped = false;
                if (step2SkipBtn) {
                    step2SkipBtn.classList.remove('is-active');
                    step2SkipBtn.textContent = 'Discuss on the Call';
                }
                sessionStorage.removeItem('loc_skip');
            }
            // ... rest of function unchanged
            var itemsEl    = document.getElementById('loc-inline-items');
            var totalEl    = document.getElementById('loc-inline-total');
            var proceedBtn = document.getElementById('loc-inline-proceed-btn');
            var stickyBar  = document.getElementById('loc-step2-sticky-bottom');
            var stickyTotal = document.getElementById('loc-step2-sticky-total');
            var stickyBtn  = document.getElementById('loc-step2-sticky-btn');
            var keys       = Object.keys(inlineSelections);

            itemsEl.innerHTML = '';

            if (keys.length === 0) {
                itemsEl.innerHTML = '<p class="loc-step2-inline-summary__empty">No appliances selected yet</p>';
                totalEl.innerHTML = '<span>\u00a3</span>0';
                proceedBtn.classList.add('loc-step2-btn-proceed--disabled');
                if (stickyBar)   stickyBar.classList.remove('is-visible');
                if (stickyTotal) stickyTotal.innerHTML = '<span>\u00a3</span>0';
                if (stickyBtn)   stickyBtn.classList.add('loc-step2-sticky-bottom__btn--disabled');
                return;
            }

            var total = 0;
            keys.forEach(function(name) {
                var val         = inlineSelections[name];
                var price       = (typeof val === 'object') ? val.price : val;
                var displayName = name;
                total += price;
                var div = document.createElement('div');
                div.className = 'loc-step2-inline-summary__item';
                div.innerHTML =
                    '<span class="loc-step2-inline-summary__item-name">' + displayName + '</span>' +
                    '<span class="loc-step2-inline-summary__item-price">' + ((typeof val === 'object' && val.tbc) ? 'TBC' : '\u00a3' + price) + '</span>';
                itemsEl.appendChild(div);
            });

            totalEl.innerHTML = (total > 0 ? 'From ' : '') + '<span>\u00a3</span>' + total;
            proceedBtn.classList.remove('loc-step2-btn-proceed--disabled');

            if (stickyBar)   stickyBar.classList.add('is-visible');
            if (stickyTotal) stickyTotal.innerHTML = (total > 0 ? 'From ' : '') + '<span>\u00a3</span>' + total;
            if (stickyBtn)   stickyBtn.classList.remove('loc-step2-sticky-bottom__btn--disabled');
        }

        // Session storage handoff (inline route)
        var proceedBtn = document.getElementById('loc-inline-proceed-btn');
        proceedBtn.addEventListener('click', function(e) {
            if (proceedBtn.classList.contains('loc-step2-btn-proceed--disabled')) {
                e.preventDefault();
                return;
            }
            sessionStorage.removeItem('loc_skip');
            var serialised = {};
            Object.keys(inlineSelections).forEach(function(name) {
                var val = inlineSelections[name];
                if (name === 'AGA / Large Range' || (typeof val === 'object' && val.tbc)) {
                    serialised[name] = 'TBC';
                } else {
                    serialised[name] = val;
                }
            });
            var total = Object.values(serialised).reduce(function(sum, p) { return typeof p === 'number' ? sum + p : sum; }, 0);
            sessionStorage.setItem('loc_selections', JSON.stringify(serialised));
            sessionStorage.setItem('loc_total', total);
        });

        // ── STICKY BAR PROCEED — write storage on inline route (mobile) ──
        var step2StickyBtn = document.getElementById('loc-step2-sticky-btn');
        if (step2StickyBtn) {
            step2StickyBtn.addEventListener('click', function(e) {
                if (step2StickyBtn.classList.contains('loc-step2-sticky-bottom__btn--disabled')) {
                    e.preventDefault();
                    return;
                }
                if (isStep2Skipped) return;  // skip flag already set; Step 3 reads it
                sessionStorage.removeItem('loc_skip');
                var serialised = {};
                Object.keys(inlineSelections).forEach(function(name) {
                    var val = inlineSelections[name];
                    if (name === 'AGA / Large Range' || (typeof val === 'object' && val.tbc)) {
                        serialised[name] = 'TBC';
                    } else {
                        serialised[name] = val;
                    }
                });
                var total = Object.values(serialised).reduce(function(sum, p) { return typeof p === 'number' ? sum + p : sum; }, 0);
                sessionStorage.setItem('loc_selections', JSON.stringify(serialised));
                sessionStorage.setItem('loc_total', total);
            });
        }
            // Unstick Step 2 bottom bar near footer
            function positionStep2StickyBar() {
                var stickyBar = document.getElementById('loc-step2-sticky-bottom');
                if (!stickyBar) return;
                var footer = document.querySelector('.loc-footer');
                if (!footer) return;
                var footerTop    = footer.getBoundingClientRect().top;
                var windowHeight = window.innerHeight;
                if (footerTop <= windowHeight) {
                    stickyBar.style.position = 'absolute';
                    stickyBar.style.bottom   = 'auto';
                    stickyBar.style.top      = (window.scrollY + footerTop - stickyBar.offsetHeight - 8) + 'px';
                } else {
                    stickyBar.style.position = 'fixed';
                    stickyBar.style.bottom   = '0';
                    stickyBar.style.top      = 'auto';
                }
            }
            window.addEventListener('scroll', positionStep2StickyBar);
            });
    </script>
    <?php
}
add_action('wp_footer', 'loc_step2_script');
// ============================================================
// STEP 3 — CALENDAR & RESERVATION SCRIPT
// ============================================================

function loc_step3_script() {
    if ( ! is_page( 'reserve-step-3' ) ) return;
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // ── READ SESSION STORAGE ──
        var selections = {};
        var total = 0;

        try {
            var stored = sessionStorage.getItem('loc_selections');
            if (stored) selections = JSON.parse(stored);
            var isSkip = sessionStorage.getItem('loc_skip') === 'true';
total = isSkip ? 0 : (parseInt(sessionStorage.getItem('loc_total'), 10) || 0);
        } catch(e) {}

        // ── POPULATE SUMMARY ──
        var summaryItems = document.getElementById('loc-summary-items');
        var summaryTotal = document.getElementById('loc-summary-total');

        // Populate location from sessionStorage
        var summaryPostcode = document.getElementById('loc-summary-postcode');
        if (summaryPostcode) {
            var storedPostcode = sessionStorage.getItem('loc_postcode');
            summaryPostcode.textContent = storedPostcode ? storedPostcode : '—';
        }

        summaryItems.innerHTML = '';
        var keys = Object.keys(selections);

        if (keys.length === 0) {
            if (isSkip) {
                summaryItems.innerHTML = '<p class="loc-step3-summary__empty">Appliances to be discussed on the call</p>';
            } else {
                summaryItems.innerHTML = '<p class="loc-step3-summary__empty">No selection found — <a href="/reserve-step-1" style="color:var(--gold);">go back to Step 1</a></p>';
            }
        } else {
            keys.forEach(function(name) {
                var price = selections[name];
                var div = document.createElement('div');
                div.className = 'loc-step3-summary__item';
                var priceDisplay = (price === 'TBC') ? 'TBC' : '£' + price;
                div.innerHTML =
                    '<span class="loc-step3-summary__item-name">' + name + '</span>' +
                    '<span class="loc-step3-summary__item-price">' + priceDisplay + '</span>';
                summaryItems.appendChild(div);
            });
        }

       summaryTotal.innerHTML = isSkip ? '<span>\u00a3</span>TBC' : (total > 0 ? 'From <span>\u00a3</span>' + total : '<span>\u00a3</span>0');

        // ── CALENDAR STATE ──
        var today      = new Date();
        var curYear    = today.getFullYear();
        var curMonth   = today.getMonth();
        var minMonth   = today.getMonth();
        var minYear    = today.getFullYear();
        var maxDate    = new Date(today.getFullYear(), today.getMonth() + 12, 1);
        var maxMonth   = maxDate.getMonth();
        var maxYear    = maxDate.getFullYear();
        var selDate      = null;
        var selDateISO   = null; // YYYY-MM-DD — sent to reservation-handler.php
        var selTimeLabel = null;
        var selTime      = null;
        var selCallback  = null;
        var isDateTBC    = false;

        // Availability data — populated via fetch from calendar-ajax.php
        var availableDates  = [];
        var availableLookup = {};
        var isFallbackMode  = false;

        var monthNames = ['January','February','March','April','May','June',
                          'July','August','September','October','November','December'];

        function renderCalendar() {
            document.getElementById('loc-cal-month').textContent = monthNames[curMonth] + ' ' + curYear;
            var body = document.getElementById('loc-cal-body');
            body.innerHTML = '';

            var firstDay    = new Date(curYear, curMonth, 1).getDay();
            var daysInMonth = new Date(curYear, curMonth + 1, 0).getDate();
            var startOffset = firstDay === 0 ? 6 : firstDay - 1;

            var day = 1;
            var row = document.createElement('tr');
            var count = 0;

            for (var i = 0; i < startOffset; i++) {
                row.appendChild(makeCell('', 'empty'));
                count++;
            }

            while (day <= daysInMonth) {
                var isPast  = new Date(curYear, curMonth, day) < new Date(today.getFullYear(), today.getMonth(), today.getDate());
                var dateStr = curYear + '-' + String(curMonth + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                var isUnavail = isPast || (!isFallbackMode && !availableLookup[dateStr]);
                var cls = isUnavail ? 'unavailable' : 'available';
                var cell = makeCell(day, cls);
                row.appendChild(cell);
                count++;
                day++;

                if (count % 7 === 0) {
                    body.appendChild(row);
                    row = document.createElement('tr');
                }
            }

            while (count % 7 !== 0) {
                row.appendChild(makeCell('', 'empty'));
                count++;
            }
            if (row.children.length > 0) body.appendChild(row);
        }

        function makeCell(day, cls) {
            var td  = document.createElement('td');
            var div = document.createElement('div');
            div.className = 'loc-cal-day loc-cal-day--' + cls;
            div.textContent = day || '';

            if (cls !== 'empty' && cls !== 'unavailable' && day) {
                div.addEventListener('click', function() {
                    selectDate(day, cls);
                });
            }
            td.appendChild(div);
            return td;
        }

        function selectDate(day, cls) {
            isDateTBC = false;
            var escapeBtn = document.getElementById('loc-date-escape-btn');
            if (escapeBtn) escapeBtn.classList.remove('is-active');
            document.querySelectorAll('.loc-cal-day--selected').forEach(function(el) {
                el.classList.remove('loc-cal-day--selected');
            });
            document.querySelectorAll('.loc-cal-day').forEach(function(el) {
                if (parseInt(el.textContent) === day &&
                    !el.classList.contains('loc-cal-day--empty') &&
                    !el.classList.contains('loc-cal-day--unavailable')) {
                    el.classList.add('loc-cal-day--selected');
                }
            });

            var dateObj = new Date(curYear, curMonth, day);
            selDate    = dateObj.toLocaleDateString('en-GB', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            });
            selDateISO = curYear + '-' + String(curMonth + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
            selTimeLabel = null;
            selTime = null;

            // Reset time slots
            document.querySelectorAll('.loc-step3-slot-btn').forEach(function(b) {
                b.classList.remove('is-selected');
            });

            document.getElementById('loc-selected-date-label').textContent = selDate;

            // Show only the slots available for this specific date
            var _ds  = curYear + '-' + String(curMonth + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
            var _dd  = availableLookup[_ds];
            var _mBtn = document.querySelector('.loc-step3-slot-btn[data-label="Morning"]');
            var _aBtn = document.querySelector('.loc-step3-slot-btn[data-label="Afternoon"]');
            if (!isFallbackMode && _dd) {
                if (_mBtn) _mBtn.style.display = _dd.morning   ? '' : 'none';
                if (_aBtn) _aBtn.style.display = _dd.afternoon ? '' : 'none';
            } else {
                if (_mBtn) _mBtn.style.display = '';
                if (_aBtn) _aBtn.style.display = '';
            }

            document.getElementById('loc-time-slots').style.display = 'block';
            document.getElementById('loc-time-slots').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            if (clearDateBtn) clearDateBtn.style.display = 'block';
            updateSummarySlot();
            updateReserveBtn();
        }

        // Month nav
        var prevBtn = document.getElementById('loc-cal-prev');
        var nextBtn = document.getElementById('loc-cal-next');

        function updateNavBtns() {
            var atMin = (curYear === minYear && curMonth === minMonth);
            var atMax = (curYear === maxYear && curMonth === maxMonth);
            prevBtn.disabled = atMin;
            prevBtn.style.opacity = atMin ? '0.3' : '1';
            prevBtn.style.cursor  = atMin ? 'default' : 'pointer';
            nextBtn.disabled = atMax;
            nextBtn.style.opacity = atMax ? '0.3' : '1';
            nextBtn.style.cursor  = atMax ? 'default' : 'pointer';
        }

        prevBtn.addEventListener('click', function() {
            if (curYear === minYear && curMonth === minMonth) return;
            curMonth--;
            if (curMonth < 0) { curMonth = 11; curYear--; }
            renderCalendar();
            updateNavBtns();
        });

        nextBtn.addEventListener('click', function() {
            if (curYear === maxYear && curMonth === maxMonth) return;
            curMonth++;
            if (curMonth > 11) { curMonth = 0; curYear++; }
            renderCalendar();
            updateNavBtns();
        });

        updateNavBtns();

        // Time slot buttons
        document.querySelectorAll('.loc-step3-slot-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.loc-step3-slot-btn').forEach(function(b) {
                    b.classList.remove('is-selected');
                });
                btn.classList.add('is-selected');
                selTimeLabel = btn.dataset.label;
                selTime      = btn.dataset.time;
                updateSummarySlot();
                updateReserveBtn();
                var sum = document.querySelector('.loc-step3-summary-col');
                if (sum) sum.scrollIntoView({ behavior: 'smooth', block: 'end' });
            });
        });
        // Clear date button
            var clearDateBtn = document.getElementById('loc-clear-date-btn');
            if (clearDateBtn) {
                clearDateBtn.addEventListener('click', function() {
                    // Reset state
                    selDate      = null;
                    selDateISO   = null;
                    selTimeLabel = null;
                    selTime      = null;

                    // Reset calendar selection
                    document.querySelectorAll('.loc-cal-day--selected').forEach(function(el) {
                        el.classList.remove('loc-cal-day--selected');
                    });

                    // Reset time slots
                    document.querySelectorAll('.loc-step3-slot-btn').forEach(function(b) {
                        b.classList.remove('is-selected');
                    });

                    // Hide time slot panel and clear button
                    document.getElementById('loc-time-slots').style.display = 'none';
                    clearDateBtn.style.display = 'none';

                    // Reset slot button visibility
                    var _mb = document.querySelector('.loc-step3-slot-btn[data-label="Morning"]');
                    var _ab = document.querySelector('.loc-step3-slot-btn[data-label="Afternoon"]');
                    if (_mb) _mb.style.display = '';
                    if (_ab) _ab.style.display = '';

                    // Reset summary slot
                    document.getElementById('loc-summary-slot').classList.remove('loc-step3-summary__slot--active');
                    updateSummarySlot();
                    updateReserveBtn();

                    // Mobile only: scroll back up to the calendar
                    if (window.innerWidth < 960) {
                        var calCol = document.querySelector('.loc-step3-calendar-col');
                        if (calCol) calCol.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            }

        // ── DATE ESCAPE HATCH ──
        var dateEscapeBtn = document.getElementById('loc-date-escape-btn');
        if (dateEscapeBtn) {
            dateEscapeBtn.addEventListener('click', function() {
                if (isDateTBC) {
                    // Undo
                    isDateTBC = false;
                    dateEscapeBtn.classList.remove('is-active');
                    dateEscapeBtn.textContent = 'Confirm On Call';
                } else {
                    // Activate — clear any selected date/time
                    isDateTBC    = true;
                    selDate      = null;
                    selDateISO   = null;
                    selTimeLabel = null;
                    selTime      = null;
                    document.querySelectorAll('.loc-cal-day--selected').forEach(function(el) {
                        el.classList.remove('loc-cal-day--selected');
                    });
                    document.querySelectorAll('.loc-step3-slot-btn').forEach(function(b) {
                        b.classList.remove('is-selected');
                    });
                    document.getElementById('loc-time-slots').style.display = 'none';
                    if (clearDateBtn) clearDateBtn.style.display = 'none';
                    dateEscapeBtn.classList.add('is-active');
                    dateEscapeBtn.textContent = 'Undo — Select a Date Instead';
                }
                updateSummarySlot();
                updateReserveBtn();
            });
        }

        function updateSummarySlot() {
            var slotEl   = document.getElementById('loc-summary-slot');
            var dateEl   = document.getElementById('loc-summary-slot-date');
            var timeEl   = document.getElementById('loc-summary-slot-time');

            if (isDateTBC) {
                dateEl.textContent = 'To be confirmed';
                timeEl.textContent = 'To be confirmed';
                slotEl.classList.add('loc-step3-summary__slot--active');
            } else if (selDate && selTime) {
                dateEl.textContent = selDate;
                timeEl.textContent = selTimeLabel + ' (' + selTime + ')';
                slotEl.classList.add('loc-step3-summary__slot--active');
            } else if (selDate) {
                dateEl.textContent = selDate;
                timeEl.textContent = 'Choose a time above';
                slotEl.classList.remove('loc-step3-summary__slot--active');
            } else {
                dateEl.textContent = '\u2014';
                timeEl.textContent = '\u2014';
                slotEl.classList.remove('loc-step3-summary__slot--active');
            }
        }

        function updateReserveBtn() {
            updateStickyBar();
            // Reserve button is now inside the slot panel
            // Nothing needed here — handled by slot class
        }

        // ── MODAL TRIGGERS ──
            var overlay  = document.getElementById('loc-modal-overlay');
            var closeBtn = document.getElementById('loc-modal-close');

            function openModal() {
                if (!selDate && !selTime && !isDateTBC) return;
                document.getElementById('loc-modal-slot-summary').textContent = isDateTBC
                    ? 'Date to be confirmed on the call'
                    : selDate + ', ' + selTimeLabel + ' (' + selTime + ')';
                overlay.classList.add('is-visible');
                document.body.style.overflow = 'hidden';
            }

            // Slot panel reserve button
            var slotPanel = document.getElementById('loc-summary-slot');
            if (slotPanel) {
                slotPanel.addEventListener('click', function() {
                    openModal();
                });
            }

            // Mobile sticky button
            var stickyBtn3 = document.getElementById('loc-step3-sticky-btn');
            if (stickyBtn3) {
                stickyBtn3.addEventListener('click', function() {
                    if (stickyBtn3.classList.contains('loc-step3-sticky-bottom__btn--disabled')) return;
                    openModal();
                });
            }
        closeBtn.addEventListener('click', function() {
            overlay.classList.remove('is-visible');
            document.body.style.overflow = '';
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('is-visible');
                document.body.style.overflow = '';
            }
        });

        // ── STICKY BAR UPDATE ──
            function updateStickyBar() {
                if (window.innerWidth <= 600) {
                    return;
                }
                var stickyBar3   = document.getElementById('loc-step3-sticky-bottom');
                var stickyBtn3el = document.getElementById('loc-step3-sticky-btn');
                var stickySlot   = document.getElementById('loc-sticky-slot');
                var stickyTotal3 = document.getElementById('loc-sticky-total-3');

                if (stickyTotal3) stickyTotal3.textContent = isSkip ? 'TBC' : total;

                if (isDateTBC) {
                    if (stickyBar3)   stickyBar3.classList.add('is-visible');
                    if (stickyBtn3el) stickyBtn3el.classList.remove('loc-step3-sticky-bottom__btn--disabled');
                    if (stickyBtn3el) stickyBtn3el.textContent = 'Reserve Your Slot \u2192';
                    if (stickySlot)   stickySlot.textContent = 'Date to be confirmed on call';
                } else if (selDate && selTime) {
                    if (stickyBar3)   stickyBar3.classList.add('is-visible');
                    if (stickyBtn3el) stickyBtn3el.classList.remove('loc-step3-sticky-bottom__btn--disabled');
                    if (stickyBtn3el) stickyBtn3el.textContent = 'Confirm Your Slot \u2192';
                    if (stickySlot)   stickySlot.textContent = selTimeLabel + ' \u00b7 ' + selDate.split(',')[0];
                } else {
                    if (stickyBar3)   stickyBar3.classList.remove('is-visible');
                    if (stickyBtn3el) stickyBtn3el.classList.add('loc-step3-sticky-bottom__btn--disabled');
                    if (stickyBtn3el) stickyBtn3el.textContent = 'Reserve Your Slot \u2192';
                    if (stickySlot)   stickySlot.textContent = 'Select a date above';
                }
            }

        // Callback buttons
        document.querySelectorAll('.loc-step3-callback-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.loc-step3-callback-btn').forEach(function(b) {
                    b.classList.remove('is-selected');
                });
                btn.classList.add('is-selected');
                selCallback = { label: btn.dataset.label, time: btn.dataset.time };

                if (window.innerWidth < 960) {
                    var clearBtn = document.getElementById('loc-clear-date-btn');
                    if (clearBtn) clearBtn.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // ── SMART CALLBACK MESSAGE ──
        function getCallbackMessage(label) {
            var now  = new Date();
            var hour = now.getHours();
            var day  = now.getDay();
            var isWeekend = day === 0 || day === 6;
            var isFriday  = day === 5;

            if (isWeekend) return "We'll call you first thing Monday morning to confirm your reservation.";

            if (label === 'Morning') {
                if (hour >= 8 && hour < 12) return "We'll aim to call you this morning.";
                if (isFriday && hour >= 17) return "We'll call you Monday morning \u2014 our first available morning slot.";
                return "We'll aim to call you tomorrow morning.";
            }
            if (label === 'Afternoon') {
                if (hour >= 8 && hour < 17) return "We'll aim to call you this afternoon.";
                return "We'll aim to call you tomorrow afternoon.";
            }
            if (label === 'Evening') {
                if (hour >= 8 && hour < 20) return "We'll aim to call you this evening.";
                return "We'll aim to call you tomorrow evening.";
            }
            return "We'll call you during your preferred callback window.";
        }

        // ── SUBMIT ──
        document.getElementById('loc-submit-btn').addEventListener('click', function() {

            // ── SNAPSHOT sessionStorage immediately — before any async work ──
            var ssSelections    = sessionStorage.getItem('loc_selections') || '';
            var ssTotal         = parseInt(sessionStorage.getItem('loc_total'), 10) || 0;
            var ssDuration      = parseInt(sessionStorage.getItem('loc_duration'), 10) || 0;
            var ssZone          = sessionStorage.getItem('loc_zone') || '';

            var first = document.getElementById('loc-first-name').value.trim();
            var last  = document.getElementById('loc-last-name').value.trim();
            var phone = document.getElementById('loc-phone').value.trim();
            var email = document.getElementById('loc-email').value.trim();

            // Basic validation
                if (!first || !last || !phone || !email) {
                    alert('Please fill in all fields before confirming.');
                    return;
                }

                // Phone validation — UK format, numbers only, 10-11 digits
                var phoneClean = phone.replace(/[\s\-\(\)]/g, '');
                var phoneValid = /^(\+44|0)[0-9]{10}$/.test(phoneClean);
                if (!phoneValid) {
                    alert('Please enter a valid UK phone number — for example 07700 000000 or 01234 567890.');
                    return;
                }

                // Email validation
                var emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                if (!emailValid) {
                    alert('Please enter a valid email address — for example sarah@example.com.');
                    return;
                }

            if (!selCallback) {
                alert('Please select a preferred callback time.');
                return;
            }

            // ── COLLECT POST DATA ──
            var submitBtn   = document.getElementById('loc-submit-btn');
            var submitErrEl = document.getElementById('loc-submit-error');

            var postData = {
                first_name:       first,
                last_name:        last,
                phone:            phone,
                email:            email,
                callback_time:    selCallback.label,
                date:             selDateISO || '',
                slot:             selTimeLabel || '',
                duration_minutes: ssDuration,
                zone:             ssZone,
                appliances:       ssSelections,
                total:            ssTotal
            };

            // ── DISABLE BUTTON WHILE FETCHING ──
            submitBtn.disabled    = true;
            submitBtn.textContent = 'Reserving your slot…';
            if (submitErrEl) submitErrEl.style.display = 'none';

            var formBody = new URLSearchParams(postData);
            formBody.append('action', 'loc_reservation');

            fetch('/wp-admin/admin-ajax.php', {
                method:  'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body:    formBody.toString()
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data && data.success) {
                    // ── SUCCESS -- proceed with existing confirmation flow ──
                    overlay.classList.remove('is-visible');
                    document.body.style.overflow = '';

                    document.getElementById('loc-confirm-date').textContent = isDateTBC
                        ? 'To be confirmed on the call'
                        : selDate + ' — ' + selTimeLabel + ' (' + selTime + ')';
                    document.getElementById('loc-confirm-total').textContent = isSkip
                        ? 'To be discussed on the call'
                        : '£' + total + ' — Fixed Price';
                    document.getElementById('loc-confirm-name').textContent      = first + ' ' + last;
                    document.getElementById('loc-confirm-callback').textContent  = selCallback.label + ' (' + selCallback.time + ')';
                    document.getElementById('loc-callback-smart-message').textContent = getCallbackMessage(selCallback.label);

                    document.getElementById('loc-summary-slot').classList.remove('loc-step3-summary__slot--active');

                    document.getElementById('loc-step3-main').style.display = 'none';
                    document.getElementById('loc-confirmation-wrap').style.display = 'block';
                    window.scrollTo({ top: 0, behavior: 'smooth' });

                    var funnelHeader     = document.querySelector('.loc-funnel-header');
                    var funnelProgress   = document.querySelector('.loc-funnel-progress');
                    var funnelPageHeader = document.querySelector('.loc-funnel-page-header');
                    if (funnelHeader)     funnelHeader.style.display     = 'none';
                    if (funnelProgress)   funnelProgress.style.display   = 'none';
                    if (funnelPageHeader) funnelPageHeader.style.display = 'none';

                    sessionStorage.removeItem('loc_selections');
                    sessionStorage.removeItem('loc_total');
                    sessionStorage.removeItem('loc_postcode');
                    sessionStorage.removeItem('loc_from_step1');

                } else {
                    // ── SERVER-SIDE FAILURE -- show inline error, keep modal open ──
                    submitBtn.disabled    = false;
                    submitBtn.textContent = 'Confirm My Reservation →';
                    if (submitErrEl) {
                        submitErrEl.textContent  = 'Sorry, there was a problem reserving your slot. Please call us directly.';
                        submitErrEl.style.display = 'block';
                    }
                }
            })
            .catch(function() {
                // ── NETWORK FAILURE -- show inline error, keep modal open ──
                submitBtn.disabled    = false;
                submitBtn.textContent = 'Confirm My Reservation →';
                if (submitErrEl) {
                    submitErrEl.textContent  = 'Sorry, there was a problem reserving your slot. Please call us directly.';
                    submitErrEl.style.display = 'block';
                }
            });
        });

        // Init — fetch real availability then render calendar
        (function() {
            var locZone     = sessionStorage.getItem('loc_zone') || '';
            var locDuration = parseInt(sessionStorage.getItem('loc_duration'), 10) || 0;
            var calBody     = document.getElementById('loc-cal-body');
            var calMonth    = document.getElementById('loc-cal-month');

            // Only fall back to unfiltered mode if zone is genuinely unknown.
            // Missing duration (skip route / inline Step 2 route) uses a 60-min
            // default so zone filtering still applies.
            if (!locZone || locZone === 'unknown') {
                isFallbackMode = true;
                renderCalendar();
                return;
            }

            var fetchDuration = locDuration > 0 ? locDuration : 60;

            // Show loading state
            if (calMonth) calMonth.textContent = ' ';
            if (calBody)  calBody.innerHTML    = '<tr><td colspan="7" style="text-align:center;padding:var(--space-8) 0;color:var(--grey-400);font-size:var(--text-ui);">Loading available dates…</td></tr>';

            fetch('/wp-admin/admin-ajax.php?action=loc_calendar_availability&zone=' + encodeURIComponent(locZone) + '&duration_minutes=' + fetchDuration)
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (!data || data.error || !Array.isArray(data)) {
                        isFallbackMode = true;
                        renderCalendar();
                        return;
                    }
                    if (data.length === 0) {
                        if (calMonth) calMonth.textContent = monthNames[curMonth] + ' ' + curYear;
                        if (calBody)  calBody.innerHTML    = '<tr><td colspan="7" style="text-align:center;padding:var(--space-8) 0;color:var(--grey-500);font-size:var(--text-body-sm);">No available slots found in the next 180 days.<br>Please <a href="/contact" style="color:var(--gold);">call us</a> to arrange a date.</td></tr>';
                        return;
                    }
                    data.forEach(function(item) {
                        availableLookup[item.date] = item;
                    });
                    availableDates = data;
                    renderCalendar();
                })
                .catch(function() {
                    isFallbackMode = true;
                    renderCalendar();
                });
        })();
    });
    </script>
    <?php
}
add_action('wp_footer', 'loc_step3_script');