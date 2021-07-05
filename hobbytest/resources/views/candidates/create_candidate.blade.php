<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Create Candidate

        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">Create Candidate</div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('add.candidate') }}" method="POST" onsubmit="return validate()">
                                @csrf
                                <div class="form-group">
                                    <label>Name Of Candidate</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="namecheck" class="text-danger"></h6>
                                </div>
                                <div class="form-group">
                                    <label>Surname Of Candidate</label>
                                    <input type="text" name="surname" class="form-control" id="surname" aria-describedby="emailHelp">
                                    @error('surname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="surnamecheck" class="text-danger"></h6>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description Of Candidate</label>
                                    <textarea name="description" id="description" class="form-control" cols="100" rows="3"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="desccheck" class="text-danger"></h6>
                                </div>
                                <div class="form-group" id="form_hobby">
                                    <label for="candidate_hobby">Hobbies Of Candidate:</label>
                                    <div id="input_dynamic"></div>
                                    <div style="display: none;" id="hobby_block">
                                        <div class="main" id="{rand}" style="padding: 10px;">
                                            <div class="inputBlock" style="display: flex;">
                                                <input type="text" name="{dynamicHobbyName}" class="form-control col-md-5" id="hobbies">
                                                <input type="hidden" name="{dynamicHobbyParent}" value={parent} />
                                                <a href="javascript:void(0)" class="add btn btn-primary" data-rand="{rand}" data-parent="{parent}" style="color: white; font-size : 16px; text-decoration : none; margin-left:10px;">+</a>
                                                <a href="javascript:void(0)" class="remove btn btn-danger" data-rand="{rand}" data-parent="{parent}" style="color: white; font-size : 16px; text-decoration : none; margin-left:10px;">-</a>
                                                <a href="javascript:void(0)" class="add_child btn btn-warning" data-rand="{rand}" data-parent="{parent}" style="color: black; font-size : 16px; text-decoration : none; margin-left:10px;">Child +</a>
                                            </div>
                                            <div class="child" style="padding: 10px;"></div>
                                        </div>
                                    </div>
                                    @error('hobby.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="hobbycheck" class="text-danger"></h6>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <select class="form-control" name="language" id="language">
                                                <option value="" selected disabled>Choose a language</option>
                                                <option value="Hindi">Hindi</option>
                                                <option value="English">English</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Armenian">Armenian</option>
                                                <option value="Basque">Basque</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                    @error('language')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <h6 id="languagecheck" class="text-danger"></h6>
                                </div>
                                <button type="submit" class="btn btn-primary addblog">Create Candidate</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">cancle</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            add_child_btn();
            add_btn();
            add_field('', '', '');
            remove_btn();
        });

        function add_field(parent, clickObject, settings) {
            var randNo = Math.floor(Math.random() * 10000);
            if (settings) {
                if (typeof settings.id != 'undefined' && settings.id) {
                    randNo = settings.id;
                }
            }
            var inputHobby = $('#hobby_block').html();
            inputHobby = inputHobby.replace(/{dynamicHobbyName}/g, 'hobby[' + randNo + '][title]');
            inputHobby = inputHobby.replace(/{dynamicHobbyParent}/g, 'hobby[' + randNo + '][parent]');
            inputHobby = inputHobby.replace(/{rand}/g, randNo);

            if (parent) {
                inputHobby = inputHobby.replace(/{parent}/g, parent);
            } else {
                inputHobby = inputHobby.replace(/{parent}/g, '');
            }
            if (clickObject) {
                clickObject.after(inputHobby);
            } else {
                if (parent) {
                    $('#' + parent + ' .child').first().append(inputHobby);
                } else {
                    $('#input_dynamic').append(inputHobby);
                }
            }

            if (settings) {
                if (typeof settings.title != 'undefined' && settings.title) {
                    $('input[name = "hobby[' + randNo + '][title]"]').val(settings.title);
                }
            }
        }

        function add_child_btn() {
            $('body').on('click', '.add_child', function() {
                add_field($(this).attr('data-rand'), '', '');
            });
        }

        function add_btn() {
            $('body').on('click', '.add', function() {
                add_field($(this).attr('data-parent'), $(this).parent().parent(), '');
                var numberOfMain = $("#input_dynamic > div").length;
            });
        }

        function remove_btn() {
            $('body').on('click', '.remove', function(e) {
                e.preventDefault();
                var element = $(this).attr('data-rand');
                var removeElement = document.getElementById(element);
                removeElement.remove();
                var numberOfMain = $("#input_dynamic > div").length;
                console.log(numberOfMain);
                if (numberOfMain == 1) {
                    $(".remove").prop('disabled', true);
                }
            });
        }
        // validation
        var valid = true;

        function validate() {
            // name
            let nameValue = document.getElementById('name').value;
            if (nameValue.length == '') {
                document.getElementById('namecheck').innerHTML = 'Name is required!';
                valid = false;
            } else if (!nameValue.trim('')) {
                document.getElementById('namecheck').innerHTML = 'Name does not allow white space!';
                valid = false;
            } else {
                document.getElementById('namecheck').innerHTML = '';
            }
            // surname
            let surnameValue = document.getElementById('surname').value;
            if (surnameValue.length == '') {
                document.getElementById('surnamecheck').innerHTML = 'Surname is required!';
                valid = false;
            } else if (!surnameValue.trim('')) {
                document.getElementById('surnamecheck').innerHTML = 'Surnameame does not allow white space!';
                valid = false;
            } else {
                document.getElementById('surnamecheck').innerHTML = '';
            }
            //description
            let descValue = document.getElementById('description').value;
            if (descValue.length == '') {
                document.getElementById('desccheck').innerHTML = 'Description is required!';
                valid = false;
            } else if (!descValue.trim('')) {
                document.getElementById('desccheck').innerHTML = 'Description does not allow white space!';
                valid = false;
            } else {
                document.getElementById('desccheck').innerHTML = '';
            }
            // hobby
            let hobbyValue = document.getElementById('hobbies').value;
            if (hobbyValue.length == '') {
                document.getElementById('hobbycheck').innerHTML = 'Hobby is required!';
                valid = false;
            } else if (!hobbyValue.trim('')) {
                document.getElementById('hobbycheck').innerHTML = 'Hobby does not allow white space!';
                valid = false;
            } else {
                document.getElementById('hobbycheck').innerHTML = '';
            }
            // language
            let languageValue = document.getElementById('language').value;
            if (languageValue.length == '') {
                document.getElementById('languagecheck').innerHTML = 'Language is required!';
                valid = false;
            } else {
                document.getElementById('languagecheck').innerHTML = '';
            }
            return valid;
        }
    </script>
    @endsection
</x-app-layout>