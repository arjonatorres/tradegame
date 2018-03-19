<?php
use app\helpers\Utiles;

use yii\helpers\Html;


$css = <<<CSS
.datos-videojuego {
    margin: 10px;
}

.comentarios-videojuego:empty:after {
    font-style: italic;
    content: 'No se ha proporcionado ningún comentario';
}

.panel-default {
    margin-top: 20px;
    padding-right:20px;
    padding-left: 20px;
    padding-bottom: 20px;
}

#date {
    margin: 20px;
}
CSS;
$this->registerCss($css);

$videojuego = $model->videojuego;
$this->title = $videojuego->nombre;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-offset-1 col-md-10">
        <div class="panel panel-default">
            <div id='date'>
                <div class="col-md-6 text-left">
                    <?= Utiles::FA('user') ?> Publicado por
                    <?php $user = $model->usuario->usuario ?>
                    <?= Html::a($user, ['usuarios/perfil', 'usuario' => $user]) ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php if (!$model->visible): ?>
                        <?= Html::tag('span', Utiles::FA('check') .
                        ' Esta videojuego ya ha sido intercambiado.',
                        ['class' => 'text-success']) ?><br>
                    <?php endif; ?>
                    <?= Utiles::FA('clock', ['class' => 'far']) ?> Publicado <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                </div>
            </div>
            <?= $this->render('/videojuegos/datos', [
                'model' => $videojuego
            ]) ?>
            <div class="datos-videojuego">
                <?php if ($model->mensaje !== ''): ?>
                    <strong>Comentarios del usuario: </strong><br>
                    <?= $model->mensaje ?>
                <?php endif; ?>
            </div>
            <?php if (Yii::$app->user->id !== $model->usuario_id && $model->visible): ?>
                <hr>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <?= Html::a('Hacer oferta ' . Utiles::FA('handshake', ['class' => 'far']), [
                            'ofertas/create',
                            'publicacion' => $model->id
                        ], ['class' => 'btn btn-lg btn-warning btn-block']) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
