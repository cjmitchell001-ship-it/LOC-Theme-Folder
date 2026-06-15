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
                <span class="loc-footer__badge">✓ ICO Registered</span>
            </div>
        </div>

        <!-- COLUMN 2 — SERVICES -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">Services</h4>
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
            <h4 class="loc-footer__heading">Company</h4>
            <ul class="loc-footer__list">
                <li><a href="/about">About Us</a></li>
                <li><a href="/how-we-work">How We Work</a></li>
                <li><a href="/areas">Areas Covered</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/faq">FAQ</a></li>
            </ul>
        </div>

        <!-- COLUMN 4 — HELP -->
        <div class="loc-footer__col">
            <h4 class="loc-footer__heading">Help</h4>
            <ul class="loc-footer__list">
                <li><a href="/contact">Contact Us</a></li>
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
                &copy; <?php echo date('Y'); ?> Leicester Oven Cleaning — Trading as The Proper-T Cleaning Group. All rights reserved.
            </p>

            <!-- ICO + INSURANCE -->
            <p class="loc-footer__legal-note">
                ICO Registration: <span class="loc-footer__ico">[Pending Registration]</span> &nbsp;|&nbsp; Fully insured including items worked upon
            </p>

            <!-- SOCIAL ICONS -->
            <div class="loc-footer__social">
                <a href="#" class="loc-footer__social-link" aria-label="Facebook" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" class="loc-footer__social-link" aria-label="Instagram" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                <a href="#" class="loc-footer__social-link" aria-label="Google Business Profile" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </a>
            </div>

        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>