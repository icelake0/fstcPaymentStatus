<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */

$this->title = 'Update Polling Unit: ' . $model->uniqueid;
$this->params['breadcrumbs'][] = ['label' => 'Polling Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uniqueid, 'url' => ['view', 'id' => $model->uniqueid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="polling-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
