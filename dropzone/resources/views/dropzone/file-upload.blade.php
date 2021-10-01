<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">

<form action="{{ url('save-documents') }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
@csrf
<div class="fallback">
    <input class="file_name" name="file" type="files" multiple />
</div>
</form>
<button type="button" class="btn btn-success save-btn">Save</button>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script>



Dropzone.options.dropzone =
        {
            maxFilesize: 10,
            maxFiles: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 60000,
            success: function (file, response) {
                console.log('file', file);
                $('#dropzone').append('<input type="hidden" name="documents[' + file.name + '][size]" value="' + file.name + '">');
                $('#dropzone').append('<a type="button" class="edit-file-name">edit</a>');
                $('.edit-file-name').on('click', function(){
                    $('#dropzone').append('<input type="text" id="file_input" name="doc[' + file.name + '][size]" value="' + file.name + '">');
                });
                    
                $('.save-btn').on('click', function(){
                    var formData = new FormData(document.querySelector('#dropzone'));
                    console.log('formData', formData);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ url('save-documents') }}",
                        async: true,
                        dataType: "json",
                        data: formData,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log('res', response);
                        },
                        error: function(err_res) {
                            console.log('err_res', err_res);
                        }
                    });
                });
                // $('.dz-preview').append('<a class="dz-remove edit-name" data-filename="'+file.name+'" data-dz-remove>edit</a>');
                // myFun();
                $('.save-btn').attr('file_name', file.name);
            },
            error: function (file, response) {
                return false;
            }
        };
        // function myFun() {
        //     $('.edit-name').on('click', function(){
        //         var name = $(this).attr('data-filename');
        //         $(this).siblings(".dz-details").find(".dz-filename").append(
        //                         '<input type="text" name="file_name" class="form-control doc-rename-field" value="' +
        //                         name + '">');
        //     });
        // }
        
</script>