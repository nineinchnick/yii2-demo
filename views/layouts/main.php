<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
	<div class="wrap">
		<?php
			NavBar::begin([
				'brandLabel' => Yii::$app->name,
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			$messagesWidget = Yii::createObject(['class'=>'nineinchnick\nfy\widgets\Messages']);
			$messagesWidget->run();
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'encodeLabels'=>false,
				'items' => array_merge([
					['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
					['label' => Yii::t('app','About'), 'url' => ['/site/about']],
					['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']],
					[
						'label'=>'<i class="flag flag-'.Yii::$app->language.'"></i> '.Yii::t('app','Language'),
						'url'=>'#',
						'items'=>app\controllers\SiteController::createMenuItemsUsingCurrentUrl(app\controllers\SiteController::getAvailableLanguages(), 'language={key}', '<i class="flag flag-{key}"></i> {value}'),
					],
					Yii::$app->user->isGuest ?
						['label' => Yii::t('app','Login'), 'url' => ['/usr/default/login']] :
						['label' => Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')' ,
							'url' => ['/usr/default/logout'],
							'linkOptions' => ['data-method' => 'post']],
				], Yii::$app->user->isGuest ? [] : [
					$messagesWidget->createMenuItem(),
				]),
			]);
			NavBar::end();
		?>

		<div class="container">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= $content ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
