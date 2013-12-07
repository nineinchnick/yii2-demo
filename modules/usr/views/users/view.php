<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'username',
			'password',
			'email:email',
			'firstname',
			'lastname',
			'activation_key',
			'created_on',
			'updated_on',
			'last_visit_on',
			'password_set_on',
			'email_verified:boolean',
			'is_active:boolean',
			'is_disabled:boolean',
			'one_time_password_secret',
			'one_time_password_code',
			'one_time_password_counter:datetime',
		],
	]); ?>

</div>
