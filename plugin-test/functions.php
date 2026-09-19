<?php

define('AMB_PLUGIN_URL', plugins_url('', __FILE__));
define('AMB_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
 
//CSS/JSファイル読み込み
function amb_plugin_enqueue_style_script() {
 
  wp_enqueue_style('add-block-style', AMB_PLUGIN_URL.'/css/add-block.css');
 
}
add_action('wp_enqueue_scripts', 'amb_plugin_enqueue_style_script', 99);
 
//ブロックエディタ用
function amb_add_block_assets() {
 
  wp_enqueue_style('add-block-style', AMB_PLUGIN_URL.'/css/add-block.css');
 
  wp_enqueue_script( 'add-block-script', AMB_PLUGIN_URL.'/js/add-block.js', array(), false, true);
 
}
add_action('enqueue_block_editor_assets', 'amb_add_block_assets');
