<?php
/**
 * Blog listing page — Leicester Oven Cleaning
 * Used when WordPress posts page is set to Blog
 */

get_header();
?>

<main id="loc-blog">

    <!-- PAGE HEADER -->
    <section class="loc-page-header">
        <div class="loc-page-header__inner">
            <p class="loc-page-header__eyebrow section-eyebrow">Advice &amp; Tips</p>
            <h1>The Leicester Oven <span>Cleaning Blog</span></h1>
            <p class="loc-page-header__intro">Practical advice on oven care, appliance maintenance, and getting the most out of your kitchen. Written from experience, not a content farm.</p>
        </div>
    </section>

    <!-- BLOG BODY -->
    <div class="loc-blog-body">
        <div class="loc-blog-body__inner">

            <!-- ARTICLES COLUMN -->
            <div class="loc-blog-articles">

                <?php if (have_posts()): ?>

                    <!-- COMING SOON BANNER — remove once first article published -->
                    <div class="loc-blog-coming-soon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="var(--blue)" stroke-width="2"/><line x1="12" y1="8" x2="12" y2="12" stroke="var(--blue)" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="16" r="1" fill="var(--blue)"/></svg>
                        <p>Articles coming soon — this section will be populated once the business is live and operating.</p>
                    </div>

                    <p class="section-eyebrow">Latest Articles</p>
                    <h2 class="loc-blog-heading">Advice &amp; Tips</h2>

                    <div class="loc-blog-grid">
                        <?php while (have_posts()): the_post(); ?>
                        <article class="loc-blog-card">
                            <div class="loc-blog-card__image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', ['class' => 'loc-blog-card__img']); ?>
                                <?php else: ?>
                                    <div class="loc-blog-card__image-placeholder">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" stroke="#1A3A6E" stroke-width="2"/><circle cx="8.5" cy="8.5" r="1.5" fill="#1A3A6E"/><polyline points="21 15 16 10 5 21" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span>Article image</span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo '<span class="loc-blog-card__category">' . esc_html($categories[0]->name) . '</span>';
                                }
                                ?>
                            </div>
                            <div class="loc-blog-card__body">
                                <div>
                                    <p class="loc-blog-card__title"><?php the_title(); ?></p>
                                    <p class="loc-blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 28, '...'); ?></p>
                                </div>
                                <div class="loc-blog-card__meta">
                                    <span class="loc-blog-card__date"><?php echo get_the_date('j F Y'); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="loc-blog-card__read">Read article →</a>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- PAGINATION -->
                    <div class="loc-blog-pagination">
                        <?php the_posts_pagination(['prev_text' => '← Older articles', 'next_text' => 'Newer articles →']); ?>
                    </div>

                <?php else: ?>

                    <!-- EMPTY STATE — no posts yet -->
                    <div class="loc-blog-coming-soon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="var(--blue)" stroke-width="2"/><line x1="12" y1="8" x2="12" y2="12" stroke="var(--blue)" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="16" r="1" fill="var(--blue)"/></svg>
                        <p>Articles coming soon — this section will be populated once the business is live and operating.</p>
                    </div>

                    <div class="loc-blog-empty">
                        <div class="loc-blog-empty__icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="#1A3A6E" stroke-width="2"/><polyline points="14 2 14 8 20 8" stroke="#1A3A6E" stroke-width="2"/><line x1="16" y1="13" x2="8" y2="13" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round"/><line x1="16" y1="17" x2="8" y2="17" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <h3>Articles coming soon</h3>
                        <p>I'm out cleaning ovens right now. Articles will appear here once the business is up and running — practical advice written from real experience.</p>
                    </div>

                <?php endif; ?>

            </div>

            <!-- SIDEBAR -->
            <aside class="loc-blog-sidebar">

                <!-- CATEGORIES -->
                <div class="loc-blog-sidebar__section">
                    <p class="loc-blog-sidebar__title">Categories</p>
                    <ul class="loc-blog-sidebar__cats">
                        <?php
                        $categories = get_categories(['hide_empty' => false]);
                        foreach ($categories as $cat):
                        ?>
                        <li>
                            <a href="<?php echo get_category_link($cat->term_id); ?>">
                                <?php echo esc_html($cat->name); ?>
                                <span class="loc-blog-sidebar__count"><?php echo $cat->count > 0 ? $cat->count : '—'; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- SIDEBAR CTA -->
                <div class="loc-blog-sidebar__cta">
                    <p class="loc-blog-sidebar__cta-title">Ready to get your oven cleaned?</p>
                    <p class="loc-blog-sidebar__cta-sub">Prices from <?php echo loc_from_price(); ?>. Back to cooking the same day. No card needed to reserve.</p>
                    <a href="/reserve-step-1" class="btn-primary loc-blog-sidebar__cta-btn">Reserve Your Slot →</a>
                </div>

            </aside>

        </div>
    </div>

</main>

<?php get_footer(); ?>