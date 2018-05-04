<?php
/* @var $this yii\web\View */
/* @var $model app\models\Reportes */
use yii\helpers\Html;


$this->title = 'Reportar a ' . Html::encode($reportado->usuario) ;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-create">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default panel-trade">
                <div class="panel-heading">
                    <div class="panel-title">
                        <?= $this->title ?>
                    </div>
                </div>
                <div class="panel-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
