<?php
/**
 * Template Name: About Page
 */

get_header();
?>

<div class="py-12 bg-background">
    <div class="container-custom">
        <header class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading mb-6">
                <?php the_title(); ?>
            </h1>
            <p class="text-lg text-secondary max-w-2xl mx-auto">
                <?php _e('Artist, illustrator, and workshop host based in Madrid, Spain.', 'katie-bray'); ?>
            </p>
        </header>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="max-w-4xl mx-auto">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-w-16 aspect-h-9 mb-12">
                        <?php the_post_thumbnail('full', array('class' => 'object-cover w-full h-full rounded-lg shadow-lg')); ?>
                    </div>
                <?php endif; ?>

                <div class="prose prose-lg mx-auto">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; endif; ?>

        <!-- Experience Section -->
        <section class="mt-20">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-heading text-center mb-12">
                    <?php _e('Experience & Expertise', 'katie-bray'); ?>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Years of Experience -->
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                        <i class="fas fa-star text-accent text-3xl mb-4"></i>
                        <h3 class="text-xl font-heading mb-2"><?php _e('10+ Years', 'katie-bray'); ?></h3>
                        <p class="text-secondary"><?php _e('Professional experience in illustration and art direction', 'katie-bray'); ?></p>
                    </div>

                    <!-- Workshops -->
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                        <i class="fas fa-users text-accent text-3xl mb-4"></i>
                        <h3 class="text-xl font-heading mb-2"><?php _e('500+ Students', 'katie-bray'); ?></h3>
                        <p class="text-secondary"><?php _e('Taught and inspired through creative workshops', 'katie-bray'); ?></p>
                    </div>

                    <!-- Projects -->
                    <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                        <i class="fas fa-pencil-alt text-accent text-3xl mb-4"></i>
                        <h3 class="text-xl font-heading mb-2"><?php _e('100+ Projects', 'katie-bray'); ?></h3>
                        <p class="text-secondary"><?php _e('Completed for clients worldwide', 'katie-bray'); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="mt-20 text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-heading mb-6">
                    <?php _e('Ready to Start Your Creative Journey?', 'katie-bray'); ?>
                </h2>
                <p class="text-lg text-secondary mb-8">
                    <?php _e('Join one of our workshops and discover your artistic potential in a supportive environment.', 'katie-bray'); ?>
                </p>
                <div class="flex justify-center gap-4">
                    <a href="<?php echo esc_url(get_post_type_archive_link('workshop')); ?>" 
                       class="inline-block px-8 py-3 bg-accent text-white rounded-md hover:bg-accent/90 transition-colors">
                        <?php _e('View Workshops', 'katie-bray'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" 
                       class="inline-block px-8 py-3 border-2 border-primary text-primary hover:bg-primary hover:text-white transition-colors rounded-md">
                        <?php _e('Contact Me', 'katie-bray'); ?>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
