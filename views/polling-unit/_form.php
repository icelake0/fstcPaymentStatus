<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polling-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'polling_unit_id')->textInput() ?>

    <?= $form->field($model, 'ward_id')->textInput() ?>

    <?= $form->field($model, 'lga_id')->textInput() ?>

    <?= $form->field($model, 'uniquewardid')->textInput() ?>

    <?= $form->field($model, 'polling_unit_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'polling_unit_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'polling_unit_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entered_by_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_entered')->textInput() ?>

    <?= $form->field($model, 'user_ip_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
