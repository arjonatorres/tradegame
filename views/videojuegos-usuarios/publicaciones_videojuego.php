<?php
use yii\helpers\Html;

use kartik\grid\GridView;
/**
 * Muestra un listado de videojuegos publicados por los usuarios, de un videojuego
 * concreto
 */
?>

<?= GridView::widget([
    'containerOptions' => [
        'class' => 'datos-videojuego'
    ],
    'responsive' => true,
    'responsiveWrap' => true,
    'summary' => '',
    'dataProvider' => $dataProvider,
    'columns' => [
        'usuario.usuario',
        [
            'label' => 'Comentarios',
            'width' => '400px',
            'contentOptions' => ['class' => 'comentarios-videojuego'],
            'value' => function ($model) {
                return $model->mensaje;
            }
        ],
        [
            'label' => 'Publicado',
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::$app->formatter->asRelativeTime($model->created_at);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Operación',
            'template' => '<div class="text-center">{oferta}</div>',
            'buttons' => [
                'oferta' => function ($url, $model, $key) {
                    if ($model->usuario_id !== Yii::$app->user->id) {
                        return Html::a('Hacer oferta', [
                            'ofertas/create',
                            'publicacion' => $model->id
                        ], ['class' => 'btn btn-xs btn-warning']);
                    }
                }
            ]
        ]
    ]
]) ?>
