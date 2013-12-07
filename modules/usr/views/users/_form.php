<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'created_on')->textInput() ?>

		<?= $form->field($model, 'updated_on')->textInput() ?>

		<?= $form->field($model, 'last_visit_on')->textInput() ?>

		<?= $form->field($model, 'password_set_on')->textInput() ?>

		<?= $form->field($model, 'email_verified')->checkbox() ?>

		<?= $form->field($model, 'is_active')->checkbox() ?>

		<?= $form->field($model, 'is_disabled')->checkbox() ?>

		<?= $form->field($model, 'one_time_password_counter')->textInput() ?>

		<?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'activation_key')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'one_time_password_secret')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'one_time_password_code')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
