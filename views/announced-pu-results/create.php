<script src="/js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function(){
        $.get("/states/get_states",
            {
            },
            function(data){
                $("select#selectState").html( data );
            });
        $("#selectState").change(function(){
            $("select#selectLga").html("<option value=''>--Select A LGA--</option>");
            $("select#selectWard").html("<option value=''>--Select A Ward--</option>");
            $("#resultTable").html("");
            $.post("/states/get_lgas?id="+$('#selectState option:selected').val(),
                {
                },
                function(data){
                    $("select#selectLga").html( data );
                });
        });
        $("#selectLga").change(function(){
            $("select#selectWard").html("<option value=''>--Select A Ward--</option>");
            $("#resultTable").html("");
            $.post("/lga/get_wards?id="+$('#selectLga option:selected').val(),
                {
                },
                function(data){
                    $("select#selectWard").html( data );
                });
        });
        $("#selectWard").change(function(){
            $("#resultTable").html("");
            $.post("/wards/get_polling_units?id="+$('#selectWard option:selected').val(),
                {
                },
                function(data){
                    $("select#selectPu").html( data );
                });
        });
    });
</script>
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\States;
/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */

$this->title = 'Create Polling Unit and Add Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announced-pu-results-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>