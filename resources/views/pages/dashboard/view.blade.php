@extends('master')

@section('title','Dashboard')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Selesai <span class="text-muted">( per
                            bulan )</span>
                    </span>
                    <h2 class="fs-32 font-w700 text-success">{{$dataMonthDone}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Perbaikan<span class="text-muted">( per
                            bulan )</span></span>
                    <h2 class="fs-32 font-w700 text-warning">{{$dataMonthProgress}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Pending<span class="text-muted">( per
                            bulan )</span></span>
                    <h2 class="fs-32 font-w700 text-danger">{{$dataMonthOpen}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Waiting<span class="text-muted">( per
                            bulan )</span></span>
                    <h2 class="fs-32 font-w700 text-blue">{{$dataMonthWaiting}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Selesai <span class="text-muted">( per
                            minggu )</span>
                    </span>
                    <h2 class="fs-32 font-w700 text-success">{{$dataWeekDone}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Perbaikan<span class="text-muted">( per
                            minggu )</span></span>
                    <h2 class="fs-32 font-w700 text-warning">{{$dataWeekProgress}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Pending<span class="text-muted">( per
                            minggu )</span></span>
                    <h2 class="fs-32 font-w700 text-danger">{{$dataWeekOpen}}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body ">
                    <span class="fs-18 font-w500 d-block mb-2">Status Waiting<span class="text-muted">( per
                            minggu )</span></span>
                    <h2 class="fs-32 font-w700 text-blue">{{$dataWeekWaiting}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Bar Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="barChart_1"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<script>
    (function($) {
  "use strict" 

 var dlabSparkLine = function(){
    
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	var screenWidth = $(window).width();
	
	var barChart1 = function(){
        
		if(jQuery('#barChart_1').length > 0 ){
			const barChart_1 = document.getElementById("barChart_1").getContext('2d');
            let app = @json($name);
    
			barChart_1.height = 100;

			new Chart(barChart_1, {
				type: 'bar',
				data: {
					defaultFontFamily: 'Poppins',
					labels: app,
					datasets: [
						{
							label: "My First dataset",
							data: {{$value}},
							borderColor: 'rgba(136,108,192, 1)',
							borderWidth: "0",
							backgroundColor: 'rgba(136,108,192, 1)'
						}
					]
				},
				options: {
					legend: false, 
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}],
						xAxes: [{
							// Change here
							barPercentage: 0.5
						}]
					}
				}
			});
		}
	}


	/* Function ============ */
	return {
		init:function(){
		},
		
		
		load:function(){
			barChart1();
		},
		
		resize:function(){
			// barChart1();	
		}
	}

}();

jQuery(document).ready(function(){
});
	
jQuery(window).on('load',function(){
	dlabSparkLine.load();
});

jQuery(window).on('resize',function(){
	//dlabSparkLine.resize();
	setTimeout(function(){ dlabSparkLine.resize(); }, 500);
});
	
})(jQuery);
</script>

@endsection