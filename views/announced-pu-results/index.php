<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announced Pu Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announced-pu-results-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Announced Pu Results', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'result_id',
            'polling_unit_uniqueid',
            'party_abbreviation',
            'party_score',
            'entered_by_user',
            // 'date_entered',
            // 'user_ip_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
