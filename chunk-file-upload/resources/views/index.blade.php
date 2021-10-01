 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">   
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card-header">Upload Chunk</div>
            <div class="card">
                <div id="upload-container" class="form-group">
                    <button id="browsefile" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
<script>
    let browsefile = $('#browsefile');
    let r = new Resumable({
        target:'{{ route('upload.large') }}', 
        query:{_token:'{{ csrf_token() }}'},
        fileType: ['mp4'],
        headers: {
            'Accept' : 'application/json',
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });
    r.assignBrowse(browsefile[0]);
    r.on('fileAdded', function(file){
        r.upload();
    });
    r.on('fileProgress', function(file){

    });
    r.on('fileSuccess', function(file, response){
        alert('success');
    });
    r.on('fileError', function(file, response){
        alert('error');
    });

</script>