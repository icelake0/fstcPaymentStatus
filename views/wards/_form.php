<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ward-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ward_id')->textInput() ?>

    <?= $form->field($model, 'ward_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lga_id')->textInput() ?>

    <?= $form->field($model, 'ward_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'entered_by_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_entered')->textInput() ?>

    <?= $form->field($model, 'user_ip_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
