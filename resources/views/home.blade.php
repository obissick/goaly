@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
                    <script>
                        var url = "{{url('stock/chart')}}";
                        var Years = new Array();
                        var Labels = new Array();
                        var Prices = new Array();
                        $(document).ready(function(){
                        $.get(url, function(response){
                            response.forEach(function(data){
                                Years.push(data.stockYear);
                                Labels.push(data.stockName);
                                Prices.push(data.stockPrice);
                            });
                            var ctx = document.getElementById("canvas").getContext('2d');
                                var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels:Years,
                                    datasets: [{
                                        label: 'Infosys Price',
                                        data: Prices,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                        });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
