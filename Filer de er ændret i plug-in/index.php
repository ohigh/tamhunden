<?php

$nd_learning_visualcomposer_enable = get_option('nd_learning_visualcomposer_enable');
if ( $nd_learning_visualcomposer_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

function nd_learning_build_select_archive($nd_learning_tax,$nd_learning_i,$nd_learning_select_value){ 
  
  //get all terms
  $nd_learning_terms = get_terms($nd_learning_tax);
  
  //get tax
  $nd_learning_the_tax = get_taxonomy($nd_learning_tax);
  
  //get name
  $nd_learning_tax_name = $nd_learning_the_tax->labels->name;

  if ( $nd_learning_i == 0 ) { $nd_learning_tax_class = 'nd_learning_display_none'; }else{ $nd_learning_tax_class = ''; }

  //START select
  $nd_learning_select = '


  <div id="nd_learning_search_components_tax_'.$nd_learning_i.'" class=" nd_learning_width_100_percentage_all_iphone '.$nd_learning_tax_class.' nd_learning_width_33_percentage nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">

    <select class="nd_learning_section" name="'.$nd_learning_tax.'">';
  
    //default value
    $nd_learning_select .= '<option value="">'.__('All','nd-learning').' '. $nd_learning_tax_name .'</option>';
  
    //built options
    foreach ($nd_learning_terms as $nd_learning_term) {
        
        if ( $nd_learning_term->slug == $nd_learning_select_value ){ $nd_learning_term_selected = 'selected'; }else{ $nd_learning_term_selected = ''; }
        
        $nd_learning_select .= '<option '.$nd_learning_term_selected.' value="' . $nd_learning_term->slug . '">' . $nd_learning_term->name . '</option>';  
    }


  $nd_learning_select .= '</select></div>';
  //END select

  
  return $nd_learning_select;
}









add_action('nd_learning_archive_courses_search','nd_learning_archive_courses_search_content');
function nd_learning_archive_courses_search_content() {


  wp_enqueue_script('masonry');


  //ajax sort/pagination
  wp_enqueue_script( 'nd_learning_search_courses_sorting', plugins_url() . '/nd-learning/addons/search/js/sort.js', array( 'jquery' ) ); 
  wp_localize_script( 'nd_learning_search_courses_sorting', 'nd_learning_my_vars_courses_sorting', array( 'nd_learning_ajaxurl_courses_sorting'   => admin_url( 'admin-ajax.php' )) ); 



  //static
  $nd_learning_qnt_posts_per_page = 6;
  $nd_learning_posttype = 'courses';
  $nd_learning_action = get_post_type_archive_link($nd_learning_posttype);

  //layout
  $nd_learning_customizer_archive_courses_layout = get_option( 'nd_learning_customizer_archive_courses_layout' );
  if ( $nd_learning_customizer_archive_courses_layout == '' ) { $nd_learning_customizer_archive_courses_layout = 'layout-1';  }

  //all taxonomies
  $nd_learning_taxonomy_1 = 'post_tag';
  $nd_learning_taxonomy_2 = 'difficulty-level-course';
  $nd_learning_taxonomy_3 = 'category-course';
  $nd_learning_taxonomy_4 = 'location-course';
  $nd_learning_taxonomy_5 = 'typology-course';
  $nd_learning_taxonomy_6 = 'duration-course';

  //all terms taxonomies
  $nd_learning_term_taxonomy_1 = $_GET[$nd_learning_taxonomy_1];
  $nd_learning_term_taxonomy_2 = $_GET[$nd_learning_taxonomy_2];
  $nd_learning_term_taxonomy_3 = $_GET[$nd_learning_taxonomy_3];
  $nd_learning_term_taxonomy_4 = $_GET[$nd_learning_taxonomy_4];
  $nd_learning_term_taxonomy_5 = $_GET[$nd_learning_taxonomy_5];
  $nd_learning_term_taxonomy_6 = $_GET[$nd_learning_taxonomy_6];

  
  //PREPARE THE ARGS FOR THE WP QUERY
  $args = array(
    'post_type' => ''.$nd_learning_posttype.'',
    'orderby' => 'name',
    'order' => 'ASC',
    
    //pagination
    'posts_per_page' => $nd_learning_qnt_posts_per_page,


    ''.$nd_learning_taxonomy_1.'' => ''.$nd_learning_term_taxonomy_1.'',
    ''.$nd_learning_taxonomy_2.'' => ''.$nd_learning_term_taxonomy_2.'',
    ''.$nd_learning_taxonomy_3.'' => ''.$nd_learning_term_taxonomy_3.'',
    ''.$nd_learning_taxonomy_4.'' => ''.$nd_learning_term_taxonomy_4.'',
    ''.$nd_learning_taxonomy_5.'' => ''.$nd_learning_term_taxonomy_5.'',
    ''.$nd_learning_taxonomy_6.'' => ''.$nd_learning_term_taxonomy_6.''
  );
  //END ARGS FOR WP QUERY
  
  $the_query = new WP_Query( $args );


  //variables
  $nd_learning_qnt_results_posts = $the_query->found_posts;
  $nd_learning_qnt_pagination = ceil($nd_learning_qnt_results_posts / $nd_learning_qnt_posts_per_page);


  $nd_learning_result = '


  <script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
    var $nd_learning_masonry_content = $(".nd_learning_masonry_content").imagesLoaded( function() {
      // init Masonry after all images have loaded
      $nd_learning_masonry_content.masonry({
        itemSelector: ".nd_learning_masonry_item"
      });
    });


      });
      //END masonry

    });

    //]]>
  </script>


