<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UserSearch $searchModel
 */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'username',
			'password',
			'email:email',
			'firstname',
			// 'lastname',
			// 'activation_key',
			// 'created_on',
			// 'updated_on',
			// 'last_visit_on',
			// 'password_set_on',
			// 'email_verified:boolean',
			// 'is_active:boolean',
			// 'is_disabled:boolean',
			// 'one_time_password_secret',
			// 'one_time_password_code',
			// 'one_time_password_counter:datetime',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
