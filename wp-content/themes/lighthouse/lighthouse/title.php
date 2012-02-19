	<?php if(is_home()){ ?>
		<h1 class="pagetitle"><?php _e('Our Blog','templatesquare');?></h1>
	<?php } else { ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $pagetitle = get_post_custom_values("page-title");?>
		<?php if($pagetitle == ""){ ?>
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		<?php } else { ?>
		<h1 class="pagetitle"><?php echo $pagetitle[0]; ?></h1>
		<?php } ?>
		<?php endwhile; endif; ?>
		<?php wp_reset_query();?>
	<?php } ?>
