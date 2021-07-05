@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Candidate</div>

                <div class="card-body">
                    <form action="{{ route('update.candidate', $edit_candidate_details->id) }}" method="post" id="candidate_form" onsubmit="return validate()">
                        @csrf
                        <div class="form-group">
                            <label>Name Of Candidate</label>
                            <input type="text" name="name" value="{{ $edit_candidate_details->name }}" class="form-control" id="name" aria-describedby="emailHelp">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <h6 id="namecheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label>Surname Of Candidate</label>
                            <input type="text" name="surname" value="{{ $edit_candidate_details->surname }}" class="form-control" id="surname" aria-describedby="emailHelp">
                            @error('surname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <h6 id="surnamecheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label for="description">Description Of Candidate</label>
                            <textarea name="description" id="description" class="form-control" cols="100" rows="3">{{ $edit_candidate_details->description }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <h6 id="desccheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group" id="candidate_hobby">
                            <label for="candidate_hobby">Hobbies Of Candidate:</label>
                            <div id="input_dynamic"></div>
                            <div style="display:none;" id="hobby_block">
                                <div class="main" id="{rand}" style="padding: 10px;">
                                    <div class="inputBlock" style="display:flex;">
                                        <input type="text" name="{dynamicHobbyName}" class="form-control col-md-5 hobbies" id="hobbies" />
                                        <input type="hidden" name="{dynamicHobbyParent}" value={parent} />
                                        <a href="javascript:void(0)" class="add btn btn-primary" data-rand="{rand}" data-parent="{parent}" style="color: white; font-size : 16px; text-decoration : none;">+</a>
                                        <a href="javascript:void(0)" class="remove btn btn-danger" data-rand="{rand}" data-parent="{parent}" style="color: white; font-size : 16px; text-decoration : none; margin-left: 5px;">-</a>
                                        <a href="javascript:void(0)" class="add_child btn btn-warning" data-rand="{rand}" data-parent="{parent}" style="color: black; font-size : 16px; text-decoration : none; margin-left: 5px;">Child +</a>
                                    </div>
                                    <div class="child" style="padding: 10px;">
                                    </div>
                                </div>
                            </div>
                            @error('hobby.*')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <h6 id="hobbycheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control" name="language">
                                <option selected disabled>Choose a language</option>
                                <option {{ $edit_candidate_details->language =='Hindi' ? 'selected' : ''}} value="Hindi">Hindi</option>
                                <option {{ $edit_candidate_details->language =='English' ? 'selected' : ''}} value="English">English</option>
                                <option {{ $edit_candidate_details->language =='Arabic' ? 'selected' : ''}} value="Arabic">Arabic</option>
                                <option {{ $edit_candidate_details->language =='Armenian' ? 'selected' : ''}} value="Armenian">Armenian</option>
                                <option {{ $edit_candidate_details->language =='Basque' ? 'selected' : ''}} value="Basque">Basque</option>
                            </select>
                            @error('language')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <h6 id="languagecheck" class="text-danger"></h6>
                        </div>
                        <button type="submit" class="btn btn-primary addblog" id="create">Update Candidate</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        getUrl();
        child_btn();
        remove_btn();
        add_btn();
    })

    function getUrl() {
        var currentPageUrl = window.location.href;
        var str_pos = currentPageUrl.indexOf("create");
        if (str_pos > -1) {
            addFields('', '', '')
        } else {
            var check_div = currentPageUrl.indexOf("candidate_hobby");
            if (check_div > -1) {
                $('html,body').animate({
                        scrollTop: $("#candidate_hobby").offset().top
                    },
                    'slow');
                display();
            } else {
                <?php if (isset($edit_candidate_details) && $edit_candidate_details) { ?>
                    displayPostedData();
                <?php } else { ?>
                    display();
                <?php } ?>
            }
        }
    }

    function addFields(parent, clickObject, settings, postedData) {

        var randNo = Math.floor(Math.random() * 10000);
        if (settings) {
            if (typeof settings.id != 'undefined' && settings.id) {
                randNo = settings.id;
            }
        }
        if (postedData) {
            if (typeof postedData.id != 'undefined' && postedData.id) {
                randNo = postedData.id;
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

        if (postedData) {
            if (typeof postedData.title != 'undefined' && postedData.title) {
                $('input[name = "hobby[' + randNo + '][title]"]').val(postedData.title);
            }
        }
    }

    function child_btn() {
        $('body').on('click', '.add_child', function() {
            addFields($(this).attr('data-rand'), '', '');
        });
    }

    function add_btn() {
        $('body').on('click', '.add', function() {
            addFields($(this).attr('data-parent'), $(this).parent().parent(), '');
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

    function check_hobby_elements() {
        var numberOfMain = $("#input_dynamic > div").length;
        if (numberOfMain == 1) {
            $(".remove").prop('disabled', true);
        }
    }

    function display() {
        <?php
        $hobby = json_decode($edit_candidate_details->hobby_name, true);
        if (isset($hobby) && $hobby) {
            foreach ($hobby as $key => $value) {
        ?>
                var settings = {};
                settings.id = parseInt('<?php echo $key; ?>');
                settings.title = "<?php echo $value['title']; ?>";
                <?php
                if (isset($value['parent']) && $value['parent']) {
                ?>
                    addFields("<?php echo $value['parent']; ?>", '', settings);
                <?php
                } else {
                ?>
                    addFields('', '', settings);
                <?php
                }
            }
        }
        ?>
    }

    function displayPostedData() {
        <?php
        if (isset($edit_candidate_details) && $edit_candidate_details) {
            $hobby = json_decode($edit_candidate_details->hobby_name, true);
            foreach ($hobby as $key => $value) {
        ?>
                var postedData = {};
                postedData.id = parseInt('<?php echo $key; ?>');
                postedData.title = "<?php echo $value['title']; ?>";
                <?php
                if (isset($value['parent']) && $value['parent']) {
                ?>
                    addFields("<?php echo $value['parent']; ?>", '', postedData);
                <?php
                } else {
                ?>
                    addFields('', '', postedData);
                <?php
                }
            }
        }
        ?>
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