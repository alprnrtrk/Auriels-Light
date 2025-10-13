<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-template="<?php echo esc_attr( aurielslight_get_template_context() ); ?>">
  <?php wp_body_open(); ?>
  <div id="page" class="site">

    <header data-partial="site-header" class="site-header relative overflow-hidden text-white">
      <div class="site-header__backdrop" aria-hidden="true"></div>
      <div class="container relative z-10 mx-auto flex flex-col gap-6 px-6 py-6 lg:flex-row lg:items-center lg:justify-between lg:py-8">
        <div class="flex w-full items-start justify-between gap-6 lg:max-w-sm lg:flex-col">
          <div class="site-header__branding">
            <?php if (has_custom_logo()) : ?>
              <div class="site-header__logo">
                <?php the_custom_logo(); ?>
              </div>
            <?php endif; ?>
            <?php
            $site_name = get_bloginfo('name');
            $tagline   = get_bloginfo('description', 'display');
            ?>
            <?php if ($site_name) : ?>
              <?php $title_tag = (is_front_page() || is_home()) ? 'h1' : 'p'; ?>
              <<?php echo $title_tag; ?> class="site-header__title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                  <?php echo esc_html($site_name); ?>
                </a>
              </<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php if ($tagline) : ?>
              <p class="site-header__tagline"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>
          </div>

          <button class="site-header__toggle lg:hidden" type="button" data-header-toggle aria-expanded="false" aria-controls="primary-navigation">
            <span class="sr-only"><?php esc_html_e('Toggle navigation', 'aurielslight'); ?></span>
            <span class="site-header__toggle-icon" aria-hidden="true">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
        </div>

        <nav id="primary-navigation" class="site-header__nav" data-header-menu>
          <?php
          // Primary navigation: the last menu item is styled as a prominent call-to-action.
          wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'menu_id'        => 'primary-menu',
              'menu_class'     => 'primary-menu',
              'container'      => false,
              'fallback_cb'    => '__return_empty_string',
              'depth'          => 1,
            )
          );
          ?>
        </nav>
      </div>
    </header>

    <div id="content" class="site-content">


