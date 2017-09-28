<script src="/js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#selectState").change(function(){
            $("select#selectLga").html("<option value=''>--Select A LGA--</option>");
            $("select#selectWard").html("<option value=''>--Select A Ward--</option>");
            $("select#selectPu").html("<option value=''>--Select A Polling-unit--</option>");
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
            $("select#selectPu").html("<option value=''>--Select A Polling-unit--</option>");
            $("#resultTable").html("");
            $.post("/lga/get_wards?id="+$('#selectLga option:selected').val(),
                {
                },
                function(data){
                    $("select#selectWard").html( data );
                });
        });
        $("#selectWard").change(function(){
            $("select#selectPu").html("<option value=''>--Select A Polling-unit--</option>");
            $("#resultTable").html("");
            $.post("/wards/get_polling_units?id="+$('#selectWard option:selected').val(),
                {
                },
                function(data){
                    $("select#selectPu").html( data );
                });
        });
        $("#selectPu").change(function(){
            //$("select#selectPu").html("<option value=''>--Select A Polling-unit--</option>");
            $.post("/polling-unit/get_results?id="+$('#selectPu option:selected').val(),
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
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */

$this->title = 'View Result by Pollingunit';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['layout' => 'inline',]); ?>
    <table>
        <tr>
            <th>State :</th>
            <th>LGA :</th>
            <th>Ward :</th>
            <th>Polling-Unit :</th>
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
            <td>
             <?= $form->field($model, 'ward_id')->dropDownList($model, ['id'=>'selectWard', 'prompt'=>'--Select A Ward--',])?>
            </td>
        <td>
             <?= $form->field($model, 'polling_unit_uniqueid')->dropDownList($model, ['id'=>'selectPu', 'prompt'=>'--Select A polling-unit--',])?>
        </td>
        </tr>
    </table>
<?php ActiveForm::end(); ?>
<h2>Selected Polling unit result</h2>
<table class="table table-striped table-bordered">
    <thead>
    </thead>
    <tbody id='resultTable'>
    </tbody>
</table>


