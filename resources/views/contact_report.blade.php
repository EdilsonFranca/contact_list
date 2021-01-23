@extends('principal')
@section('css')
@stop
@section('conteudo')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
               <canvas id="myChart"/>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card mt-3" >
                <div class="card-body">
                    <h5 class="card-title my-2">
                        <strong class="d-inline-block" style="width: 110px">Name</strong> {{  $contact->name  }}</h5>
                    <h6 class="card-subtitle my-2">
                        <strong class="d-inline-block"  style="width: 110px">CPF</strong> {{  $contact->cpf  }}</h6>
                    <p class="card-text my-2">
                        <strong class="d-inline-block"  style="width: 110px;">Phone</strong> {{  $contact->phone  }}</p>
                    <p class="card-text my-2">
                        <strong class="d-inline-block"  style="width: 110px">Status</strong> {{  $contact->status  }}</p>
                </div>
            </div>
        </div>
    </div>
        <a href="/list_management"
           class="btn text-white"
           style="border: 3px solid darkorange;
           background: rgb(255, 181, 0); margin: 0px 10px;">
            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['{{  $contact->status  }}'],
                datasets: [{
                    label: 'Status',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    barPercentage: 0.5,
                    barThickness: 6,
                    maxBarThickness: 8,
                    minBarLength: 2,
                    data: [{{  $porc  }}]
                }]
            },

            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Status por %'
                }
            }
        });
    </script>
@stop