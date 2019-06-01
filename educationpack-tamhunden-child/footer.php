<?php 

if( function_exists('nicdark_footers')){ do_action("nicdark_footer_nd"); }else{ ?>

<!--START section-->
<div class="nicdark_section nicdark_bg_greydark nicdark_text_align_center">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="nicdark_grid_12">

        	<div class="nicdark_section nicdark_height_10"></div>
               
        	<p class="nicdark_color_grey">
        		<?php echo esc_html(get_bloginfo('name')); ?>
        	</p>

        	<div class="nicdark_section nicdark_height_10"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--END section-->

<?php } ?>  

</div>
<!--END theme-->


<!--insert here your google analytics code-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141135719-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141135719-1');
</script>


<?php wp_footer(); ?>
	
</body>  
</html>