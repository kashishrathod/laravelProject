<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Create Category

        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card-header">Create Category</div>
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="return validate()" class="newuser">
                                @csrf
                                <div id="category_block">
                                    <div class="form-group" id="form_hobby">
                                        <label>Category Name:</label>
                                        <input type="text" name="category_name" class="form-control" id="category_name">
                                        <h6 id="namecheck" class="text-danger"></h6>
                                        <div class="error_msg_show text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="candidate_hobby">Choose Category:</label>
                                        <div id="input_dynamic"></div>
                                        <div class="main" id="{rand}" style="padding: 10px;">
                                            <div class="inputBlock">
                                                <select name="category_select" id="category_select" class="form-control">
                                                    <option id="" value="" selected disabled>choose category</option>
                                                </select>
                                            </div>
                                            <div class="child" style="padding: 10px;"></div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success add">Add Category</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">cancle</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <script>
        var arr;
        var l;
        <?php if(isset($edit_candidate_details -> category_name)) { ?>
        var category = {!! json_encode($edit_candidate_details->category_name) !!};
            arr = JSON.parse(category);
            var l = Object.keys(arr).length;
            console.log(l);
            $.each(arr, function(index, value) {
                var option = '<option class='+index+' data-rand='+value["n_cat"]+' value=' + index + '>' + value["name"] + '</option>';
                if(value["parent"] == null) {
                    $('#category_select').append(option);
                } 
                else {
                    var childOption = {};
                    childOption.index = index;
                    childOption.value = value;
                    if(!jQuery.isEmptyObject(childOption)) {
                    if(value["n_cat"] > 0) {
                        var space_value = '&nbsp;'
                        var space = space_value.repeat(2*value["n_cat"]);
                        var option = '<option data-rand='+value["n_cat"]+' class='+childOption.index+' value=' + childOption.index + '>' +space + childOption.value["name"] + '</option>';
                        $("select ."+childOption.value['parent']).after(option);
                    }    
                }
            }
            });
       <?php } ?>
       
        $(document).on('click', '.add', function(){
            if(validate()) {
                let categoryNameValue = $('#category_name').val();
                let selectValue = $('#category_select').val();
                if(selectValue) {
                    var number = $("#category_select").find(':selected').data('rand');
                    var categoryData = {
                        "name": categoryNameValue,
                        "parent": selectValue,
                        "n_cat": number+1,
                    }
                    var temp = {
                        [(l==null) ? 1 : l+1]: categoryData,
                    }
                    
                    var details;
                    if(arr) {
                        details = {...arr, ...temp};
                    } 

                } else {
                    if(selectValue == '') {
                        selectValue = 'NULL';
                    }
                    var categoryData = {
                        "name": categoryNameValue,
                        "parent": selectValue,
                        "n_cat": 0,
                    }
                    var temp = {
                        [(l==null) ? 1 : l+1]: categoryData,
                    }
                    var details;
                    if(arr) {
                        details = {...temp, ...arr};
                    } else {
                        details = temp;
                    }   
                }
                var result = JSON.stringify(details);
                var url = "{{ route('add.category') }}"; 
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        category: result,
                    },
                    success: function(response) {
                        if(response.errors)
                        {
                            $('.error_msg_show').html(response.errors);
                        }
                        location.reload();
                    }
                });
            }
        });
        // validation
        var valid = true;

        function validate() {
            // name
            let nameValue = document.getElementById('category_name').value;
            if (nameValue.length == '') {
                document.getElementById('namecheck').innerHTML = 'Categoryname is required!';
                valid = false;
            } else if (!nameValue.trim('')) {
                document.getElementById('namecheck').innerHTML = 'Does not allow white space!';
                valid = false;
            } else {
                document.getElementById('namecheck').innerHTML = '';
            }
            return valid;
        }
    </script>
    @endsection
</x-app-layout>