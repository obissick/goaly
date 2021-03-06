@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
	
	var labels =  {!! $completed !!}.map(function(e) {
   		return e.month;
	});
	var completed = {!! $completed !!}.map(function(e) {
   		return e.count;
	});

	var complabels =  {!! $created !!}.map(function(e) {
   		return e.month;
	});

	var created = {!! $created !!}.map(function(e) {
   		return e.count;
	});

	var liked = {!! $liked !!}.map(function(e) {
   		return e.liked;
	});

	var followed = {!! $followed !!}.map(function(e) {
   		return e.followed;
	});

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

	var bar = {
		type: 'pie',
		data: {
		labels: ["Created", "Completed"],
		datasets: [{
			label: "",
			backgroundColor: ["#FFEA88", "#4ACAB4"],
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
	
	var likes_follows = {
		type: 'pie',
		data: {
		labels: ["Liked", "Followed"],
		datasets: [{
			label: "",
			backgroundColor: ["#01FC04", "#FC01F9"],
			data: [liked,followed]
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
		var dtx = document.getElementById('pie').getContext('2d');
		var etx = document.getElementById('bar').getContext('2d');
		window.myDoughnut = new Chart(ctx, config);
		window.bar = new Chart(dtx, bar);
		window.likefollow = new Chart(etx, likes_follows);
	};
</script>
<div class="container container-fluid">
    <div class="row">
        <div class="col-md-6">
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
		<div class="col-md-6">
			<div class="panel panel-default">
				<!--<div class="panel-heading">Goals</div>-->
				<div class="panel-body">
					<canvas id="pie" height="280" width="600"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<!--<div class="panel-heading">Goals</div>-->
				<div class="panel-body">
					<canvas id="bar" height="280" width="600"></canvas>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Top 10 Most Liked</div>
				<div class="panel-body">
					<table class="table table-striped task-table">
						
                        <!-- Table Headings -->
                        <thead>
                            <th>Title</th>
                            <th>Likes</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
							
							@foreach ($goals as $goal)
								<tr>
									<!-- Task Name -->
									<td class="table-text">
										<div><a href="{{route('goal.show', $goal->goal_id)}}">{{ $goal->title }}</a></div>
									</td>
									<td>
										{{$goal->likes}}
									</td>
								</tr>
							@endforeach
							
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Top 10 Most Followed</div>
					<div class="panel-body">
						<table class="table table-striped task-table">
							
							<!-- Table Headings -->
							<thead>
								<th>Title</th>
								<th>Follows</th>
							</thead>
	
							<!-- Table Body -->
							<tbody>
								
								@foreach ($follows as $follow)
									<tr>
										<!-- Task Name -->
										<td class="table-text">
											<div><a href="{{route('goal.show', $follow->goal_id)}}">{{ $follow->title }}</a></div>
										</td>
										<td>
											{{$follow->follows}}
										</td>
									</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
	</div>
</div>
@endsection
