$('document').ready(function() {
    $.ajax({
        type: 'POST',
        url: "grafico.php",
        dataType: 'JSON',
        success: function(data) {

            var total = [];
            var data_v = [];
            for (var i = 0; i < data.length; i++) {
                data_v.push(data[i].data_v);
                total.push(data[i].total);
            }

            grafico(data_v, total);
        },
        error: function() {}
    });
});

function grafico(data_v, total) {
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data_v,
            datasets: [{
                label: 'Total R$',
                data: total,
                backgroundColor: [
                    'blue',
                    'red',
                    'green',
                    'gray',
                    'yellow'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                },
                title: {
                    display: true,
                    text: 'Vendas (intervalo de um ano)',
                    font: {
                        size: 20
                    }
                }

            }
        }
    });
}