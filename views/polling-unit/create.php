<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */

$this->title = 'Create Polling Unit';
$this->params['breadcrumbs'][] = ['label' => 'Polling Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polling-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
