<?php
/**
 * The template for displaying single workshop posts
 */

get_header();
?>

<article class="py-12">
    <div class="container-custom">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header class="max-w-4xl mx-auto text-center mb-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading mb-6">
                    <?php the_title(); ?>
                </h1>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-w-16 aspect-h-9 mb-8">
                        <?php the_post_thumbnail('full', array('class' => 'object-cover w-full h-full rounded-lg shadow-lg')); ?>
                    </div>
                <?php endif; ?>

                <div class="flex justify-center gap-6 text-secondary">
                    <?php 
                    $workshop_date = get_post_meta(get_the_ID(), 'workshop_date', true);
                    $workshop_duration = get_post_meta(get_the_ID(), 'workshop_duration', true);
                    $workshop_price = get_post_meta(get_the_ID(), 'workshop_price', true);
                    ?>
                    
                    <?php if ($workshop_date) : ?>
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($workshop_date))); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if ($workshop_duration) : ?>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span><?php echo esc_html($workshop_duration); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if ($workshop_price) : ?>
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        <span><?php echo esc_html($workshop_price); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </header>

            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg mx-auto">
                    <?php the_content(); ?>
                </div>

                <?php
                // Workshop Registration Form or CTA
                $registration_link = get_post_meta(get_the_ID(), 'registration_link', true);
                if ($registration_link) :
                ?>
                <div class="mt-12 text-center">
                    <a href="<?php echo esc_url($registration_link); ?>" 
                       class="inline-block px-8 py-3 bg-accent text-white rounded-md hover:bg-accent/90 transition-colors"
                       target="_blank"
                       rel="noopener noreferrer">
                        <?php _e('Register for this Workshop', 'katie-bray'); ?>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Workshop Details Box -->
                <div class="mt-12 bg-background rounded-lg p-8 shadow-sm">
                    <h2 class="text-2xl font-heading mb-6"><?php _e('Workshop Details', 'katie-bray'); ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2"><?php _e('What to Bring', 'katie-bray'); ?></h3>
                            <?php 
                            $what_to_bring = get_post_meta(get_the_ID(), 'what_to_bring', true);
                            if ($what_to_bring) {
                                echo '<div class="text-secondary">' . wp_kses_post($what_to_bring) . '</div>';
                            }
                            ?>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2"><?php _e('Prerequisites', 'katie-bray'); ?></h3>
                            <?php 
                            $prerequisites = get_post_meta(get_the_ID(), 'prerequisites', true);
                            if ($prerequisites) {
                                echo '<div class="text-secondary">' . wp_kses_post($prerequisites) . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-12 border-t border-border pt-6">
                    <div class="flex justify-between">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <div>
                            <?php if ($prev_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
                                   class="flex items-center text-secondary hover:text-accent transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    <span class="text-sm"><?php echo esc_html($prev_post->post_title); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <?php if ($next_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
                                   class="flex items-center text-secondary hover:text-accent transition-colors">
                                    <span class="text-sm"><?php echo esc_html($next_post->post_title); ?></span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>

        <?php endwhile; endif; ?>
    </div>
</article>

<?php
get_footer();
