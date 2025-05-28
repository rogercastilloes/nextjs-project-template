<?php
/**
 * The template for displaying workshop archives
 */

get_header();
?>

<div class="py-12 bg-background">
    <div class="container-custom">
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading mb-6">
                <?php _e('Creative Workshops', 'katie-bray'); ?>
            </h1>
            <p class="text-lg text-secondary max-w-2xl mx-auto">
                <?php _e('Explore our range of creative workshops designed to inspire and enhance your artistic skills.', 'katie-bray'); ?>
            </p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="workshop-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <?php the_post_thumbnail('large', array('class' => 'object-cover w-full h-full')); ?>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <h2 class="text-xl font-heading mb-2">
                                <?php the_title(); ?>
                            </h2>
                            <div class="text-secondary mb-4">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <?php 
                                $workshop_date = get_post_meta(get_the_ID(), 'workshop_date', true);
                                if ($workshop_date) : 
                                ?>
                                    <span class="text-sm text-secondary">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($workshop_date))); ?>
                                    </span>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" 
                                   class="inline-block px-6 py-2 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors">
                                    <?php _e('Learn More', 'katie-bray'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            $pagination = get_the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Previous', 'katie-bray'),
                'next_text' => __('Next', 'katie-bray'),
                'screen_reader_text' => __('Posts navigation', 'katie-bray'),
                'class' => 'mt-12',
            ));

            // Add custom classes to pagination
            $pagination = str_replace('nav-links', 'nav-links flex justify-center gap-2', $pagination);
            $pagination = str_replace('page-numbers', 'page-numbers px-4 py-2 rounded-md border border-primary hover:bg-primary hover:text-white transition-colors', $pagination);
            $pagination = str_replace('current', 'current bg-primary text-white', $pagination);

            echo $pagination;
            ?>

        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-lg text-secondary">
                    <?php _e('No workshops found.', 'katie-bray'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
