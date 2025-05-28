<?php
/**
 * Template Name: Contact Page
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
                <?php _e('Have a question about workshops or want to collaborate? Get in touch!', 'katie-bray'); ?>
            </p>
        </header>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <h2 class="text-2xl font-heading mb-6"><?php _e('Get in Touch', 'katie-bray'); ?></h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium mb-1"><?php _e('Location', 'katie-bray'); ?></h3>
                                <p class="text-secondary">Madrid, Spain</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium mb-1"><?php _e('Email', 'katie-bray'); ?></h3>
                                <p class="text-secondary"><?php echo antispambot('contact@katiebray.com'); ?></p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-accent"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium mb-1"><?php _e('Office Hours', 'katie-bray'); ?></h3>
                                <p class="text-secondary">
                                    <?php _e('Monday - Friday', 'katie-bray'); ?><br>
                                    <?php _e('9:00 AM - 6:00 PM CET', 'katie-bray'); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-4"><?php _e('Follow Me', 'katie-bray'); ?></h3>
                        <div class="flex space-x-4">
                            <a href="https://instagram.com" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white hover:bg-accent transition-colors"
                               aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://twitter.com" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white hover:bg-accent transition-colors"
                               aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://linkedin.com" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white hover:bg-accent transition-colors"
                               aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <h2 class="text-2xl font-heading mb-6"><?php _e('Send a Message', 'katie-bray'); ?></h2>
                    
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="space-y-6">
                        <?php wp_nonce_field('contact_form_submit', 'contact_nonce'); ?>
                        <input type="hidden" name="action" value="contact_form_submit">

                        <div>
                            <label for="name" class="block text-sm font-medium mb-2"><?php _e('Name', 'katie-bray'); ?></label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required 
                                   class="input-field"
                                   placeholder="<?php esc_attr_e('Your name', 'katie-bray'); ?>">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-2"><?php _e('Email', 'katie-bray'); ?></label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required 
                                   class="input-field"
                                   placeholder="<?php esc_attr_e('your.email@example.com', 'katie-bray'); ?>">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium mb-2"><?php _e('Subject', 'katie-bray'); ?></label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   required 
                                   class="input-field"
                                   placeholder="<?php esc_attr_e('What is this about?', 'katie-bray'); ?>">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium mb-2"><?php _e('Message', 'katie-bray'); ?></label>
                            <textarea id="message" 
                                      name="message" 
                                      required 
                                      rows="5" 
                                      class="input-field"
                                      placeholder="<?php esc_attr_e('Your message...', 'katie-bray'); ?>"></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full px-8 py-3 bg-accent text-white rounded-md hover:bg-accent/90 transition-colors">
                            <?php _e('Send Message', 'katie-bray'); ?>
                        </button>
                    </form>

                    <?php
                    // Display form success/error messages if any
                    if (isset($_GET['status'])) {
                        $message_class = 'p-4 rounded-md mt-6 ';
                        $message = '';

                        if ($_GET['status'] === 'success') {
                            $message_class .= 'bg-green-50 text-green-800';
                            $message = __('Thank you for your message! We\'ll get back to you soon.', 'katie-bray');
                        } elseif ($_GET['status'] === 'error') {
                            $message_class .= 'bg-red-50 text-red-800';
                            $message = __('There was an error sending your message. Please try again.', 'katie-bray');
                        }

                        if ($message) {
                            echo '<div class="' . esc_attr($message_class) . '">' . esc_html($message) . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
