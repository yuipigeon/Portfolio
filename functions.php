<?php
//テーマサポート
add_theme_support( 'title-tag' );
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support( 'custom-logo' );
add_theme_support( 'custom-background');
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );
add_theme_support( 'editor-styles' ); //エディタースタイルを有効化


//CSSファイルの読み込み ress.cssの後にstyle.cssを読み込む
function my_enqueue_assets(){
    
    wp_enqueue_style('style',get_theme_file_uri('dist/style.css'),array(),'1.0.8','all');
    // Swiper はモーダル初回オープン時に JS から動的読み込み（初期表示の軽量化）
    wp_enqueue_script('gsap', get_theme_file_uri('js/gsap.min.js'), array(), '3.13.0', true);
    wp_enqueue_script('scrolltoplugin', get_theme_file_uri('js/ScrollToPlugin.min.js'), array('gsap'), '3.13.0', true);
    wp_enqueue_script('scrolltrigger', get_theme_file_uri('js/ScrollTrigger.min.js'), array('gsap'), '3.13.0', true);
    wp_enqueue_script('scrollsmoother', get_theme_file_uri('js/ScrollSmoother.min.js'), array('gsap','scrolltrigger'), '3.13.0', true);
    wp_enqueue_script('main',get_theme_file_uri('dist/bundle.js'),array('gsap', 'scrolltrigger', 'scrollsmoother', 'scrolltoplugin'),'1.0.10',true);
    // wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    

    wp_localize_script('main', 'wpData', [
        'isFrontPage' => is_front_page(),
        'themeUri' => trailingslashit( get_theme_file_uri() ),
        'swiperJs' => get_theme_file_uri('js/swiper-bundle.min.js'),
        'swiperCss' => get_theme_file_uri('css/swiper-bundle.css'),
      ]);
}
add_action('wp_enqueue_scripts','my_enqueue_assets');

//タイトルに詳細を非表示
function rewrite_title($title) {
    if (is_front_page()) {
        $title['tagline'] = '';//ここで非表示
      }
    return $title;
    }
  add_filter('document_title_parts', 'rewrite_title');

  

//pタグを自動挿入しない
remove_filter('the_content','wpautop');


//サイドバーのウィジェットエリアを作成 「メニューの位置」に新しく項目を登録
add_action('after_setup_theme',function(){
    register_nav_menus( array(
        'header' => 'ヘッダーのメニュー',
        'hamburger' => 'ハンバーガーメニュー',
    ));
});

function my_theme_setup() {
    add_theme_support( 'html5', array(
        'search-form',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo',array(
        'height'      => 109,       
        'width'       => 347,       
        'flex-height' => true,      // 高さの柔軟対応
        'flex-width'  => true,      // 幅の柔軟対応
        ) );
}
add_action( 'after_setup_theme', 'my_theme_setup' );

//同じカウントをclass名追加で利用
$menu_item_counter = 0;

// liタグにクラスを追加（1番目のみ）
function add_menu_li_class($classes, $item, $args, $depth) {
    global $menu_item_counter; 

    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'header') {
        if ($depth == 0) {
            $menu_item_counter++;
            
            if ($menu_item_counter == 1) {
                $classes[] = 'u-width__text'; // 1番目のliにのみクラス追加
            }
        }
    }
   return $classes;
}
add_filter('nav_menu_css_class','add_menu_li_class', 10, 4);//nav_menu_css_classはliタグにclass名追加


// 全てのaタグにc-link__listを付与、1つめと2つめに特別クラスを追加

