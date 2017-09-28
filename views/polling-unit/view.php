<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */

$this->title = $model->uniqueid;
$this->params['breadcrumbs'][] = ['label' => 'Polling Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polling-unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->uniqueid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->uniqueid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uniqueid',
            'polling_unit_id',
            'ward_id',
            'lga_id',
            'uniquewardid',
            'polling_unit_number',
            'polling_unit_name',
            'polling_unit_description:ntext',
            'lat',
            'long',
            'entered_by_user',
            'date_entered',
            'user_ip_address',
        ],
    ]) ?>

</div>
