<?php namespace Anomaly\TopProductsWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\ProductsModule\Product\Contract\ProductRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LoadTopSelling
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\TopProductsWidgetExtension\Command
 */
class LoadTopSelling implements SelfHandling
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadTopSelling instance.
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
     * @param ProductRepositoryInterface $products
     */
    public function handle(ProductRepositoryInterface $products)
    {
        $query = $products->newQuery();

        $results = $query
            ->select(['*', \DB::raw('SUM(quantity) AS sold')])
            ->join('orders_items', 'orders_items.product_id', '=', 'products_products.id')
            ->join('orders_orders', 'orders_items.order_id', '=', 'orders_orders.id')
            ->where('orders_orders.created_at', '>=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('orders_orders.created_at', '<=', date('Y-m-d H:i:s'))
            ->where('orders_orders.status', 'complete')
            ->groupBy('orders_items.product_id')
            ->orderBy('sold', 'DESC')
            ->limit(5)
            ->get();

        $this->widget->addData('products', $results);
    }
}
