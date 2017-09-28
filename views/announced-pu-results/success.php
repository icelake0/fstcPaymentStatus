<?php

use yii\helpers\Html;

$this->title ='New Pollingunit And Results Added';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="success-view">
    <h1><?= Html::encode($this->title)?></h1>
    <h2>Pollingunit Information</h2>
    <h3>State : <?=$state_name?></h3>
    <h3>LGA : <?=$lga_name?></h3>
    <h3>WARD : <?=$ward_name?></h3>
    <h3>Polling Unit Name : <?=$polling_unit_name?></h3>
    <h2>Result Entered:</h2>
    <table class="table table-striped table-bordered">
        <thead>
        </thead>
        <tbody>
        <?php foreach ($results as $result){?>
        <tr>
            <th><?=$result->party_abbreviation?></th>
            <td><?=$result->party_score?></td>
        </tr>
        <?php }?>
        </tbody>
    </table
</div>