<?php
/**
 * Template Name: Areas
 * Areas We Serve page — Leicester Oven Cleaning
 */

get_header();
?>

<main id="loc-areas-page">

    <!-- PAGE HEADER -->
    <section class="loc-page-header">
        <div class="loc-page-header__inner">
            <p class="loc-page-header__eyebrow section-eyebrow">Where We Cover</p>
            <h1>Areas <span>We Serve</span></h1>
            <p class="loc-page-header__intro">We cover Leicester city and the surrounding Leicestershire area. Enter your postcode on the reservation page for instant confirmation — or check the list below.</p>
        </div>
    </section>

    <!-- ============================================================
         MAP PLACEHOLDER
         ============================================================ -->
    <section class="loc-areas-page-map-section">
        <div class="loc-areas-page-map-section__inner">
            <!-- Replace with real Google Maps screenshot before go-live -->
            <div class="loc-areas-page-map-placeholder">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="rgba(26,58,110,0.3)" stroke-width="2"/>
                    <circle cx="12" cy="10" r="3" stroke="rgba(26,58,110,0.3)" stroke-width="2"/>
                </svg>
                <p>Coverage map — Leicester &amp; Leicestershire</p>
                <p class="loc-areas-page-map-placeholder__note">Map coming soon</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         AREA LIST
         ============================================================ -->
    <section class="loc-areas-page-list-section">
        <div class="loc-areas-page-list-section__inner">
            <p class="loc-areas-page-list-section__eyebrow section-eyebrow">Coverage</p>
            <h2 class="loc-areas-page-list-section__heading">Where We Work</h2>

            <div class="loc-areas-page-grid">

                <div class="loc-areas-page-group">
                    <h3 class="loc-areas-page-group-title">City &amp; Inner</h3>
                    <ul class="loc-areas-page-tags">
                        <li>Leicester City <span>LE1</span></li>
                        <li>Stoneygate <span>LE2</span></li>
                        <li>Clarendon Park <span>LE2</span></li>
                        <li>Oadby <span>LE2</span></li>
                        <li>Knighton <span>LE2</span></li>
                        <li>Glenfield <span>LE3</span></li>
                        <li>Braunstone <span>LE3</span></li>
                        <li>Birstall <span>LE4</span></li>
                        <li>Thurmaston <span>LE4</span></li>
                        <li>Hamilton <span>LE5</span></li>
                        <li>Humberstone <span>LE5</span></li>
                        <li>Wigston <span>LE18</span></li>
                        <li>Narborough <span>LE19</span></li>
                    </ul>
                </div>

                <div class="loc-areas-page-group">
                    <h3 class="loc-areas-page-group-title">North &amp; West</h3>
                    <ul class="loc-areas-page-tags">
                        <li>Groby <span>LE6</span></li>
                        <li>Anstey <span>LE7</span></li>
                        <li>Syston <span>LE7</span></li>
                        <li>Scraptoft <span>LE7</span></li>
                        <li>Queniborough <span>LE7</span></li>
                        <li>Kirby Muxloe <span>LE9</span></li>
                        <li>Earl Shilton <span>LE9</span></li>
                        <li>Hinckley <span>LE10</span></li>
                        <li>Loughborough <span>LE11</span></li>
                        <li>Shepshed <span>LE12</span></li>
                        <li>Mountsorrel <span>LE12</span></li>
                        <li>Sileby <span>LE12</span></li>
                    </ul>
                </div>

                <div class="loc-areas-page-group">
                    <h3 class="loc-areas-page-group-title">South</h3>
                    <ul class="loc-areas-page-tags">
                        <li>Blaby <span>LE8</span></li>
                        <li>Countesthorpe <span>LE8</span></li>
                        <li>Fleckney <span>LE8</span></li>
                        <li>Lutterworth <span>LE17</span></li>
                        <li>Market Harborough <span>LE16</span></li>
                    </ul>
                </div>

                <div class="loc-areas-page-group">
                    <h3 class="loc-areas-page-group-title">Outer</h3>
                    <ul class="loc-areas-page-tags">
                        <li>Melton Mowbray <span>LE13</span></li>
                        <li>Melton Rural <span>LE14</span></li>
                        <li>Oakham <span>LE15</span></li>
                        <li>Rutland <span>LE15</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         NOT ON THE LIST
         ============================================================ -->
    <section class="loc-areas-page-contact-section">
        <div class="loc-areas-page-contact-section__inner">
            <h2 class="loc-areas-page-contact-section__heading">Not on the list?</h2>
            <p>We're expanding our coverage as the business grows. If your area isn't listed, it's worth getting in touch — we may still be able to help depending on location and current schedule. We'll always be honest if it's not practical.</p>
            <a href="/contact" class="btn-primary">Get In Touch &rarr;</a>
        </div>
    </section>

    <!-- ============================================================
         HOW COVERAGE WORKS
         ============================================================ -->
    <section class="loc-areas-page-how-section">
        <div class="loc-areas-page-how-section__inner">
            <h2 class="loc-areas-page-how-section__heading">How our area check works</h2>
            <p>When you reach Step 2 of the reservation, you'll enter your postcode or select your area. We'll confirm instantly whether we cover you. If you're in a listed area, you're good to go. If you're just outside, get in touch — we'll do our best.</p>
            <a href="/reserve-step-1" class="btn-primary">Start Your Reservation &rarr;</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
