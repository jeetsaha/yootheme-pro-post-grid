<?php

$attrs_nav = [];

// Nav
$options = [];
if ($element['filter_breakpoint'] && in_array($element['filter_position'], ['left', 'right'])) {

    if ($element['filter_style'] == 'tab') {
        $options[] = "media: @{$element['filter_breakpoint']}";
    }

}

if ($element['filter_style'] == "tab") {
    $attrs_nav['uk-tab'] = implode(';', array_filter($options));
}

// Margin
if (in_array($element['filter_position'], ['top'])) {
    switch ($element['filter_margin']) {
        case '':
            $attrs_nav['class'][] = 'uk-margin';
            break;
        default:
            $attrs_nav['class'][] = "uk-margin-{$element['filter_margin']}";
    }
}

// Style Horizontal
switch ($element['filter_style']) {
    case 'subnav':
    case 'tab':
        $nav_horizontal = "uk-{$element['filter_style']}";
        break;
    case 'subnav-pill':
    case 'subnav-divider':
        $nav_horizontal = "uk-subnav uk-{$element['filter_style']}";
        break;
}

// Alignment
switch ($element['filter_align']) {
    case 'right':
    case 'center':
        $nav_horizontal .= " uk-flex-{$element['filter_align']}";
        break;
    case 'justify':
        $nav_horizontal .= ' uk-child-width-expand';
        break;
}

// Style Vertical
switch ($element['filter_style']) {
    case 'subnav':
    case 'subnav-pill':
    case 'subnav-divider':
        $nav_vertical  = $element['filter_style_primary'] ? 'uk-nav uk-nav-primary' : 'uk-nav uk-nav-default';
        $nav_vertical .= $element['text_align'] ? ' uk-text-left' : '';
        break;
    case 'tab':
        $nav_vertical = "uk-tab-{$element['filter_position']}";
        break;
}

if (in_array($element['filter_position'], ['top'])) {
    $attrs_nav['class'][] = $nav_horizontal;
} else {
    $attrs_nav['class'][] = $nav_vertical;

    if ($element['filter_style'] != 'tab') {
        $attrs_nav['uk-toggle'] =  "cls: {$nav_vertical} {$nav_horizontal}; mode: media; media: @{$element['filter_breakpoint']}";
    }
}

$attrs_nav['class'][] = 'el-nav';

?>

<ul<?= $this->attrs($attrs_nav) ?>>

    <?php if ($element['filter_all']) : ?>
    <li class="uk-active" uk-filter-control><a href><?= $element['filter_all_label'] ? $element['filter_all_label'] : 'All' ?></a></li>
    <?php endif ?>

    <?php foreach ($tags as $name => $tag) : ?>
    <li <?= $name === reset($tags) && !$element['filter_all'] ? 'class="uk-active" ' : '' ?>uk-filter-control="[data-tag~='<?= $tag ?>']">
        <a href="#"><?= ucwords($name) ?></a>
    </li>
    <?php endforeach ?>
</ul>
