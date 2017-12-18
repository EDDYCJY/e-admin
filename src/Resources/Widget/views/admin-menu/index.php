<?php
use yii\helpers\Url;

?>

<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left info"></div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
    
      <?php foreach($menus as $index => $menu): ?>
      <li class="<?php echo $menu['class']; ?>">

        <a href="<?php echo Url::toRoute($menu['url']); ?>">
          <i class="<?php if(! empty($menu['icon'])): echo $menuIconPrefix . ' ' . $menu['icon']; else:?>fa fa-dashboard<?php endif; ?>"></i> <span><?php echo $menu['menu_name']; ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
  
        <?php if(! empty($menu['childrens'])): ?>
        <ul class="treeview-menu">
          <?php foreach($menu['childrens'] as $children): ?>
            <li class="<?php echo $children['class']; ?>"><a href="<?php echo Url::toRoute($children['url']); ?>"><i class="fa fa-circle-o"></i> <?php echo $children['menu_name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

      </li>
    <?php endforeach; ?>
    
    </ul>
  </section>
</aside>