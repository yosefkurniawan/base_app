<?php
/*
 * Description:
 * - breadcrumbs template
 */
?>

<ol class="breadcrumb">
    <li class="crumb-icon">
        <a href="<?php echo base_url() ?>">
            <span class="glyphicon glyphicon-home"></span>
        </a>
    </li>

    <?php foreach ($this->breadcrumb->breadcrumb as $crumb): ?>
        <?php if (!empty($crumb['url']) && count($this->breadcrumb) > 1): ?>
        <li class="crumb-link">
            <a href="<?php echo $crumb['url'] ?>"><?php echo $crumb['title'] ?></a>
        </li>
        <?php else: ?>
            <li class="crumb-trail"><?php echo $crumb['title'] ?></li>
        <?php endif ?>
    <?php endforeach ?>
</ol>