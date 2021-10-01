<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<form method="POST">
@csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" id="input_data" class="form-control" value="{{ $edit_data->file_url }}">
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success edit">Update</button>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    $('.edit').on('click', function(){
        console.log('test');
        var input_value = $('#input_data').val();
        console.log('input_value',input_value);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "{{ route('edit-documents', $edit_data->id) }}",
            async: true,
            dataType: "json",
            data: {
                input: input_value
            }, 
            type: 'post',
            success: function(response) {
            },
            error: function(err_res) {
            }
        });
    });
</script>
