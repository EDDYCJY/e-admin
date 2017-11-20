<div class="error-page" style="width: 800px";>
  <h2 class="headline text-red"><?php echo $exception->statusCode; ?></h2>

  <div class="error-content">
    <h3><i class="fa fa-warning text-red"></i> <?php echo $exception->getMessage(); ?></h3>
    <?php if(! empty($exception->getPrevious())): ?>
    <p>
      <b>Message: </b><?php echo $exception->getPrevious()->getMessage(); ?>
    </p>
    <?php endif; ?>
    <p>
      <b>Line: </b><?php echo $exception->getLine(); ?>, <b>File: </b> <?php echo $exception->getFile(); ?>
    </p>
    <p>
      <b>Stack-trace: </b> <?php echo str_replace("\n", "<br/>", $exception->getTraceAsString()); ?>
    </p>
  </div>
</div>
