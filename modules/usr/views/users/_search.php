<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password') ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'firstname') ?>

        <?php // echo $form->field($model, 'lastname') ?>

        <?php // echo $form->field($model, 'activation_key') ?>

        <?php // echo $form->field($model, 'created_on') ?>

        <?php // echo $form->field($model, 'updated_on') ?>

        <?php // echo $form->field($model, 'last_visit_on') ?>

        <?php // echo $form->field($model, 'password_set_on') ?>

        <?php // echo $form->field($model, 'email_verified')->checkbox() ?>

        <?php // echo $form->field($model, 'is_active')->checkbox() ?>

        <?php // echo $form->field($model, 'is_disabled')->checkbox() ?>

        <?php // echo $form->field($model, 'one_time_password_secret') ?>

        <?php // echo $form->field($model, 'one_time_password_code') ?>

        <?php // echo $form->field($model, 'one_time_password_counter') ?>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
