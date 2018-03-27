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
				'Public',
				'Private',
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'top',
			},
			title: {
				display: false,
				text: 'Goals'
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	};

	var labels =  {!! $completed !!}.map(function(e) {
   		return e.month;
	});
	var completed = {!! $completed !!}.map(function(e) {
   		return e.count;
	});;

	var complabels =  {!! $created !!}.map(function(e) {
   		return e.month;
	});

	var created = {!! $created !!}.map(function(e) {
   		return e.count;
	});;

	var bar = {
		type: 'pie',
		data: {
		labels: ["Created", "Completed"],
		datasets: [{
			label: "",
			backgroundColor: ["#3cba9f", "#3e95cd"],
			data: [created,completed]
		}]
		},
		options: {
			title: {
			display: false,
			text: ''
			}
		}
	};

	window.onload = function() {
		var ctx = document.getElementById('dough').getContext('2d');
		var dtx = document.getElementById('bar').getContext('2d');
		window.myDoughnut = new Chart(ctx, config);
		window.bar = new Chart(dtx, bar);
	};
</script>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Goals</div>-->
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					
					<canvas id="dough" height="280" width="600"></canvas>			
                </div>
            </div>
		</div>
		<div class="col-md-5">
				<div class="panel panel-default">
					<!--<div class="panel-heading">Goals</div>-->
					<div class="panel-body">
						<canvas id="bar" height="280" width="600"></canvas>
					</div>
				</div>
		</div>
	</div>
</div>
@endsection
