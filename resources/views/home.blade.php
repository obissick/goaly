@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: 
						{{ $goal }},
					backgroundColor: [
						'#ff6384',
						'#58D68D',
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Public Goals',
					'Private Goals',
				]
			},
			options: {
				responsive: true,
				legend: {
					position: 'bottom',
				},
				title: {
					display: false,
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
        <div class="col-md-14">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
  
					<div class="row text-center text-lg-left">
			
					<div class="col-lg-3 col-md-4 col-xs-6">
						
						<canvas id="canvas" height="280" width="600"></canvas>
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					<div class="col-lg-3 col-md-4 col-xs-6">
						
					</div>
					</div>
                    
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
