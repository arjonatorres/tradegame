<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ofertas_usuarios".
 *
 * @property int $id
 * @property string $publicado
 * @property int $id_publicado
 * @property string $ofrecido
 * @property int $id_ofrecido
 * @property string $usuario_publicado
 * @property string $usuario_ofrecido
 * @property string $created_at
 */
class OfertasUsuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas_usuarios';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'default', 'value' => null],
            [['id', 'id_publicado', 'id_ofrecido'], 'integer'],
            [['created_at'], 'safe'],
            [['publicado', 'ofrecido'], 'string', 'max' => 255],
            [['usuario_publicado', 'usuario_ofrecido'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publicado' => 'Publicado',
            'ofrecido' => 'Ofrecido',
            'usuario_publicado' => 'Usuario Publicado',
            'usuario_ofrecido' => 'Usuario Ofrecido',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Devuelve el número de ofertas que están pendientes de aprobar o rechazar.
     * @return int Número de ofertas pendientes
     */
    public static function getPendientes()
    {
        return self::find()->where(['is', 'aceptada', null])
            ->andWhere(['usuario_publicado' => Yii::$app->user->identity->usuario])
            ->count();
    }
}
