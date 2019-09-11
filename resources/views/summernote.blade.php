<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

</head>
<style>
    textarea {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body>
@section('javascript')

    <div class="container">
        @csrf
        <form action="{{route('steps.store')}}" method="POST">
            <textarea name="summernoteInput" class="summernote"></textarea><br>
            <button type="submit">Submit</button>
        </form>
    </div><!-- /.container -->
@endsection


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="application/javascript">
    $(document).ready(function() {
        $('#bgtext').summernote({
            minHeight: 300,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });

        var bghtml = '<div><p>bgtext</p><p>Summernote can insert HTML string</p></div>';
        $('#bgtext').summernote('code', bghtml);

        $('#simtext').summernote({
            minHeight: 300,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });

        var HTMLstring = '<div><p>Simulation text</p><p>Summernote can insert HTML string</p></div>';
        $('#simtext').summernote('code', HTMLstring);
    });
</script>



</body>
</html>


