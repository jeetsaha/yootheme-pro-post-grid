<?php

$attrs_item = [];
$attrs_content = [];
$attrs_image = [];
$attrs_grid = [];
$attrs_cell_image = [];
$attrs_image_container = [];
$attrs_link = [];
$attrs_icon = [];
$lightbox_caption = '';

// Display
if (!$element['show_title']) { $item['title'] = ''; }
if (!$element['show_meta']) { $item['meta'] = ''; }
if (!$element['show_content']) { $item['content'] = ''; }
if (!$element['show_image']) { $item['image'] = ''; }
if (!$element['show_link']) { $item['link'] = ''; }

// Animation
if ($element['item_animation'] != 'none' && $element->parent('section', 'animation') && $element->parent->type == 'column') {
    $attrs_item['uk-scrollspy-class'] = $element['item_animation'] ? "uk-animation-{$element['item_animation']}" : true;
}

// Max Width
$attrs_item['class'][] = $element['item_maxwidth'] ? "uk-width-{$element['item_maxwidth']} uk-margin-auto" : '';

// Item
$attrs_item['class'][] = 'el-item';

// If link is not set use the default image for the lightbox
if (!$item['link'] && $element['lightbox']) {
    $item['link'] = $item['image'];
}

// Image
if ($item['image']) {

    $src = $item['image'];

    $attrs_image['class'][] = 'el-image';
    $attrs_image['class'][] = $element['image_border'] ? "uk-border-{$element['image_border']}" : '';
    $attrs_image['class'][] = $element['image_box_shadow'] && !$element['panel_style'] ? "uk-box-shadow-{$element['image_box_shadow']}" : '';
    $attrs_image['class'][] = $item['link'] && $element['image_hover_box_shadow'] && !$element['panel_style'] && $element['link_style'] == 'panel' ? "uk-box-shadow-hover-{$element['image_hover_box_shadow']}" : '';
    $attrs_image['alt'] = $item['image_alt'];
    $attrs_image['uk-cover'] = ($element['panel_style'] && $element['image_card'] && in_array($element['image_align'], ['left', 'right'])) ? true : false;
    $attrs_image['uk-img'] = true;

    if ($this->isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }

    if ($this->isImage($item['image']) == 'svg') {
        $item['image'] = $this->image($src, array_merge($attrs_image, ['width' => $element['image_width'], 'height' => $element['image_height']]));
    } else {
        $item['image'] = $this->image([$src, 'thumbnail' => [$element['image_width'], $element['image_height']], 'srcset' => true], $attrs_image);
    }

    // Placeholder image if card and layout left or right
    if ($element['panel_style'] && $element['image_card'] && in_array($element['image_align'], ['left', 'right'])) {
        $attrs_image['class'][] = 'uk-invisible';
        $attrs_image['uk-cover'] = false;
        $item['image'] .= $this->image([$src, 'thumbnail' => [$element['image_width'], $element['image_height']], 'srcset' => true], $attrs_image);
    }

} elseif ($item['icon']) {

    $options = ["icon: {$item['icon']}"];
    $options[] = $element['icon_ratio'] ? "ratio: {$element['icon_ratio']}" : '';
    $attrs_icon['uk-icon'] = implode(';', array_filter($options));

    $attrs_icon['class'][] = 'el-image';
    $attrs_icon['class'][] = $element['icon_color'] ? "uk-text-{$element['icon_color']}" : '';

    $item['image'] = "<span {$this->attrs($attrs_icon)}></span>";
    $element['image_card'] = false;

}

// Card
if ($element['panel_style']) {

    $attrs_item['class'][] = "uk-card uk-{$element['panel_style']}";
    $attrs_item['class'][] = $element['panel_size'] ? "uk-card-{$element['panel_size']}" : '';
    $attrs_item['class'][] = $item['link'] && $element['link_style'] == 'panel' && $element['panel_style'] != 'card-hover' ? 'uk-card-hover' : '';

    // Card media
    if ($item['image'] && $element['image_card'] && $element['image_align'] != 'between') {
        $attrs_content['class'][] = 'uk-card-body';
    } else {
        $attrs_item['class'][] = 'uk-card-body';
    }

} else {
    $attrs_item['class'][] = 'uk-panel';
}

// Image Align
$attrs_grid['class'][] = 'uk-child-width-expand';

if ($element['panel_style'] && $element['image_card']) {
    $attrs_grid['class'][] = 'uk-grid-collapse uk-grid-match';
} else {
    $attrs_grid['class'][] = $element['image_gutter'] ? "uk-grid-{$element['image_gutter']}" : '';
}

