<?php

return [

	// Module name
	'name' => 'yootheme/post-grid',

	// How this element is referenced inside the builder
	'builder' => 'post_grid',

	// Render this element on the website
	'render' => function ($element) {

		// Deprecated
		if ($element['grid_parallax'] === null && $element['grid_mode'] == 'parallax' && $element['grid_parallax_y']) {
			$element['grid_parallax'] = $element['grid_parallax_y'];
		}
		return $this->app->view->render("{$this->path}/template.php", ['element' => $element]);
	},

	'events' => [
		'theme.admin' => function () {
			$tax_array	= [];
			$args = array(
				'public'   => true		
			);
			$output = 'objects'; // or names
			$operator = 'and'; // 'and' or 'or'
			$taxonomies = get_taxonomies( $args, $output, $operator ); 
			if(count($taxonomies)) :
				foreach($taxonomies as $key => $taxonomy) :
					$tax_array[$taxonomy->labels->name] = $key;
				endforeach;
				$this->app->scripts->add('builder-post-grid-tax', sprintf('var $taxonomies = %s;', json_encode($tax_array)), 'customizer-builder', 'string');
			endif;

			// Load the JavaScript that creates the elements settings in the builder
			$this->app->scripts->add('builder-post-grid', "{$this->path}/post-grid.js", 'customizer-builder');
		}
	],

	'config' => [
		'element' => true,
		'defaults' => [
			'query' => '{"post_type":"post}',
			'show_title' => true,
			'show_meta' => true,
			'show_content' => true,
			'show_image' => true,
			'show_link' => true,

			'grid_default' => '1',
			'grid_medium' => '3',

			'filter_source' => 'category',
			'filter_style' => 'tab',
			'filter_all' => true,
			'filter_position' => 'top',
			'filter_align' => 'left',
			'filter_grid_width' => 'auto',
			'filter_breakpoint' => 'm',

			'title_element' => 'h3',
			'meta_style' => 'meta',
			'meta_align' => 'bottom',
			'icon_ratio' => 4,
			'image_align' => 'top',
			'image_grid_width' => '1-2',
			'image_breakpoint' => 'm',
			'link_text' => 'Read more',
			'link_style' => 'default',

			'margin' => 'default',
		],
	],
	
];
