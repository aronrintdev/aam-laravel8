
            <canvas id="myChart" width="700" height="400"></canvas>

@push('scripts')
<script
    src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"
></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bubble',
    data: {
        datasets: [{
            label: 'Lessons',
            data: [
            ],
            backgroundColor:
                'rgba(255, 99, 132, 0.4)',
            borderColor: 
                'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            xAxes: [{
                type: 'category',
                ticks: {
                    /*
                    callback:function(value, index, values) {
                        if (!this.options.academyLabels) {
                            return '';
                        }
                        return this.options.academyLabels[value];

                    }
                    */
                },
			}],
            yAxes: [{
                ticks: {
					min:0,
					max:5,
                    beginAtZero: true,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
						switch(value) {
							case 1: return 'Not-Started';
							case 2: return 'Not-Assigned';
							case 3: return 'In-Progress';
							case 4: return 'Completed';
							default: return '';
						}
                    },
                }
            }]
        }
    }
});
$.get('/lesson-stats').then((response) => {
    var newlabels = [];
    response.forEach((item) => {
        if (newlabels.indexOf(item.academy_code) === -1) {
            newlabels.push(item.academy_code);
        }
    });
    myChart.options.academyLabels = newlabels;
    myChart.options.scales.xAxes[0].academyLabels = newlabels;
    //console.log(newlabels);
    myChart.options.scales.xAxes[0].labels = newlabels;
//    myChart.scales['x-axis-0'].buildTicks();

    response.forEach((item) => {
        var thisy = 1;
        if (item.status == 'waiting') {
            thisy = 2;
        }
        if (item.status == 'assigned') {
            thisy = 3;
        }
        if (item.status == 'completed') {
            thisy = 4;
        }
        myChart.data.datasets[0].data.push({
            x:item.academy_code, y: thisy, r:item.cnt*5
        });
    });
    myChart.update();
});
</script>
@endpush
