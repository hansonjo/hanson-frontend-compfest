@extends('layout/master')

@section('title')
    Home
@endsection

@section('content')
<div class="main-container">
    <div class="content">
        @if (get_role() == 'Administrator')
            <button class="add-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Add Data
            </button>
        @endif
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($datas as $index => $data)
                <div class="col appointment-card" id="{{$index}}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$data->name}}</h5>
                            <p class="card-text">{{$data->description}}</p>
                        </div>
                        @if (get_role() == 'Administrator')
                            <div class="symbol-container">
                                <button class="button-icon edit-button" id="{{$data->_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </button>
                                <button class="button-icon delete-button" id="{{$data->_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal-background"></div>
<div class="modal-container">
    <div class="modal-card">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">List of Registrant</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modalToggle(false)"></button>
          </div>
        <div class="modal-body">
            <div id="no-data">No Data</div>
            <div id="data-container"></div>
        </div>
        <div class="button-container">
            <button type="button" class="btn btn-success">
                <div id="apply-text">Apply</div>
                <img class="loading-gif" src="{{ asset('images/gif/loading.gif') }}" alt="" id="apply-loading">
            </button>
            <button type="button" class="btn btn-danger" disabled>Full</button>
            <button type="button" class="btn btn-warning">
                <div id="cancel-text">Cancel</div>
                <img class="loading-gif" src="{{ asset('images/gif/loading.gif') }}" alt="" id="cancel-loading">
            </button>
        </div>
    </div>
</div>
@endsection

@push('head')
    <style>
        .symbol-container{
            margin-left: auto;
            z-index: 2;
        }

        .content{
            display: flex;
            flex-direction: column;
        }

        .main-container{
            padding: 5%;
        }
        
        .appointment-card{
            cursor: pointer;
            pointer-events: pointer;
        }

        .add-btn{
            width: 125px;
            border-radius: 200px;
            height: 40px;
            background-color: white;
            border-color: black;
            margin-left: auto;
            margin-bottom: 20px;
        }

        .modal-background{
            z-index: 10;
            position: fixed;
            background-color: #4B6073;
            opacity: 50%;
            width: 100%;
            height: 100%;
            bottom: 0px;
            display: none;
        }

        .button-icon{
            width: 40px;
            height: 40px;
            background-color: white;
            border: none;
        }

        .loading-gif{
            height: 25px;
            display: none;
            margin: 0 auto;
        }

        .modal-container{
            z-index: 100;
            width: 500px;
            height: 400px;
            background-color: white;
            position: fixed;
            justify-content: center;
            top: 50%;
            margin-top: -200px;
            left: 50%;
            margin-left: -250px;
            display: none;
        }

        #no-data{
            text-align: center;
            font-size: 1.5rem;
            font-weight: 300;
            display: none;
        }

        .patient-name{
            width: 100%;
            height: 35px;
            line-height: 31px;
            border: 1px solid black;
            margin-bottom: 15px;
            padding-left: 15px;
            border-left: 10px solid;
        }

        .button-container{
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 20px;
            display: flex;
        }
        
        .button-container button{
            width: 75px;
            margin: 5px;
        }

        .btn-warning{
            color: white;
        }
    </style>
@endpush

@push('bottom')
    <script>
        var datas = {!! json_encode($datas) !!};
        var id;

        $('.add-btn').click(function() {
            window.location.href = "/create-appointment"
        })

        $('.appointment-card').click(function() {
            modalToggle(false);
            $('#no-data').css('display','none');
            $('#data-container').empty();

            $('.btn-danger').css('display','none');
            $('.btn-success').css('display','none');
            $('.btn-warning').css('display','none');
            
            id = $(this).attr('id');

            var list = datas[id].list[0];

            if('{{get_role()}}' != 'Administrator'){
                
                if(list.length < 3) $('.btn-success').css('display','block');

                if(list.length == 0) $('#no-data').css('display','block');
            
                if(isExist(list) == true) {
                    $('.btn-warning').css('display','block');
                    $('.btn-success').css('display','none');
                }else{
                    if(list.length == 3) $('.btn-danger').css('display','block');
                }

            }

            list.forEach(ls => {
                $('#data-container').append('<div class="patient-name">' + ls.name + '</div>');
            });
        })

        $('.delete-button').click(function() {
            modalToggle(false);
            window.location.href = '/delete-appointment/' + $(this).attr('id');
        });

        $('.edit-button').click(function() {
            modalToggle(false);
            window.location.href = '/edit-appointment/' + $(this).attr('id');
        })

        $('.btn-close').click(function() {
            modalToggle(true);
        })

        function modalToggle(hide){
            let display = "block";
            if(hide == true) display = "none";
            $('.modal-background').css('display',display);
            $('.modal-container').css('display',display);
        }

        function isExist(list){
            var id = '{{ get_id() }}';
            var isExist = false;
            list.forEach(ls => {
                if(id == ls.user_id) isExist = true;
            });
            return isExist;
        }

        $('.btn-success').click(function(){
            loading('apply');
            $.ajax({
                method: "POST",
                url: "{{ api_domain() }}/appointment/apply/" + datas[id]._id,
                headers: {
                    'auth-token': '{{ get_token() }}',
                },
                success: function(data) {
                    sleep(1500).then(() => {
                        text('apply')
                    });
                    reloadPage();
                }
            });
        })

        $('.btn-warning').click(function(){
            loading('cancel');
            $.ajax({
                method: "DELETE",
                url: "{{ api_domain() }}/appointment/cancel/" + datas[id]._id,
                headers: {
                    'auth-token': '{{ get_token() }}',
                },
                success: function(data) {
                    sleep(1500).then(() => {
                        text('cancel')
                    });
                    reloadPage();
                }
            });
        })

        function loading(text){
            $('#' + text + '-text').css('display','none');
            $('#' + text + '-loading').css('display','flex');
        }

        function text(text){
            $('#' + text + '-text').css('display','block');
            $('#' + text + '-loading').css('display','none');
        }

        function reloadPage(){
            location.reload();
        }

        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }

    </script>
@endpush