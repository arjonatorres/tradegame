<?php

use app\models\UsuariosGeneros;

use app\helpers\Utiles;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\file\FileInput;

use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model app\models\UsuariosDatos */
/* @var $form yii\widgets\ActiveForm */

$js = <<<EOT
function cargarImagen(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#img-edit').siblings('a').remove();
        $('#img-edit').attr('src', e.target.result);
        var a = $('<a>');
        a.addClass('badge-corner');
        a.addClass('badge-corner-base');
        a.attr('title', 'Avatar pendiente de subida');
        var span = $('<span></span>');
        span.addClass('glyphicon glyphicon-cloud-upload');
        a.append(span);
        $('#img-edit').parent().append(a);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#usuariosdatos-foto").change(function() {
  cargarImagen(this);
});
EOT;
$this->registerJs($js);
$this->registerCssFile('@web/css/badge.css');
?>

<div class="usuarios-datos-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-3">
        <div class="row">
            <?= Html::img($model->avatar, [
                'id' => 'img-edit',
                'class' => 'center-block relative'
                ]) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'showUpload' => false,
                    'showPreview' => false,
                    'showCaption' => false,
                    'showRemove' => false,
                    'browseClass' => 'btn btn-tradegame btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Sube tu avatar'
                ],
                'options' => ['accept' => 'image/jpg, image/png'],
                ])->label(false);?>
        </div>
    </div>
    <div id="col-datos-personales" class="col-md-9">

        <?= $form->field($model, 'nombre_real', [
            'template' => Utiles::inputGlyphicon('tag')
            ])->textInput(['maxlength' => true, 'placeholder' => 'Nombre real']) ?>

        <?= $form->field($model, 'localidad', [
            'template' => Utiles::inputGlyphicon('globe')
            ])->textInput(['maxlength' => true, 'placeholder' => 'Localidad']) ?>

        <?= $form->field($model, 'provincia', [
            'template' => Utiles::inputGlyphicon('map-marker')
            ])->textInput(['maxlength' => true, 'placeholder' => 'Provincia']) ?>

        <?= $form->field($model, 'telefono', [
            'template' => Utiles::inputGlyphicon('earphone')
            ])->textInput(['maxlength' => true, 'placeholder' => 'Teléfono']) ?>

        <?= $form->field($model, 'biografia', [
            'template' => Utiles::inputGlyphicon('book')
            ])->textarea(['maxlength' => true, 'placeholder' => 'Biografía']) ?>

        <?= $form->field($model, 'fecha_nacimiento')->widget(DateControl::classname(), [
            'readonly' => true,
            'widgetOptions' => [
                'layout' => '{picker}{input}{remove}',
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ]
            ])->label(false) ?>

        <?= $form->field($model, 'genero_id', [
            'template' => Utiles::inputGlyphicon('user')
            ])->dropDownList(
                UsuariosGeneros::find()
                ->select('sexo')
                ->indexBy('id')
                ->column(), ['prompt' => 'Selecciona un género'])
                ?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <?= Html::submitButton('Modificar', ['class' => 'btn btn-tradegame btn-block']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>


</div>
