<?php namespace Anomaly\TopProductsWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadTopProducts
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\TopProductsWidgetExtension\Command
 */
class LoadTopProducts
{

    use DispatchesJobs;

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadTopProducts instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        $this->widget->addData(
            'mode',
            $mode = $configuration->value('anomaly.extension.top_products_widget::mode', $this->widget->getId())
        );

        if ($mode == 'count') {
            $this->dispatch(new LoadTopSelling($this->widget));
        }

        if ($mode == 'grossing') {
            $this->dispatch(new LoadTopGrossing($this->widget));
        }
    }
}
