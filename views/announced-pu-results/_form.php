<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announced-pu-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entered_by_user')->textInput(['maxlength' => true,'name'=>'entered_by_user']) ?>

    <table>
            <td>
                <?= $form->field($model, 'state_id')->dropdownList(
                    ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),[
                    'prompt'=>'--Select A State--','id'=>'selectState',
                ])?>
            </td>
            <td>
                <?= $form->field($model, 'lga_id')->dropDownList($model, ['id'=>'selectLga', 'name'=>'lga_id','prompt'=>'--Select LGA--',])?>
            </td>
            <td>
                <?= $form->field($model, 'uniquewardid')->dropDownList($model, ['id'=>'selectWard', 'name'=>'uniquewardid', 'prompt'=>'--Select A Ward--',])?>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'polling_unit_name')->textInput(['maxlength' => true, 'name'=>'polling_unit_name']) ?>

    <?= $form->field($model, 'polling_unit_description')->textInput(['maxlength' => true, 'name'=>'polling_unit_name']) ?>

    <h3>Party Results</h3>

    <?= $form->field($model, 'PDP')->textInput(['maxlength' => true,'name'=>'PDP']) ?>

    <?= $form->field($model, 'DPP')->textInput(['maxlength' => true,'name'=>'DPP']) ?>

    <?= $form->field($model, 'ACN')->textInput(['maxlength' => true,'name'=>'ACN']) ?>

    <?= $form->field($model, 'PPA')->textInput(['maxlength' => true,'name'=>'PPA']) ?>

    <?= $form->field($model, 'CDC')->textInput(['maxlength' => true,'name'=>'CDC']) ?>

    <?= $form->field($model, 'JP')->textInput(['maxlength' => true,'name'=>'JP']) ?>

    <?= $form->field($model, 'ANPP')->textInput(['maxlength' => true,'name'=>'ANPP']) ?>

    <?= $form->field($model, 'LABO')->textInput(['maxlength' => true,'name'=>'LABO']) ?>

    <?= $form->field($model, 'CPP')->textInput(['maxlength' => true,'name'=>'CPP']) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
