<?php

namespace otsec\yii2\bootstrap;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class ActiveForm
 * @author Artem Belov <razor2909@gmail.com>
 */
class ActiveForm extends yii\bootstrap\ActiveForm
{
    /**
     * @inheritdoc
     */
    public $fieldClass = 'otsec\yii2\bootstrap\ActiveField';
    /**
     * @inheritdoc
     */
    public $layout = 'horizontal';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $filedConfig = [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2 col-sm-10',
                'hint' => 'col-sm-10 col-md-6',
                'wrapper' => 'col-sm-10 col-md-6',
            ],
            'horizontalSizes' => [
                'xs' => [
                    'hint' => 'col-sm-offset-2 col-sm-4 col-md-2',
                    'wrapper' => 'col-sm-4 col-md-2',
                ],
                'sm' => [
                    'hint' => 'col-sm-offset-2 col-sm-6 col-md-4',
                    'wrapper' => 'col-sm-6 col-md-4',
                ],
                'md' => [
                    'hint' => 'col-sm-offset-2 col-sm-8',
                    'wrapper' => 'col-sm-10 col-md-8',
                ],
                'lg' => [
                    'hint' => 'col-sm-offset-2 col-sm-10',
                    'wrapper' => 'col-sm-10',
                ],
            ],
        ];

        $this->fieldConfig = ArrayHelper::merge($filedConfig, $this->fieldConfig);

        parent::init();
    }

    /**
     * @return string
     */
    public function beginWrapper()
    {
        $group = Html::beginTag('div', ['class' => 'form-group']);
        $cssClass = $this->fieldConfig['horizontalCssClasses']['offset'];
        $wrapper = Html::beginTag('div', ['class' => $cssClass]);
        return $group . $wrapper;
    }

    /**
     * @return string
     */
    public function endWrapper()
    {
        return str_repeat(Html::endTag('div'), 2);
    }

    /**
     * @inheritdoc
     * @return ActiveField
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }
}