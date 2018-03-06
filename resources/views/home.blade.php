@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						{{ $goal }},
					],
					backgroundColor: [
						'#ff6384',
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Created Goals',
				]
			},
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Doughnut Chart'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myDoughnut = new Chart(ctx, config);
		};
</script>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

					<canvas id="canvas" height="280" width="600"></canvas>
                    
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