';




  $nd_learning_result .= '

    <!--START hidden field for pass datas to ajax pagination-->
    <input id="nd_learning_term_taxonomy_hidden_1" type="hidden" name="nd_learning_term_taxonomy_1" value="'.$nd_learning_term_taxonomy_1.'">
    <input id="nd_learning_term_taxonomy_hidden_2" type="hidden" name="nd_learning_term_taxonomy_2" value="'.$nd_learning_term_taxonomy_2.'">
    <input id="nd_learning_term_taxonomy_hidden_3" type="hidden" name="nd_learning_term_taxonomy_3" value="'.$nd_learning_term_taxonomy_3.'">
    <input id="nd_learning_term_taxonomy_hidden_4" type="hidden" name="nd_learning_term_taxonomy_4" value="'.$nd_learning_term_taxonomy_4.'">
    <input id="nd_learning_term_taxonomy_hidden_5" type="hidden" name="nd_learning_term_taxonomy_5" value="'.$nd_learning_term_taxonomy_5.'">
    <input id="nd_learning_term_taxonomy_hidden_6" type="hidden" name="nd_learning_term_taxonomy_6" value="'.$nd_learning_term_taxonomy_6.'">

    <input id="nd_learning_archive_courses_layoutt" type="hidden" name="nd_learning_archive_courses_layoutt" value="'.$nd_learning_customizer_archive_courses_layout.'">

    <!--END-->

  ';


  //add style if is layout 2
  if ( $nd_learning_customizer_archive_courses_layout == 'layout-2' ) {
    
    $nd_learning_result .= '
      <style>
        #nd_learning_arrive_courses_result_number {
          text-transform: uppercase;
          font-size: 17px;
        }
        #nd_learning_arrive_courses_result_number strong {
          font-weight: normal;
        }

        #nd_learning_btn_sorting_pagination a strong {
          font-weight:normal;
        }

        #nd_learning_archive_courses_btn_sorting_l2 {
          display:none;
        }

        #nd_learning_archive_search_masonry_container {
          margin-top:20px;
        }

      </style>
    ';

  }


  //start page
  $nd_learning_result .= '
    
    <div class="nd_learning_section nd_learning_height_50"></div>
    <div><h1><strong>Øvelser</strong></h1></div>
    <div class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box">
      <h2 id="nd_learning_arrive_courses_result_number"><strong>'.$nd_learning_qnt_results_posts.' '.__('results','nd-learning').'</strong></h2>
    </div>


    <!--START search form-->
    <div class="nd_learning_section nd_learning_box_sizing_border_box">
    

      <form class="" action="'.$nd_learning_action.'" method="GET">

      <input type="hidden" value="true" name="nd_learning_arrive_from_advsearch">

    ';

    //get all taxonmies
    $nd_learning_taxonomies = get_object_taxonomies($nd_learning_posttype);
    
    //call the functions for each tax
    $nd_learning_i = 0;
    foreach($nd_learning_taxonomies as $nd_learning_tax){

      $nd_learning_selected_term_taxonomy = $_GET[$nd_learning_tax];
      $nd_learning_result .= ''.nd_learning_build_select_archive($nd_learning_tax,$nd_learning_i,$nd_learning_selected_term_taxonomy).'';
      $nd_learning_i = $nd_learning_i + 1;

    }

  $nd_learning_result .= '

      <div class="nd_learning_width_100_percentage_all_iphone nd_learning_width_33_percentage nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
        <input class="nd_learning_section" type="submit" value="'.__('Search','nd-learning').'">
      </div>

    </form>

    </div>
    <!--END search form-->



    <!--START btns order-->
    <div id="nd_learning_archive_courses_btn_sorting_l2" class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_text_align_right">

      <div id="nd_learning_btn_sorting_layout" class="nd_learning_section">
        <a id="nd_learning_btn_sorting_layout_list" title="1" class="nd_learning_float_right nd_learning_margin_left_20 nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_width_40 nd_learning_border_radius_3 nd_learning_height_40 nd_learning_bg_green nd_learning_border_1_solid_green"></a>
        <a id="nd_learning_btn_sorting_layout_grid" title="0" class="nd_learning_float_right nd_learning_btn_sorting_layout_active nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_width_40 nd_learning_border_radius_3 nd_learning_height_40 nd_learning_bg_green nd_learning_border_1_solid_green"></a>
      </div>

      <style>
        #nd_learning_btn_sorting_layout_list{
          background-image:url('.plugins_url().'/nd-learning/assets/img/icons/icon-list-white.svg);
          background-size: 25px;
          background-repeat: no-repeat;
          background-position: center;
        }
        #nd_learning_btn_sorting_layout_grid{
          background-image:url('.plugins_url().'/nd-learning/assets/img/icons/icon-grid-white.svg);
          background-size: 25px;
          background-repeat: no-repeat;
          background-position: center;
        }
        #nd_learning_btn_sorting_layout_grid.nd_learning_btn_sorting_layout_active{
          background-image:url('.plugins_url().'/nd-learning/assets/img/icons/icon-grid-grey.svg);
          background-color:transparent;
          border: 1px solid #a3a3a3;
        }
        #nd_learning_btn_sorting_layout_list.nd_learning_btn_sorting_layout_active{
          background-image:url('.plugins_url().'/nd-learning/assets/img/icons/icon-list-grey.svg);
          background-color:transparent;
          border: 1px solid #a3a3a3;
        }
      </style>

      <script type="text/javascript">
        //<![CDATA[
        
        jQuery(document).ready(function() {

          
          jQuery(function ($) {
            
            $( "#nd_learning_btn_sorting_layout a" ).on("click",function() {

              $( "#nd_learning_btn_sorting_layout a" ).removeClass( "nd_learning_btn_sorting_layout_active" );
              $(this).addClass( "nd_learning_btn_sorting_layout_active");

              nd_learning_courses_sorting();
            
            });

          });
          

        });

        //]]>
      </script>

    </div>
    <!--END btns order-->

    

    <div id="nd_learning_archive_search_masonry_container" class="nd_learning_section">
      <div class="nd_learning_section nd_learning_masonry_content ">';


      //START CICLE
      while ( $the_query->have_posts() ) : $the_query->the_post();
        
          include "preview-layout/grid/".$nd_learning_customizer_archive_courses_layout.".php";

      endwhile;
      //END CICLE


      wp_reset_postdata();
            

  $nd_learning_result .= '</div></div>
  <div class="nd_learning_section nd_learning_height_50"></div>
  ';



  //START PAGINATION IF
  if ( $nd_learning_qnt_results_posts > 6 ) {


    //START PAGINATION
    $nd_learning_result .= '

    <!--start pagination-->
    <div id="nd_learning_btn_sorting_pagination" class="nd_learning_section nd_learning_text_align_center">';


      echo $nd_learning_result;

      for ($nd_learning_i_pagination = 1; $nd_learning_i_pagination <= $nd_learning_qnt_pagination; $nd_learning_i_pagination++) {

        if ( $nd_learning_i_pagination == 1 ){ $nd_learning_class_pagination_active = 'nd_learning_btn_sorting_pagination_active'; } else { $nd_learning_class_pagination_active = ''; }

        echo '<div class=" '.$nd_learning_class_pagination_active.' nd_learning_display_inline_block "><a class=" nd_options_first_font nd_learning_cursor_pointer nd_learning_padding_0_10 nd_learning_font_size_20" onclick="nd_learning_courses_sorting('.$nd_learning_i_pagination.')"><strong>'.$nd_learning_i_pagination.'</strong></a></div>';
      
      }
      

    $nd_learning_result = '</div>
    <!--end pagination-->



    <script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      
      jQuery(function ($) {
        
        $( "#nd_learning_btn_sorting_pagination div" ).on("click",function() {

          $( "#nd_learning_btn_sorting_pagination div" ).removeClass( "nd_learning_btn_sorting_pagination_active" );
          $(this).addClass( "nd_learning_btn_sorting_pagination_active");
        
        });

      });
      

    });

    //]]>
  </script>


    <div class="nd_learning_section nd_learning_height_50"></div>

    ';
    //END PAGINATION


  }
  //END PAGINATION IF

  

  echo $nd_learning_result;

}























