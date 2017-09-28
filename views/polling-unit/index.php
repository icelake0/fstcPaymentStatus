<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Polling Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polling-unit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Polling Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uniqueid',
            'polling_unit_id',
            'ward_id',
            'lga_id',
            'uniquewardid',
            // 'polling_unit_number',
            // 'polling_unit_name',
            // 'polling_unit_description:ntext',
            // 'lat',
            // 'long',
            // 'entered_by_user',
            // 'date_entered',
            // 'user_ip_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
