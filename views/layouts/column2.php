<?php /* @var $this View */ ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="span-19">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<?php if (isset($this->params['menu'])): ?>
<div class="span-5 last">
    <div id="sidebar">
    <?php echo yii\widgets\Menu::widget([
        'items'=>$this->params['menu'],
        'options'=>array('class'=>'operations'),
    ]); ?>
    </div><!-- sidebar -->
</div>
<?php endif; ?>
<?php $this->endContent(); ?>
