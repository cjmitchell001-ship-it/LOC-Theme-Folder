<?php
/**
 * Footer template — Leicester Oven Cleaning
 * Replaces GeneratePress default footer
 */
?>

<footer class="loc-footer">

    <!-- MAIN FOOTER COLUMNS -->
    <div class="loc-footer__inner">

        <!-- COLUMN 1 — BRAND + TRUST -->
        <div class="loc-footer__col loc-footer__col--brand">
            <div class="loc-footer__logo">
                <span class="loc-footer__logo-top">Leicester</span>
                <span class="loc-footer__logo-bottom">Oven Cleaning</span>
            </div>
            <p class="loc-footer__tagline">Professional oven cleaning across Leicester & Leicestershire.</p>
            <div class="loc-footer__trust-badges">
                <span class="loc-footer__badge">✓ Fully Insured</span>
                <span class="loc-footer__badge">✓ ICO Registration Pending</span>
            </div>
        </div>

        <!-- COLUMN 2 — SERVICES -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">What I Clean</h4>
            <ul class="loc-footer__list">
                <li><a href="/services">Oven Cleaning</a></li>
                <li><a href="/services">Hob Cleaning</a></li>
                <li><a href="/services">Extractor Hood Cleaning</a></li>
                <li><a href="/services">Microwave Cleaning</a></li>
                <li><a href="/services">BBQ Cleaning</a></li>
                <li><a href="/business-commercial">Business &amp; Commercial</a></li>
            </ul>
        </div>

        <!-- COLUMN 3 — COMPANY -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">About</h4>
            <ul class="loc-footer__list">
                <li><a href="/about">About Chris</a></li>
                <li><a href="/how-we-work">How I Work</a></li>
                <li><a href="/areas">Areas Covered</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/faq">FAQ</a></li>
            </ul>
        </div>

        <!-- COLUMN 4 — HELP -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">Help</h4>
            <ul class="loc-footer__list">
                <li><a href="/contact">Contact Me</a></li>
                <li><a href="/cancellation-policy">Cancellation Policy</a></li>
            </ul>
        </div>

        <!-- COLUMN 5 — LEGAL -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">Legal</h4>
            <ul class="loc-footer__list">
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/terms-and-conditions">Terms &amp; Conditions</a></li>
                <li><a href="/cookie-policy">Cookie Policy</a></li>
            </ul>
        </div>

    </div>

    <!-- BOTTOM BAR -->
    <div class="loc-footer__bottom">
        <div class="loc-footer__bottom-inner">

            <!-- COPYRIGHT -->
            <p class="loc-footer__copyright">
                &copy; <?php echo date('Y'); ?> Leicester Oven Cleaning. All rights reserved.
            </p>

            <!-- ICO + INSURANCE -->
            <p class="loc-footer__legal-note">
                ICO Registration: <span class="loc-footer__ico">[Pending Registration]</span> &nbsp;|&nbsp; Fully insured including items worked upon
            </p>

            <!-- SOCIAL ICONS -->
            <div class="loc-footer__social">
                <a href="https://www.facebook.com/LeicesterOvenCleaning" class="loc-footer__social-link" aria-label="Facebook" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="https://www.google.com/maps?cid=1756949504363706380" class="loc-footer__social-link" aria-label="Read my reviews on Google" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 11v3.4h5.6a5.6 5.6 0 0 1-5.6 4.2 6.6 6.6 0 1 1 4.3-11.6l2.4-2.4A10 10 0 1 0 12 22c5.8 0 9.6-4.1 9.6-9.8 0-.7-.1-1.2-.2-1.7z"/></svg>
                </a>
            </div>

        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>