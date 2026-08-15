<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head prefix="og: https://ogp.me/ns#">
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="Web制作, フリーランス, WordPress, ホームページ, サイト, コーディング, 名古屋, コーディング, ワードプレス, 安い, 丁寧, 安心">
    <meta property="og:site_name" content="And 8" />
    <meta property="og:title" content="愛知を中心にフリーランスとしてコーディングをしているAnd 8 -yuiko miyano- のwebサイト" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://andeight.net/" />
    <meta property="og:image" content="https://andeight.net/wp-content/uploads/2025/07/screenshotogp.png" />
    <meta property="og:image:width" content="1196" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:alt" content="And 8 - フリーランスWeb制作ポートフォリオ" />
    <meta property="og:description" content="使いやすいサイトをリーズナブルにご提供。フリーランスだからこそ実現します。名古屋を拠点に全国のお客様へWebサイトをお作りします。お気軽にお問い合わせフォームよりご相談ください。" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="https://andeight.net/wp-content/uploads/2025/07/screenshotogp.png" />
    <meta name="twitter:image:alt" content="And 8 - フリーランスWeb制作ポートフォリオ" />
    <meta name="twitter:site" content="@y_coder_and8" />
    <meta name="twitter:creator" content="@y_coder_and8" />
    <meta name="x:card" content="summary_large_image" />
    <meta name="x:image" content="https://andeight.net/wp-content/uploads/2025/07/screenshotogp.png" />
    <meta name="x:image:alt" content="And 8 - フリーランスWeb制作ポートフォリオ" />
    <meta name="x:site" content="@y_coder_and8" />
    <meta name="x:creator" content="@y_coder_and8" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> class="js-fix" >
    <?php wp_body_open(); ?>
        <div class="l-wrapper" id="js-wrapper">
            <div class="js-fix content-wrapper" id="js-content">
                <header class="l-header" role="banner"  id="top">
                    <div class="p-header__inner" >
                        <div class="u-text__small p-header__title">
                            <h1 class="p-header__logo--area">
                            <?php if ( function_exists( 'get_custom_logo' ) ) {
                                    $logo_html = get_custom_logo();

                                    if ( $logo_html ) {
                                        // WordPressが自動で出力する class="custom-logo" を、自分の好きなクラス名に置き換える
                                        echo str_replace( 'class="custom-logo"', 'class="p-header__logo"', $logo_html );
                                    } else {
                                        // カスタムロゴが未設定の場合はデフォルト画像を表示
                                        echo '<img src="' . esc_url( get_theme_file_uri( 'picture/logo2.webp' ) ) . '" class="p-header__logo" alt="and 8 ロゴ">';
                                    }
                                } ?>
                            </h1>
                        </div>
                        <div class="header_link p-header__nav">
                            <nav class="p-header__navarea" id="">
                            <?php if (has_nav_menu('header')) : ?>
                                <?php wp_nav_menu( array(
                                'menu' => '',
                                'container'=> false, //自動でulを囲うdivを消す
                                'menu_class' => 'p-header__menulist',//ulクラス
                                'fallback_cb' => false, 
                                'echo' => true,
                                'depth' => 1,
                                'theme_location' => 'header',
                                'item_spacing' => 'false'
                                ) ); ?>
                            <?php else : ?>
                                <p class="l-sidebar__menu__list">メニューはまだ設定されていません。</p>
                            <?php endif; ?>
                            </nav>
                        </div><!--header_link-->
                    </div>
                </header> 