<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            create New Blog

        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">Create New Blog</div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('addblog') }}" method="POST" onsubmit="return validate()" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Blog Title</label>
                                    <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="titlecheck" class="text-danger">
                                    </h6>
                                </div>
                                <div class="form-group">
                                    <label for="blog_img">Blog Image</label>
                                    <input type="file" name="blog_img" class="form-control" id="file" aria-describedby="emailHelp">
                                    @error('blog_img')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="imgcheck" class="text-danger">
                                    </h6>
                                </div>
                                <div class="form-group new">
                                    <label for="tag[]">Tag</label><br>
                                    <a href="Javascript:void(0)" class="btn btn-info addtag">+</a><br>
                                    <input type="text" name="tag[]" id="tag" class="form-control" aria-describedby="emailHelp">
                                    <h6 id="tagcheck" class="text-danger">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="100" rows="3"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="desccheck" class="text-danger">
                                    </h6>
                                </div>
                                <button type="submit" class="btn btn-primary addblog">Add Blog</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">cancle</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '.addtag', function() {
            var newtag = '<div id="group" style="display: flex; margin-top:7px"><input style="margin-right:2px;" type="text" id="delete" name="tag[]" class="form-control" aria-describedby="emailHelp"><a href="Javascript:void(0)" id="remove" class="btn btn-danger removetag">-</a></div>';
            $('.new').append(newtag);
        });
        $(document).on('click', '.removetag', function() {
            $(this).closest('#group').remove();
        });

        // validation
        var valid = true;
        function validate() {
            // title
            let titleValue = document.getElementById('title').value;
            if (titleValue.length == '') {
                document.getElementById('titlecheck').innerHTML= 'Title is required!';
                valid = false;
            } else if (!titleValue.trim('')) {
                document.getElementById('titlecheck').innerHTML= 'Title does not allow white space!';
                valid = false;
            } else {
                document.getElementById('titlecheck').innerHTML= '';
            }
            //description
            let descValue = document.getElementById('description').value;
            if (descValue.length == '') {
                document.getElementById('desccheck').innerHTML= 'Description is required!';
                valid = false;
            } else if (!descValue.trim('')) {
                document.getElementById('desccheck').innerHTML= 'Description does not allow white space!';
                valid = false;
            } else {
                document.getElementById('desccheck').innerHTML= '';
            }
            // tag
            let tagValue = document.getElementById('tag').value;
            if (tagValue.length == '') {
                document.getElementById('tagcheck').innerHTML= 'Tag is required!';
                valid = false;
            } else if (!tagValue.trim('')) {
                document.getElementById('tagcheck').innerHTML= 'Tag does not allow white space!';
                valid = false;
            } else {
                document.getElementById('tagcheck').innerHTML= '';
            }
            // image
            var imginput = document.getElementById('file');
            if(imginput.files.length === 0){
                document.getElementById('imgcheck').innerHTML= 'Image is required!';
                valid = false;
            }
            else {
                document.getElementById('imgcheck').innerHTML= '';
            }
            return valid;
        }
        $('#file').on('change', function() {
            const size = (this.files[0].size / 1024 / 1024).toFixed(2);
            if (size > 0.1) {
                $('#imgcheck').html('Image size is more than 100KB!'); 
            } 
        }); 

    </script>
    @endsection
</x-app-layout>