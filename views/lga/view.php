<script src="/js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#selectState").change(function(){
            $("select#selectLga").html("<option value=''>--Select A LGA--</option>");
            $.post("/states/get_lgas?id="+$('#selectState option:selected').val(),
                {
                },
                function(data){
                    $("select#selectLga").html( data );
                });
        });
        $("#selectLga").change(function(){
            $("#resultTable").html("");
            $.post("/lga/get_total_result_from_pu?id="+$('#selectLga option:selected').val(),
                {
                },
                function(data){
                    $("#resultTable").html( data );
                });

        });
    });
</script>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;

/* @var $this yii\web\View */
/* @var $model app\models\Lga */

$this->title ='View Score Total By LGA';
$this->params['breadcrumbs'][] = ['label' => 'Lgas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lga-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['layout' => 'inline',]); ?>
    <table>
        <tr>
            <th>State :</th>
            <th>LGA :</th>
        <tr>
            <td>
                <?= $form->field($model, 'state_id')->dropdownList(
                    ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),[
                    'prompt'=>'--Select A State--','id'=>'selectState',
                ])?>
            </td>
            <td>
                <?= $form->field($model, 'lga_id')->dropDownList($model, ['id'=>'selectLga', 'prompt'=>'--Select LGA--',])?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
    <h2>Sum total of results of all polling united under the selected LGA</h2>
    <table class="table table-striped table-bordered">
        <thead>
        </thead>
        <tbody id='resultTable'>
        </tbody>
    </table

</div>
