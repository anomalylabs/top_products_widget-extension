$(function () {

    $('[data-provides="anomaly.extension.top_products_widget"][data-mode="count"]').each(function () {

        var json = $(this).data('json');

        // Chart Data
        var data = {
            labels: json.map(function (product) {
                return product.name;
            }),
            datasets: [
                {
                    data: json.map(function (product) {
                        return product.sold;
                    }),
                    backgroundColor: [
                        '#61259e',
                        '#38b5e6',
                        '#24ce7b',
                        '#f69630',
                        '#f6303e'
                    ],
                    hoverBackgroundColor: [
                        '#61259e',
                        '#38b5e6',
                        '#24ce7b',
                        '#f69630',
                        '#f6303e'
                    ]
                }]
        };

        // Chart Options
        var options = {
            legend: {
                position: 'right'
            },
            paddingTop: 0,
            paddingLeft: 0,
            paddingRight: 0,
            paddingBottom: 0
        };

        // And for a doughnut chart
        new Chart($(this), {
            type: 'doughnut',
            data: data,
            options: options
        });
    });
});