//START nd_learning_bookmark_php_function for AJAX
function nd_learning_courses_sorting_php() {
  

  //recover var
  $nd_learning_paged = $_GET['nd_learning_paged'];
  $nd_learning_layout = $_GET['nd_learning_layout'];

  //static
  $nd_learning_qnt_posts_per_page = 6;
  $nd_learning_posttype = 'courses';
  
  //all taxonomies
  $nd_learning_taxonomy_1 = 'post_tag';
  $nd_learning_taxonomy_2 = 'difficulty-level-course';
  $nd_learning_taxonomy_3 = 'category-course';
  $nd_learning_taxonomy_4 = 'location-course';
  $nd_learning_taxonomy_5 = 'typology-course';
  $nd_learning_taxonomy_6 = 'duration-course';

  //all terms taxonomies
  $nd_learning_term_taxonomy_1 = $_GET['nd_learning_term_taxonomy_1'];
  $nd_learning_term_taxonomy_2 = $_GET['nd_learning_term_taxonomy_2'];
  $nd_learning_term_taxonomy_3 = $_GET['nd_learning_term_taxonomy_3'];
  $nd_learning_term_taxonomy_4 = $_GET['nd_learning_term_taxonomy_4'];
  $nd_learning_term_taxonomy_5 = $_GET['nd_learning_term_taxonomy_5'];
  $nd_learning_term_taxonomy_6 = $_GET['nd_learning_term_taxonomy_6'];

  //layout
  $nd_learning_archive_courses_layoutt = $_GET['nd_learning_archive_courses_layoutt'];

  
  //PREPARE THE ARGS FOR THE WP QUERY
  $args = array(
    'post_type' => ''.$nd_learning_posttype.'',
    'orderby' => 'name',
    'paged' => $nd_learning_paged,
    'order' => 'ASC',
    
    //pagination
    'posts_per_page' => $nd_learning_qnt_posts_per_page,


    ''.$nd_learning_taxonomy_1.'' => ''.$nd_learning_term_taxonomy_1.'',
    ''.$nd_learning_taxonomy_2.'' => ''.$nd_learning_term_taxonomy_2.'',
    ''.$nd_learning_taxonomy_3.'' => ''.$nd_learning_term_taxonomy_3.'',
    ''.$nd_learning_taxonomy_4.'' => ''.$nd_learning_term_taxonomy_4.'',
    ''.$nd_learning_taxonomy_5.'' => ''.$nd_learning_term_taxonomy_5.'',
    ''.$nd_learning_taxonomy_6.'' => ''.$nd_learning_term_taxonomy_6.''
  );
  //END ARGS FOR WP QUERY
  
  $the_query = new WP_Query( $args );


  $nd_learning_result = '

  <script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
    var $nd_learning_masonry_content = $(".nd_learning_masonry_content").imagesLoaded( function() {
      // init Masonry after all images have loaded
      $nd_learning_masonry_content.masonry({
        itemSelector: ".nd_learning_masonry_item"
      });
    });


      });
      //END masonry

    });

    //]]>
  </script>

  <div class="nd_learning_section nd_learning_masonry_content ">';

  //START CICLE
  while ( $the_query->have_posts() ) : $the_query->the_post();
    
      if ( $nd_learning_layout == 1 ) {
        include "preview-layout/list/".$nd_learning_archive_courses_layoutt.".php";
      }else{
        include "preview-layout/grid/".$nd_learning_archive_courses_layoutt.".php";
      }
       

  endwhile;
  //END CICLE


  $nd_learning_result .= '</div>';


  wp_reset_postdata();


  echo $nd_learning_result;

  die();

}
add_action( 'wp_ajax_nd_learning_courses_sorting_php', 'nd_learning_courses_sorting_php' );
add_action( 'wp_ajax_nopriv_nd_learning_courses_sorting_php', 'nd_learning_courses_sorting_php' );
//END

}