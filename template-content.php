<?php

$attrs_title = [];
$attrs_content = [];
$attrs_meta = [];

// Title
$attrs_title['class'][] = 'el-title uk-margin';
$attrs_title['class'][] = $element['title_style'] ? "uk-{$element['title_style']}" : '';
$attrs_title['class'][] = $element['panel_style'] && !$element['title_style'] ? "uk-card-title" : '';
$attrs_title['class'][] = $element['title_decoration'] ? "uk-heading-{$element['title_decoration']}" : '';
$attrs_title['class'][] = $element['title_color'] && $element['title_color'] != 'background' ? "uk-text-{$element['title_color']}" : '';

// Deprecated
if (!$element['title_element']) {
    $element['title_element'] = 'h3';
}

// Meta
$attrs_meta['class'][] = 'el-meta uk-margin';

switch ($element['meta_style']) {
    case '':
        break;
    case 'meta':
    case 'muted':
        $attrs_meta['class'][] = "uk-text-{$element['meta_style']}";
        break;
    default:
        $attrs_meta['class'][] = "uk-{$element['meta_style']}";
}

if ($element['meta_align'] == 'top') {
    $attrs_meta['class'][] = 'uk-margin-remove-adjacent';
    $attrs_meta['class'][] = $element['meta_margin'] ? "uk-margin-{$element['meta_margin']}-bottom" : '';
}

if ($item['meta'] && $element['meta_align'] == 'bottom') {
    $attrs_title['class'][] = 'uk-margin-remove-adjacent';
    $attrs_title['class'][] = $element['meta_margin'] ? "uk-margin-{$element['meta_margin']}-bottom" : '';
}

// Content
$attrs_content['class'][] = 'el-content';
$attrs_content['class'][] = 'uk-margin';
$attrs_content['class'][] = $element['content_style'] ? "uk-text-{$element['content_style']}" : '';

?>

<?php if ($item['meta'] && $element['meta_align'] == 'top') : ?>
<div<?= $this->attrs($attrs_meta) ?>><?= $item['meta'] ?></div>
<?php endif ?>

<?php if ($item['title']) : ?>
<<?= $element['title_element'] . $this->attrs($attrs_title) ?>>
    <?php if ($element['title_color'] == 'background') : ?>
    <span class="uk-text-background"><?= $item['title'] ?></span>
    <?php elseif ($element['title_decoration'] == 'line') : ?>
    <span><?= $item['title'] ?></span>
    <?php else : ?>
    <?= $item['title'] ?>
    <?php endif ?>
</<?= $element['title_element'] ?>>
<?php endif ?>

<?php if ($item['meta'] && $element['meta_align'] == 'bottom') : ?>
<div<?= $this->attrs($attrs_meta) ?>><?= $item['meta'] ?></div>
<?php endif ?>

<?php if ($element['image_align'] == 'between') : ?>
<?= $item['image'] ?>
<?php endif ?>

<?php if ($item['content']) : ?>
<div<?= $this->attrs($attrs_content) ?>><?= $item['content'] ?></div>
<?php endif ?>

<?php if ($item['link'] && $element['link_style'] != 'panel' && $element['link_text']) : ?>
<p><a<?= $this->attrs($attrs_link) ?><?= $lightbox_caption ?>><?= $element['link_text'] ?></a></p>
<?php endif ?>
