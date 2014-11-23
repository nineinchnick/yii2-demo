<?php /* @var $this View */ ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="span-19">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">
    <?php echo yii\widgets\Menu::widget([
        'items'=>$this->context->menu,
        'options'=>array('class'=>'operations'),
    ]); ?>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
