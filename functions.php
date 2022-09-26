<?php 
function init_template(){

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    register_nav_menus(
        array(
            'top_menu' => 'Menú Principal'
        )
    );

}

//Hook que ejecuta la función init_template, sin retornar valores. 
add_action('after_setup_theme','init_template');

function assets(){

    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css','','5.2.0','all');
    wp_register_style('montserrat','https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap','','1.0','all');
    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap', 'montserrat'),'1.0.0','all' );
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js','','2.11.6',true);
    wp_enqueue_script('bootstraps','https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js', array('jquery','popper'),'5.2.1',true);

    //cargar los archivos de Js
    wp_enqueue_script('custom',get_template_directory_uri().'/assets/js/custom.js','1.0.0',true);

} 
//Hook que ejecuta la función assets, sin retornar valores. 
add_action('wp_enqueue_scripts','assets');

function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de página',
            'id'   => 'footer',
            'description' => 'Zona de Widgets para pie de página',
            'before_title' => '<p>',
            'after_title'  => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
        )
        );
}
add_action('widgets_init', 'sidebar');

function info_type(){
    $labels = array(
        'name' => 'info',
        'singular_name' => 'info',
        'manu_name' => 'info',
    );

    $args = array(
        'label'  => 'info', 
        'description' => 'Todo WordPress',
        'labels'       => $labels,
        'supports'   => array('title','editor','thumbnail', 'revisions'),
        'public'    => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite'       => true,
        'show_in_rest' => true

    );    
    register_post_type('info', $args);
}

add_action('init', 'info_type');