function add_menu_headerLink_class($atts, $item, $args, $depth) {
    global $menu_item_counter; 
    
    // $argsがオブジェクトかつtheme_locationが設定されているかをチェック
    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'header') {
        if ($depth == 0) {
            
            // 全てのaタグにc-link__listを付与
            $classes = 'c-link__list';
            
            // 何番目かによってクラスを変える
            if ($menu_item_counter == 1) {
                $classes .= ' u-padding__left--xxsmall';
            } elseif ($menu_item_counter == 5) {
                $classes .= ' c-button__contact--text';
            }
            
            // 既存のクラスがある場合は追加、ない場合は新規作成
            if (isset($atts['class'])) {
                $atts['class'] .= ' ' . $classes;
            } else {
                $atts['class'] = $classes;
            }
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_headerLink_class', 10, 4);//nav_menu_link_attributesはaタグにclass名追加

// 5番目のメニュー項目にdivとspanを追加
function modify_menu_item_output($item_output, $item, $depth, $args) {
            global $menu_item_counter; 
    
    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'header') {
        if ($depth == 0) {
            // li関数で既にカウントされているので、ここではカウントしない
            
            // 現在のアイテムが何番目かを取得（別の方法）
            static $div_counter = 0;
            $div_counter++;
            
            if ($div_counter == 5) {
                // aタグの中身を取得
                preg_match('/<a[^>]*>(.*?)<\/a>/', $item_output, $matches);
                $link_text = isset($matches[1]) ? $matches[1] : '';
                
                // aタグの属性を取得
                preg_match('/<a([^>]*)>/', $item_output, $attr_matches);
                $link_attrs = isset($attr_matches[1]) ? $attr_matches[1] : '';
                
                // divタグで囲み、aタグの中にspanタグを追加
                $item_output = '<div class="c-button__contact--area">';
                $item_output .= '<a' . $link_attrs . '>';
                $item_output .= '<span class="c-button__contact c-link__list">' . $link_text . '</span>';
                $item_output .= '</a>';
                $item_output .= '</div>';
            }
        }
    }
    
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'modify_menu_item_output', 10, 4);

// hamburgerメニューのliタグにクラスを追加
function add_hamburgermenu_li_class($classes, $item, $args, $depth) {

    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'hamburger') {
        if ($depth == 0) {
            $classes[] = 'p-menu__list';
        }
    }
   return $classes;
}
add_filter('nav_menu_css_class','add_hamburgermenu_li_class', 10, 4);//nav_menu_css_classはliタグにclass名追加

//hamburgerメニューのaタグにクラスを追加
function add_menu_link_class($atts, $item, $args,$depth) {
    
    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'hamburger') {
        if($depth==0){
            $atts['class'] = 'c-link__hamburger js-menu-close';
            }// １階層目　aタグにクラスを追加
        }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 4);

//.is-style-works-image クラスを持つ画像ブロックに data-index を追加
function add_data_index_to_img_in_works_block($block_content, $block) {
    static $index = 0;

    // 対象：core/image ブロックで、クラス名に is-style-works-image を含む
    if (
        isset($block['blockName']) &&
        $block['blockName'] === 'core/image' &&
        isset($block['attrs']['className']) &&
        strpos($block['attrs']['className'], 'is-style-works-image') !== false
    ) {
        // <img>タグを探して data-index を挿入（すでについていなければ）
        if (strpos($block_content, 'data-index=') === false) {
            $block_content = preg_replace(
                '/(<img[^>]*?)\/?>/',
                '$1 data-index="' . $index . '" />',
                $block_content,
                1
            );
            $index++;
        }
    }

    return $block_content;
}
add_filter('render_block', 'add_data_index_to_img_in_works_block', 10, 2);

// カスタム投稿タイプにリビジョン追加
function add_posttype_revisions() {
    add_post_type_support( 'column', 'revisions' );
}
add_action('init', 'add_posttype_revisions');

