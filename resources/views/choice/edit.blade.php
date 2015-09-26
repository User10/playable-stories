@extends('framework')

@section('header-include')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('navbar-right')
    <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-right">
            <a href="" class="navbar-btn btn btn-default" target="_blank">Delete</a>
            <a href="" class="navbar-btn btn btn-primary" id="save-button">Save</a>
        </div>
    </div>
@stop

@section('content')
    @if ($choice->meter_effect == 'chance')
        @include('choice.partials.chance-edit')
    @elseif ($choice->meter_effect == 'specific')
        @include('choice.partials.specific-edit')
    @elseif ($choice->meter_effect == 'none')
        @include('choice.partials.none-edit')
    @endif
@stop

@section('footer-include')
    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
    <script>
        $(function(){
            // Initialize TinyMCE
            tinymce.init({
                selector: '.wysiwyg',
                elementpath: false,
                statusbar: false,
                menubar: false,
            });
        });

        // Submit for when clicking 'Save' button
        $( "#save-button" ).click(function(event) {
            event.preventDefault();
            $( "#choice-edit-form" ).submit();
        });

        function deleteChoice(id) {
            if (confirm('Delete this choice?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "DELETE",
                    url: '/choice/' + id,
                    success: function(affectedRows) {
                        if (affectedRows > 0) location.reload();
                    }
                });
            }
        }
    </script>
@stop