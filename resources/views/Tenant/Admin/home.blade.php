@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.dashboardTitle'))

@section('content')
<div class="row stats">
    <div class="col-12 col-md-3">
        <div class="statContainer red shadow-sm">
          <div class="title text-center">Google</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Google }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer purple shadow-sm">
          <div class="title text-center">Instagram</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Instagram }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer blue shadow-sm">
          <div class="title text-center">Twitter</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Twitter }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer fountainBlue shadow-sm">
          <div class="title text-center">Snapchat</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Snapchat }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer lightBlue shadow-sm">
          <div class="title text-center">Facebook</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Facebook }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer yellow shadow-sm">
          <div class="title text-center">Behance</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Behance }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer pink shadow-sm">
          <div class="title text-center">Tiktok</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $Tiktok }}</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="statContainer orange shadow-sm">
          <div class="title text-center">LinkedIn</div>
          <div class="d-flex">
            <div class="p-2 flex-fill text-center ">
              <h5 class="font-weight-bold status">{{ $LinkedIn }}</h5>
            </div>
          </div>
        </div>
    </div>
</div>


<div id="DaychartContainer" style="height: 370px; width: 100%;"></div>
<br>
<div id="MonthchartContainer" style="height: 370px; width: 100%;"></div>
<br>
<div id="YearchartContainer" style="height: 370px; width: 100%;"></div>


@endsection


@section('css')
    <style>
       
        .stats {
          margin: 5px;
        }
        .stats .col {
          //border: 1px solid red;
          margin: 0;
          padding: 3;
        }
        .statContainer {
          margin: 5px;
          width: 100%;
          font-size: 13px;
          border-radius: 3px;
          background-color: #fff !important;
          padding: 0;
          overflow: hidden;
        }
        .statContainer .title {
          padding: 5px 10px;
          color: #fff !important;
        }
        .statContainer.red .title {
          background-color: red !important;
        }
        .statContainer.red .status {
          color: red !important;
        }
        .statContainer.blue .title {
          background-color: #2d72c0 !important;
        }
        .statContainer.blue .status {
          color: #2d72c0 !important;
        }

        .statContainer.yellow .title {
          background-color: #f3a254 !important;
        }
        .statContainer.yellow .status {
          color: #f3a254 !important;
        }

        .statContainer.fountainBlue .title {
          background-color: #6abebf !important;
        }
        .statContainer.fountainBlue .status {
          color: #6abebf !important;
        }

        .statContainer.lightBlue .title {
          background-color: #52a1e5 !important;
        }
        .statContainer.lightBlue .status {
          color: #52a1e5 !important;
        }

        .statContainer.purple .title {
          background-color: #916df6 !important;
        }
        .statContainer.purple .status {
          color: #916df6 !important;
        }

        .statContainer.pink .title {
          background-color: #ef6e85 !important;
        }
        .statContainer.pink .status {
          color: #ef6e85 !important;
        }

        .statContainer.orange .title {
          background-color: #ff7043 !important;
        }
        .statContainer.orange .status {
          color: #ff7043 !important;
        }

    </style>
@endsection
@section('js')

    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
            
        	$("#DaychartContainer").CanvasJSChart(options =  {
            	animationEnabled: true,
            	theme: "light2",
            	title: {
            		text: "Day Visits Chart"
            	},
            	data: [{
            		type: "spline", 
            		dataPoints: [
                        @foreach ($DayVisits as $Visit)
                            { 
                                x: new Date('{{ $Visit->new_date }}'),
        			            y: {{ $Visit->views }}
                            },
                        @endforeach
                    ]
            	}]
            });


        	$("#MonthchartContainer").CanvasJSChart(options =  {
            	animationEnabled: true,
            	theme: "light2",
            	title: {
            		text: "Month Visits Chart"
            	},
        		axisX: {
            		valueFormatString: "MMM YYYY",
            	},
            	data: [{
            		type: "doughnut", 
            		dataPoints: [
                        @foreach ($MonthVisits as $Visit)
                            { 
        			            y: {{ $Visit->views }},
        			            name: "{{ $Visit->year }},{{  $Visit->month }}",
                            },
                        @endforeach
                    ]
            	}]
            });


        	$("#YearchartContainer").CanvasJSChart(options =  {
            	animationEnabled: true,
            	theme: "light2",
            	title: {
            		text: "Year Visits Chart"
            	},
        		axisX: {
            		valueFormatString: "YYYY",
            	},
            	data: [{
            		type: "column", 
            		dataPoints: [
                        @foreach ($YearVisits as $Visit)
                            { 
                                x: new Date('{{ $Visit->year }}'),
        			            y: {{ $Visit->views }}
                            },
                        @endforeach
                    ]
            	}]
            });

        
    </script>

@endsection
