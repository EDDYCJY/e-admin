<?php $this->beginPage() ?>
<?php
use backend\assets\AdminAsset;
use backend\widgets\AdminNav;
use backend\widgets\AdminMenu;
use yii\helpers\Html;

$settings = \Yii::$app->params['eadminSetting'];

AdminAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= Html::encode($this->title) ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?= Html::csrfMetaTags() ?>
<?php $this->head() ?>
</head>
<body class="sidebar-mini skin-blue-light">
<?php $this->beginBody() ?>

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="static/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo $settings['mini_site_title']; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $settings['site_title']; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <?= AdminNav::widget() ?>
  </header>

  <?= AdminMenu::widget([
      'settings' => $settings,
  ]) ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
      </h1>
    </section>
    <section class="content">
      <?= $content ?>
    </section>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?php echo $settings['site_verison']; ?>
    </div>
    <strong><?php echo $settings['site_copyright']; ?></strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->
<?php $this->endBody() ?>

<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>

</html>
<?php $this->endPage() ?>