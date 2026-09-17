        <?php get_header(); ?>
        <!--hamburgerbutton-->
        <div  class="c-hamburger__button--area" id="js-hamburger">
            <div class="c-hamburger__button--open" ></div>
        </div>
        <!--hamburgerbutton-->
        <!--hamburgermenu-->
        <nav class="p-menu" id="js-nav">
            <div class="p-menu__inner">
                <div  class="c-hamburger__button--area" id="js-hamburger-close">
                    <div class="c-hamburger__button--close" id="js-close-button"></div>
                </div>
                <div class="p-menu__contents">
                    <?php if (has_nav_menu('hamburger')) : ?>
                    <?php wp_nav_menu( array(
                        'menu' => '',
                        'container'=> false, //自動でulを囲うdivを消す
                        'menu_class' => 'p-menu__menulist',//ulクラス
                        'fallback_cb' => false, 
                        'echo' => true,
                        'depth' => 1,
                        'theme_location' => 'hamburger',
                        'item_spacing' => 'false'
                    )); ?>
                    <?php else : ?>
                        <p class="p-menu__menulist">メニューはまだ設定されていません。</p>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <div id="smooth-wrapper">
            <div id="smooth-content">
                <div class="p-smooth__background" id="js-smooth">
                    <main  class="l-main l-main__font">
                        <div class="p-hero" id="hero">
                            <img src="<?php echo get_theme_file_uri( 'picture/flowerbackground.webp' ); ?>" alt="白い一輪挿しに入った白い花の写真" class="p-hero__background--image">
                            <div class="p-hero__background"></div>
                            <p class="c-title__hero p-title__hero" id="js-title-hero"><span data-lag="0.08">Beyond the visible.Living code behind design.</span></p>
                        </div>
                        <div id="service">
                        <?php
                            $post_id = 28; // 表示したい投稿のID
                            $query = new WP_Query( array( 'p' => $post_id, 'post_type' => 'post' ) );
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    get_template_part( 'template-parts/content', 'single' ); // パーツを呼び出す。template-parts/contentについては後述。
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </div>
                        <div id="works">
                            <?php
                                $post_id = 7; // 表示したい投稿のID
                                $query = new WP_Query( array( 'p' => $post_id, 'post_type' => 'post' ) );
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        get_template_part( 'template-parts/content', 'single' ); // パーツを呼び出す。template-parts/contentについては後述。
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                        </div>
                        <div id="profile">
                            <?php
                                $post_id = 26; // 表示したい投稿のID
                                $query = new WP_Query( array( 'p' => $post_id, 'post_type' => 'post' ) );
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        get_template_part( 'template-parts/content', 'single' ); // パーツを呼び出す。template-parts/contentについては後述。
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                        </div>
                        <div id="contact">
                            <?php
                                $post_id = 30; // 表示したい投稿のID
                                $query = new WP_Query( array( 'p' => $post_id, 'post_type' => 'post' ) );
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        get_template_part( 'template-parts/content', 'single' ); // パーツを呼び出す。template-parts/contentについては後述。
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                        </div>
                    </main>
                    <?php get_footer(); ?> 