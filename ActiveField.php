<?php

namespace otsec\yii2\bootstrap;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class ActiveField
 * @author Artem Belov <razor2909@gmail.com>
 */
class ActiveField extends \yii\bootstrap\ActiveField
{
    /**
     * @var array
     */
    public $horizontalSizes = [];

    /**
     * @param string  $before
     * @param string  $after
     * @param boolean $encode
     * @return static
     */
    public function group($before = null, $after = null, $encode = true)
    {
        $input = '{input}';

        if ($before) {
            $before = ($encode) ? Html::encode($before) : $before;
            $input = Html::tag('span', $before, ['class' => 'input-group-addon']) . $input;
        }
        if ($after) {
            $after = ($encode) ? Html::encode($after) : $after;
            $input = $input . Html::tag('span', $after, ['class' => 'input-group-addon']);
        }

        $this->inputTemplate = Html::tag('div', $input, ['class' => 'input-group']);

        return $this;
    }

    /**
     * Renders a static control with a plain tex.
     *
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
     *
     * If you set a custom `id` for the input element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @return static the field object itself
     */
    public function plain($options = [])
    {
        $options = array_merge($this->inputOptions, $options);

        $tag = ArrayHelper::remove($options, 'tag', 'p');
        Html::addCssClass($options, 'form-control-static');

        $this->parts['{input}'] = Html::tag($tag, Html::getAttributeValue($this->model, $this->attribute), $options);

        return $this;
    }

    /**
     * @param string $size
     * @return static
     */
    public function labelHideable($size = 'xs')
    {
        Html::addCssClass($this->labelOptions, 'hidden-' . $size);
        return $this;
    }

    /**
     * @param string $name
     * @return static
     */
    public function size($name)
    {
        $classes = ArrayHelper::getValue($this->horizontalSizes, $name);

        if (is_array($classes)) {
            $this->horizontalCssClasses = ArrayHelper::merge($this->horizontalCssClasses, $classes);

            if (isset($classes['wrapper'])) {
                $this->wrapperOptions['class'] = $classes['wrapper'];
            }

            if (isset($classes['label'])) {
                $this->labelOptions['class'] = 'control-label ' .$classes['label'];
            }

            if (isset($classes['error'])) {
                $this->errorOptions['class'] = 'help-block help-block-error ' . $classes['error'];
            }

            if (isset($classes['hint'])) {
                $this->hintOptions['class'] = 'help-block ' . $classes['hint'];
            }
        }

        return $this;
    }

    /**
     * @return static
     */
    public function xs()
    {
        return $this->size('xs');
    }

    /**
     * @return static
     */
    public function sm()
    {
        return $this->size('sm');
    }

    /**
     * @return static
     */
    public function md()
    {
        return $this->size('md');
    }

    /**
     * @return static
     */
    public function lg()
    {
        return $this->size('lg');
    }
}