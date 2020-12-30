<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GeekSeat Witch Saga</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="mt-5">Geekseat Witch Saga</h1>
                        <p class="lead">Return Of The Coder!</p>
                        <p class="text-justify">Somewhere far far away, there is a village which is controlled by a dark and cunning witch. Coincidentally, this witch is also a die-hard programmer. The witch has power to control death and life of the villager. The witch will kill a number of villagers each year.</p>
                        <p class="text-justify">Since the witch is a die hard programmer, she follow a specific rule to decide the number of villagers she should kill each year.</p>
                        <p class="text-justify">The villagers are furious with the witch and want to get rid of her and there is one way to get rid of her. The witch will only leave if there is a brave programmer in the villager who can create a program to solve this problem:
                            If given two people whose age of death and year of death are known, find the average number of
                            people the witch killed on year of birth of those people.</p>
                        <p class="lead">
                            Feel my wrath!
                        </p>
                        <p class="text-justify">Suddenly, From the Realm of Nusantara come <strong>Ahmad Cahyana</strong> a man who wants to solve the problem. He wrote some codes and ....</p>
                    </div>
                    <div class="col-lg-6 align-self-xl-center">
                        <h1 class="mt-5">Expel The Witch!</h1>
                        <form id="expel" method="post" action="javascript:void(0)">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" name="year_of_death[]" class="form-control" placeholder="Enter Year of Death" autocomplete="off" required>
                                            <input type="text" name="age_of_death[]" class="form-control" placeholder="Enter Age of Death" autocomplete="off" required>
                                            <div class="input-group-append">
                                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="newRow"></div>
                                    <input type="hidden" name="form_submitted" value="1" />
                                    <button type="submit" id="send_form" class="btn btn-primary align-content-xl-end">Submit</button>
                                </div>
                                <div class="col-lg-3">
                                    <button id="addRow" type="button" class="btn btn-success">Add Row</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
    <div id="succesModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">We Solve the Riddle!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body load_modal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="year_of_death[]" class="form-control m-input" placeholder="Enter Year of Death" autocomplete="off" required>';
            html += '<input type="text" name="age_of_death[]" class="form-control m-input" placeholder="Enter Age of Death" autocomplete="off" required>';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        $('#send_form').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#send_form').html('Sending..');
            console.log("cccc")
            $.ajax({
                type: "POST",
                url: "{{ url('/') }}",
                data: $('#expel').serialize(),
                success: function(response){
                    $('#send_form').html('Submit');
                    renderModal(response);
                    console.log(response)
                }
            });
        });
        function renderModal(data){
            $.ajax({
                type: "POST",
                url: "{{ url('/show') }}",
                data: data,
                success: function(response){
                    $('#succesModal').modal();
                    $('#succesModal').on('shown.bs.modal', function(){
                        $('#succesModal .load_modal').html(response);
                    });
                    $('#succesModal').on('hidden.bs.modal', function(){
                        $('#succesModal .modal-body').data('');
                    });
                }
            });
        }
    </script>
</html>
