<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lga */

$this->title = 'Update Lga: ' . $model->uniqueid;
$this->params['breadcrumbs'][] = ['label' => 'Lgas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uniqueid, 'url' => ['view', 'id' => $model->uniqueid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
