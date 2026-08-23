<?php
/**
 * Single post template — Leicester Oven Cleaning
 * Individual blog article page
 */

get_header();
?>

<main id="loc-single">

    <?php while (have_posts()): the_post(); ?>

    <!-- ARTICLE HEADER -->
    <section class="loc-page-header">
        <div class="loc-single-header__inner">
            <div class="loc-single-header__meta">
                <?php
                $categories = get_the_category();
                if ($categories) {
                    echo '<span class="loc-single-header__cat">' . esc_html($categories[0]->name) . '</span>';
                }
                ?>
                <span class="loc-single-header__date"><?php echo get_the_date('j F Y'); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- ARTICLE BODY -->
    <div class="loc-single-body">
        <div class="loc-single-body__inner">

            <!-- CONTENT -->
            <article class="loc-single-content">

                <?php if (has_post_thumbnail()): ?>
                <div class="loc-single-featured-image">
                    <?php the_post_thumbnail('large', ['class' => 'loc-single-featured-img']); ?>
                </div>
                <?php endif; ?>

                <div class="loc-single-prose">
                    <?php the_content(); ?>
                </div>

                <!-- ARTICLE FOOTER -->
                <div class="loc-single-footer">
                    <a href="/blog" class="loc-single-back">← Back to all articles</a>
                </div>

            </article>

            <!-- SIDEBAR -->
            <aside class="loc-blog-sidebar">

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

                <div class="loc-blog-sidebar__cta">
                    <p class="loc-blog-sidebar__cta-title">Ready to get your oven cleaned?</p>
                    <p class="loc-blog-sidebar__cta-sub">Prices from <?php echo loc_from_price(); ?>. Back to cooking the same day. No card needed to reserve.</p>
                    <a href="/reserve-step-1" class="btn-primary loc-blog-sidebar__cta-btn">Reserve Your Slot →</a>
                </div>

            </aside>

        </div>
    </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>