$attrs_grid['class'][] = $element['image_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;

if ($element['image_breakpoint']) {
    $attrs_cell_image['class'][] = "uk-width-{$element['image_grid_width']}@{$element['image_breakpoint']}";
    $attrs_cell_image['class'][] = $element['image_align'] == 'right' ? "uk-flex-last@{$element['image_breakpoint']}" : '';
} else {
    $attrs_cell_image['class'][] = "uk-width-{$element['image_grid_width']}";
    $attrs_cell_image['class'][] = $element['image_align'] == 'right' ? 'uk-flex-last' : '';
}

if ($element['panel_style'] && $element['image_card'] && in_array($element['image_align'], ['left', 'right'])) {
    $attrs_image_container['class'][] = 'uk-cover-container';
}

// Card media
if ($element['panel_style'] && $item['image'] && $element['image_card'] && $element['image_align'] != 'between' ) {
    $attrs_image_container['class'][] = "uk-card-media-{$element['image_align']}";
    $item['image'] = "<div{$this->attrs($attrs_image_container)}>{$item['image']}</div>";
}

// Link and Lightbox
if ($element['lightbox']) {

    if ($this->isImage($item['link'])) {

        if (($element['lightbox_image_width'] || $element['lightbox_image_height']) && $this->isImage($item['link']) != 'svg') {
            $item['link'] = "{$item['link']}#thumbnail={$element['lightbox_image_width']},{$element['lightbox_image_height']},{$element['lightbox_image_orientation']}";
        }

        $item['link'] = $app['image']->getUrl($item['link']);
        $attrs_link['data-type'] = 'image';

    } elseif ($this->isVideo($item['link'])) {

        $attrs_link['data-type'] = 'video';

    } elseif (!$this->iframeVideo($item['link'])) {

        $attrs_link['data-type'] = 'iframe';

    } else {

        $attrs_link['data-type'] = true;

    }

    if ($item['title'] && $element['title_display'] != 'item') {
        $lightbox_caption .= "<h4 class='uk-margin-remove'>{$item['title']}</h4>";
        if ($element['title_display'] == 'lightbox') {
            $item['title'] = '';
        }
    }

    if ($item['content'] && $element['content_display'] != 'item') {
        $lightbox_caption .= $item['content'];
        if ($element['content_display'] == 'lightbox') {
            $item['content'] = '';
        }
    }

    $lightbox_caption = $lightbox_caption ? ' data-caption="'.str_replace('"', '&quot;', $lightbox_caption).'"' : '';

} else {
    $attrs_link['target'] = $element['link_target'] ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
}

// Link
if ($item['link']) {

    $attrs_link['href'] = $item['link'];
    $attrs_link['class'][] = 'el-link';

    if ($element['link_style'] == 'panel') {

        if ($element['panel_style']) {
            $attrs_link['class'][] = 'uk-position-cover uk-position-z-index uk-margin-remove-adjacent';
        }

        if (!$element['panel_style'] && $item['image']) {
            $attrs_link['class'][] = $element['image_box_shadow_bottom'] ? 'uk-box-shadow-bottom' : '';
            $item['image'] = "<a{$this->attrs($attrs_link)}>{$item['image']}</a>";
        }

    } else {

        switch ($element['link_style']) {
            case '':
                break;
            case 'link-muted':
            case 'link-text':
                $attrs_link['class'][] = "uk-{$element['link_style']}";
                break;
            default:
                $attrs_link['class'][] = "uk-button uk-button-{$element['link_style']}";
                $attrs_link['class'][] = $element['link_size'] ? "uk-button-{$element['link_size']}" : '';
        }

    }

}

// Box-shadow bottom
if ((!$item['link'] || ($item['link'] && $element['link_style'] != 'panel')) && !$element['panel_style'] && $element['image_box_shadow_bottom']) {
    $item['image'] = "<div class=\"uk-box-shadow-bottom\">{$item['image']}</div>";
}

?>

<div<?= $this->attrs($attrs_item) ?>>

    <?php if ($item['link'] && $element['link_style'] == 'panel' && $element['panel_style']) : ?>
    <a<?= $this->attrs($attrs_link) ?><?= $lightbox_caption ?>></a>
    <?php endif ?>

    <?php if ($item['image'] && in_array($element['image_align'], ['left', 'right'])) : ?>

        <div<?= $this->attrs($attrs_grid) ?>>
            <div<?= $this->attrs($attrs_cell_image) ?>>
                <?= $item['image'] ?>
            </div>
            <div>

                <?php if ($element['panel_style'] && $item['image']) : ?>
                    <div<?= $this->attrs($attrs_content) ?>>
                        <?= $this->render(__DIR__.'/template-content', compact('item', 'attrs_link', 'lightbox_caption')) ?>
                    </div>
                <?php else : ?>
                    <?= $this->render(__DIR__.'/template-content', compact('item', 'attrs_link', 'lightbox_caption')) ?>
                <?php endif ?>

            </div>
        </div>

    <?php else : ?>

        <?php if ($element['image_align'] == 'top') : ?>
        <?= $item['image'] ?>
        <?php endif ?>

        <?php if ($element['panel_style'] && $item['image'] && $element['image_card'] && in_array($element['image_align'], ['top', 'bottom'])) : ?>
            <div<?= $this->attrs($attrs_content) ?>>
                <?= $this->render(__DIR__.'/template-content', compact('item', 'attrs_link', 'lightbox_caption')) ?>
            </div>
        <?php else : ?>
            <?= $this->render(__DIR__.'/template-content', compact('item', 'attrs_link', 'lightbox_caption')) ?>
        <?php endif ?>

        <?php if ($element['image_align'] == 'bottom') : ?>
        <?= $item['image'] ?>
        <?php endif ?>

    <?php endif ?>

</div>
