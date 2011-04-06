<?php get_header(); ?>
<?php get_sidebar(); ?>

	<div id="right-col">
		<div class="post error">
			<h2>Page Error. What You're Seeking Does Not Exist</h2>
			<p>Sorry, the page you were trying to reach, doesn't seem to exist anymore.</p>
			<p>If you believe you've reached this page in error, begin by searching for the page you were seeking by using the search form below.</p>
			<?php get_search_form(); ?>
			<p>If you're seeking a specific topic, search through one of the categories listed below:</p>
			<?php wp_dropdown_categories('show_option_none=Select Category Archive&order_by=name'); ?>
			<script type="text/javascript"><!--
			    var dropdown = document.getElementById("cat");
			    function onCatChange() {
					if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
						location.href = "<?php echo home_url();
			?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
					}
			    }
			    dropdown.onchange = onCatChange;
			--></script>
			
			<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;' id="category-dropdown"> 
  				<option value=""><?php echo esc_attr(__('Select Monthly Archive')); ?></option> 
				  <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
		</div>
	</div>
<?php get_footer(); ?>