//独自スタイルの追加
function custom_block_styles() {
    // 独自のブロックスタイルを登録する
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'service-text', // スタイル名
            'label'        => 'サービス上部のテキスト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/columns', // ブロック名
        array(
            'name'         => 'card-wrap', // スタイル名
            'label'        => 'serviceブロック全体', // スタイルの表示名
        )
    );
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-price', // スタイル名
            'label'        => 'priceブロック全体', // スタイルの表示名
        )
    );
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-left', // スタイル名
            'label'        => 'codingブロック全体', // スタイルの表示名
        )
    );
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-center', // スタイル名
            'label'        => 'WordPressブロック全体', // スタイルの表示名
        )
    );
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-right', // スタイル名
            'label'        => 'upkeepブロック全体', // スタイルの表示名
        )
    );
    register_block_style(
        'core/heading', // ブロック名
        array(
            'name'         => 'service-heading', // スタイル名
            'label'        => 'サービス各項目の見出し', // スタイルの表示名
        )
    );
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'service-sentence', // スタイル名
            'label'        => 'サービスアイコン下の説明文', // スタイルの表示名
        )
    );
    register_block_style(
        'core/image', // ブロック名
        array(
            'name'         => 'profile', // スタイル名
            'label'        => 'プロフィールの画像レイアウト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'grid-profile', // スタイル名
            'label'        => 'profile大枠のグリッド', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'grid-profile-textarea-1', // スタイル名
            'label'        => 'プロフィール上部のテキストの枠', // スタイルの表示名
        )
    );

    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'grid-profile-textarea-2', // スタイル名
            'label'        => '写真右横のテキストの枠', // スタイルの表示名
        )
    );
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'profile-text-1', // スタイル名
            'label'        => 'プロフィール上部のテキスト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'profile-text-2', // スタイル名
            'label'        => '写真右横のキスト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'profile-skill', // スタイル名
            'label'        => 'プロフィールスキル', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'grid-works', // スタイル名
            'label'        => 'works大枠のグリッド', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'grid-cell-works', // スタイル名
            'label'        => 'worksセルのグリッド', // スタイルの表示名
        )
    );
    register_block_style(
        'core/image', // ブロック名
        array(
            'name'         => 'works-image','js-open-modal', // スタイル名
            'label'        => '実績画像', // スタイルの表示名
        )
    );
    register_block_style(
        'core/columns', // ブロック名
        array(
            'name'         => 'works-textarea', // スタイル名
            'label'        => '実績画像下のテキストエリア', // スタイルの表示名
        )
    );
    register_block_style(
        'core/heading', // ブロック名
        array(
            'name'         => 'work-heading', // スタイル名
            'label'        => '各実績の見出し', // スタイルの表示名
        )
    );
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'work-description', // スタイル名
            'label'        => '各実績詳細', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'icon-left', // スタイル名
            'label'        => '左のアイコン(Link)', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'icon-right', // スタイル名
            'label'        => '右のアイコン(Git)', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'grid-space-horizon', // スタイル名
            'label'        => 'grid左右のスペース', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'grid-space-vertical', // スタイル名
            'label'        => 'grid上下のスペース', // スタイルの表示名
        )
    );
    
    register_block_style(
        'core/gallery', // ブロック名
        array(
            'name'         => 'works-gallery', // スタイル名
            'label'        => 'worksのgallery', // スタイルの表示名
        )
    );
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'contact-text', // スタイル名
            'label'        => 'コンタクト上部のテキスト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'contact-form', // スタイル名
            'label'        => 'コンタクトフォーム', // スタイルの表示名
        )
    );
    //privacy
    register_block_style(
        'core/paragraph', // ブロック名
        array(
            'name'         => 'line-height', // スタイル名
            'label'        => 'プライバシーポリシー行間', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'privacy', // スタイル名
            'label'        => 'privacyレイアウト', // スタイルの表示名
        )
    );
}
add_action( 'init', 'custom_block_styles' );

// 
//     // ブロック名 + 対象スタイル => 追加するクラス名の対応表
//     $targets = [
//         'core/paragraph' => [
//             'is-style-service-text' => 'p-slide__in',
//             'is-style-profile-text-1' => 'p-slide__in',
//             'is-style-profile-text-2' => 'p-slide__in',
//             'is-style-contact-text' => 'p-slide__in',
//         ],
//         'core/image' => [
//             'is-style-profile' => 'p-slide__in',
//         ],
//         'core/group' => [
//             'is-style-grid-cell-works' => 'p-slide__in',
//             'is-style-contact-form' => 'p-slide__in',
//         ],
//         'core/column' => [
//             'is-style-card-left' => 'p-slide__in',
//             'is-style-card-center' => 'p-slide__in',
//             'is-style-card-right' => 'p-slide__in',
//             'is-style-card-price' => 'p-slide__in',
//         ],
//         // 必要に応じて追加
//     

    function add_slide_in_class( $block_content, $block ) {
        if ( ! isset( $block['attrs']['className'] ) ) return $block_content;
    
        // 対象のスタイルが含まれているか（例：is-style-）
        $style_keywords = [
        'is-style-contact-text',
        'is-style-service-text',
        'is-style-profile-text-1',
        'is-style-profile-text-2',
        'is-style-card-left',
        'is-style-card-right',
        'is-style-card-center',
        'is-style-card-price',
        'is-style-grid-cell-works',
        'is-style-contact-form',
        'is-style-profile',
    ];
        $matched = false;
    
        foreach ( $style_keywords as $keyword ) {
            if ( strpos( $block['attrs']['className'], $keyword ) !== false ) {
                $matched = true;
                break;
            }
        }
    
        if ( $matched ) {
            // すでに p-slide__in が入っていないかチェック
            if ( strpos( $block_content, 'p-slide__in' ) === false ) {
                // class="..." に p-slide__in を追加
                $block_content = preg_replace(
                    '/class="([^"]*)"/',
                    'class="$1 p-slide__in"',
                    $block_content,
                    1
                );
            }
        }
    
        return $block_content;
    }
    add_filter( 'render_block', 'add_slide_in_class', 10, 2 );