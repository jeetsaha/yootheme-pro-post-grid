<?php

$id    = $element['id'];
$class = $element['class'];
$attrs = $element['attrs'];
$tags  = [];
$attrs_grid = [];
$attrs_filter_grid = [];
$attrs_filter_cell_nav = [];

// New variables for post query
$items          = [];
$loop_count     = 0;
$query_argument = array('post_type' => 'post');

// Build array from JSON object. Will revert to use default query if empty or invalid
if($json = $element['query']) :
    if($json_decoded = json_decode($json))
        $query_argument = $json_decoded;
endif;

// Query WordPress posts
$queried_posts = get_posts($query_argument);

// Iterate posts array and build $items array
foreach($queried_posts as $queried_post) :
    $items[$loop_count]['id'] = $queried_post->ID;
    $items[$loop_count]['title'] = $queried_post->post_title;
    $items[$loop_count]['content'] = $queried_post->post_content;
    $items[$loop_count]['link'] = get_permalink($queried_post);
    $items[$loop_count]['image'] = get_the_post_thumbnail_url($queried_post, 'full');
    
    // Create a comma separated string from taxonomy source(if selected)
    if( $element['filter'] && $source_taxonomy = $element['filter_source'] ) :
        $queried_post_taxonomies = wp_get_post_terms($queried_post->ID, $source_taxonomy, array("fields" => "names"));
        $queried_post_taxonomies = implode(',', $queried_post_taxonomies);
        $items[$loop_count]['tags'] = $queried_post_taxonomies;
    endif;

    // Increment loop count
    $loop_count++;
endforeach;

// Grid
$options = [];
$options[] = $element['grid_masonry'] ? 'masonry: true' : '';
$options[] = $element['grid_parallax'] ? "parallax: {$element['grid_parallax']}" : '';
$attrs_grid['uk-grid'] = implode(';', array_filter($options)) ?: true;

// Filter
$filterTags = function ($item) {

    $tags = array_filter(array_map('trim', explode(',', $item['tags'])));

    return array_combine(
        $tags,
        array_map(
            function ($tag) {
                return str_replace(' ', '-', $tag);
            },
            $tags
        )
    );
};

if ($element['filter']) {

    $tags = array_unique(call_user_func_array('array_replace', array_map($filterTags, $items)));
    natsort($tags);

    if ($tags) {
        $attrs['uk-filter'] = '.js-filter';
        $attrs_grid['class'][] = 'js-filter';
    }

    // Filter Alignment
    $attrs_filter_grid['class'][] = 'uk-child-width-expand';
    $attrs_filter_grid['class'][] = $element['filter_gutter'] ? "uk-grid-{$element['filter_gutter']}" : '';
    $attrs_filter_grid['uk-grid'] = true;

    $attrs_filter_cell_nav['class'][] = "uk-width-{$element['filter_grid_width']}@{$element['filter_breakpoint']}";
    $attrs_filter_cell_nav['class'][] = $element['filter_position'] == 'right' ? "uk-flex-last@{$element['filter_breakpoint']}" : '';

}

// Grid Columns
$attrs_grid['class'][] = "uk-child-width-1-{$element['grid_default']}";
$attrs_grid['class'][] = !$element['grid_masonry'] ? 'uk-grid-match' : '';

$attrs_grid['class'][] = $element['grid_small'] ? "uk-child-width-1-{$element['grid_small']}@s" : '';
$attrs_grid['class'][] = $element['grid_medium'] ? "uk-child-width-1-{$element['grid_medium']}@m" : '';
$attrs_grid['class'][] = $element['grid_large'] ? "uk-child-width-1-{$element['grid_large']}@l" : '';
$attrs_grid['class'][] = $element['grid_xlarge'] ? "uk-child-width-1-{$element['grid_xlarge']}@xl" : '';

$attrs_grid['class'][] = $element['gutter'] ? "uk-grid-{$element['gutter']}" : '';
$attrs_grid['class'][] = $element['divider'] ? 'uk-grid-divider' : '';

// Lightbox
$attrs_grid['uk-lightbox'] = $element['lightbox'] ? 'toggle: a[data-type]' : false;

?>

<?php if ($tags) : ?>
<div<?= $this->attrs(compact('id', 'class'), $attrs) ?>>

    <?php if (in_array($element['filter_position'], ['left', 'right'])) : ?>
    <div<?= $this->attrs($attrs_filter_grid) ?>>
        <div<?= $this->attrs($attrs_filter_cell_nav) ?>>
    <?php endif ?>

            <?= $this->render(__DIR__.'/template-nav', compact('element', 'item', 'tags')) ?>

    <?php if (in_array($element['filter_position'], ['left', 'right'])) : ?>
        </div>
        <div>
    <?php endif ?>

            <div<?= $this->attrs($attrs_grid) ?>>

                <?php foreach ($items as $item) : ?>
                <div<?= $this->attrs(['data-tag' => $filterTags($item)]) ?>>
                    <?= $this->render(__DIR__.'/template-item', compact('element', 'item')) ?>
                </div>
                <?php endforeach ?>

            </div>

    <?php if (in_array($element['filter_position'], ['left', 'right'])) : ?>
        </div>
    </div>
    <?php endif ?>

</div>
<?php else : ?>
<div<?= $this->attrs(compact('id', 'class'), $attrs, $attrs_grid) ?>>

    <?php foreach ($items as $item) : ?>
    <div><?= $this->render(__DIR__.'/template-item', compact('element', 'item')) ?></div>
    <?php endforeach ?>

</div>
<?php endif ?>
