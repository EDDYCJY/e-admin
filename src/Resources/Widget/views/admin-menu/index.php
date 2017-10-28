<?php
use yii\helpers\Url;

?>

<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="static/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
    
      <?php foreach($menus as $index => $menu): ?>
      <li class="<?php if(! empty($menu['childrens'])):?>treeview<?php endif; ?>">

        <a href="<?php echo Url::toRoute($menu['url']); ?>">
          <i class="fa fa-dashboard"></i> <span><?php echo $menu['name']; ?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
  
        <?php if(! empty($menu['childrens'])): ?>
        <ul class="treeview-menu">
          <?php foreach($menu['childrens'] as $children): ?>
            <li><a href="<?php echo Url::toRoute($children['url']); ?>"><i class="fa fa-circle-o"></i> <?php echo $children['name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

      </li>
    <?php endforeach; ?>
    
    </ul>
  </section>
</aside>