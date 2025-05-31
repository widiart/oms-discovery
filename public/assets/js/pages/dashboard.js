$(document).ready(function() {
    $.ajax({
        url: summaryUrl,
        type: 'GET',
        beforeSend: function(xhr) {
            const token = localStorage.getItem('auth_token');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(data) {
            $('#total-total-users').text(data.data.customer.current);
            $('#total-active-users').text(data.data.active.current);
            $('#total-total-order').text(data.data.order.current);
            $('#total-total-sales').text('Rp ' + parseInt(data.data.sales.current/1000000).toLocaleString('id-ID')+ 'M');

            $('#percent-total-users').text(parseFloat((data.data.customer.current - data.data.customer.last) / data.data.customer.last * 100).toFixed(2));
            $('#percent-active-users').text(parseFloat((data.data.active.current - data.data.active.last) / data.data.active.last * 100).toFixed(2));
            $('#percent-total-order').text(parseFloat((data.data.order.current - data.data.order.last) / data.data.order.last * 100).toFixed(2));
            $('#percent-total-sales').text(parseFloat((data.data.sales.current - data.data.sales.last) / data.data.sales.last * 100).toFixed(2));
            
            $('#message-total-users').html('From last month: <span class="text-success">' + data.data.customer.last + '</span>');
            $('#message-active-users').html('From last month: <span class="text-success">' + data.data.active.last + '</span>');
            $('#message-total-order').html('From last month: <span class="text-success">' + data.data.order.last + '</span>');
            $('#message-total-sales').html('From last month: <span class="text-success">Rp ' + parseInt(data.data.sales.last/1000000).toLocaleString('id-ID') + 'M</span>');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching dashboard data:', error);
        }
    });
    $.ajax({
        url: salesOverviewUrl,
        type: 'GET',
        beforeSend: function(xhr) {
            const token = localStorage.getItem('auth_token');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(data) {
          const options = {
            chart: {
              type: 'bar',
              height: 430,
              toolbar: {
                show: false
              }
            },
            plotOptions: {
              bar: {
                columnWidth: '60%',
                borderRadius: 4
              }
            },
            stroke: {
              show: true,
              width: 8,
              colors: ['transparent']
            },
            dataLabels: {
              enabled: false
            },
            legend: {
              position: 'top',
              horizontalAlign: 'right',
              show: true,
              fontFamily: `'Public Sans', sans-serif`,
              offsetX: 10,
              offsetY: 10,
              labels: {
                useSeriesColors: false
              },
              markers: {
                width: 10,
                height: 10,
                radius: '50%',
                offsexX: 2,
                offsexY: 2
              },
              itemMargin: {
                horizontal: 15,
                vertical: 5
              }
            },
            colors: ['#faad14', '#1890ff'],
            series: [{
              name: 'Last Month Sales',
              data: data.data.last_month
            }, {
              name: 'Current Month Sales',
              data: data.data.current_month
            }],
            xaxis: {
              categories: data.data.categories,
            },
          }
          var chart = new ApexCharts(document.querySelector('#sales-overview'), options);
          chart.render();
        }
    });
})
