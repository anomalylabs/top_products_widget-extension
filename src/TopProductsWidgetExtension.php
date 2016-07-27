<?php namespace Anomaly\TopProductsWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\TopProductsWidgetExtension\Command\LoadTopProducts;

/**
 * Class TopProductsWidgetExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\TopProductsWidgetExtension
 */
class TopProductsWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides the "Top Products"
     * products module widget for the dashboard module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.dashboard::widget.top_products';

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        $this->dispatch(new LoadTopProducts($widget));
    }
}
