function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.' + input.id).attr('src', e.target.result);
            $('.' + input.id).closest('a').removeClass('err').removeClass('required');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function keyDownTextField(e) {
    setTimeout(function () {
        var inp = $('#setLabel').val();
        $('.createLab').html(inp)
    }, 1000);
}

function keyDownTextFieldValue(e) {
    setTimeout(function () {
        var inp = $('#selOpt').val();
        inp = inp.split(' ').join('_');
        $('#selVal').val(inp)
    }, 1000);
}

function imageIsLoaded(i, e) {
    var id = parseInt(e.timeStamp, 10);
    var imgTmpl = '<li class="float-lg-left col-md-2 s" id="' + id + '" name="' + id + '">' +
        '<a href="#" class="delmg">' +
        '<img class="img-fluid opacity-img" src="' + e.target.result+ ' ">' +
        '<i class="fas fa-spinner fa-spin"></i>' +
        '<button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>' +
        '</a>' +
        '</li>';
    var fd = new FormData();
    var files = $('#uploadImages')[0].files[i];
    fd.append('images',files);
    fd.append('id',id);
    $.ajax({
        url: APP_URL + '/ci-admin/images-save',
        type: 'post',
        data: fd,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('.product_img').append(imgTmpl);
            $('#submitClick').prop('disabled', true);
        },
        success: function(response){
            if(response.status == true){
                var oldId = parseInt(response.oldId, 10);
                var newId = response.id;
                var name = response.name;
                $('#'+oldId).attr('id', newId);
                $('#'+newId).attr('name', name);
                $('#'+newId).find('img').removeClass('opacity-img');
                $('#'+newId).find('.fa-spinner').remove();
                $('#submitClick').prop('disabled', false);
            }
        },
        error: function (data) {
            if( data.status === 422 ) {
                var errors = $.parseJSON(data.responseText);
                console.log(errors.message);
            }
            $('#'+id).remove();
            $('#submitClick').prop('disabled', false);
        }
    });
}

$(document).ready(function () {
    var id;
    var i = 0;
    var add = {};
    var elementObj = [];
    var imagesObj = [];
    var isVisible = false;
    var clickedAway = false;

    function validate(el) {
        $(':input').removeClass('err');
        var check = true;
        $(el).each(function (key, val) {
            if ($(val).prop('required')) {
                if ($(val).val() == '') {
                    $(val).addClass('err');
                    check = false;
                }
            }
        });
        return check;
    }

    function validateImg(el) {
        var status = true;

        $(el).each(function (key, val) {
            if ($(val).hasClass('required')) {
        console.log(el);
                $(val).addClass('err');
                status = false;
            }
        });
        return status;
    }

    $("#uploadImages").change(function () {
        var noOfFiles = this.files.length;
        for (var i = 0; i < noOfFiles; i++) {
            if(this.files[i].type == 'image/jpeg'){
                var reader = new FileReader();
                reader.onload = imageIsLoaded.bind(reader, i);
                reader.readAsDataURL(this.files[i]);
            }else {
                alert('error ');
            }
        }
    });

    $(document).on('click', '#clickUpl', function (e) {
        $('#uploadImages').click();
        e.preventDefault();
    });

    $(document).on('click', '.delmg', function (e) {
        e.preventDefault();
        var el = $(this).closest('a').attr('id');
        if (el) {
            var id = el.split('-');
            $.ajax({
                method: 'DELETE',
                url: APP_URL + '/ci-admin/images-delete/' + id[1],
                dataType: 'json',
                success: function (d) {
                    $('#'+id[1]).remove();
                }

            });
        }else{
            $(this).remove();
        }
    });
    //, #uploadImages
    $('#i1, #i2').change();

    $('#element-popover').popover({
        html: true,
        content: $('#popover_content_wrapper .form-group').clone()
    });

    $(document).on('click', ".closePop", function () {
        $('#element-popover').click();
    });

    $(document).click(function (e) {
        if (isVisible & clickedAway) {
            $('#element-popover').popover('hide');
            isVisible = clickedAway = false
        } else {
            clickedAway = true
        }
    });

    $(document).on('change', "#set_el", function () {
        id = $(":selected", this).attr("value");
        $('.dynamic_field').attr('id', 'dynamic_field1')
    });

    $(document).on('click', '#add', function () {
        if (id === '1') {
            $('#addElemModal').modal('show');
        }
    });

    $(document).on('click', '.remove_el', function () {
        id = $(this).attr("id");
        $('#el-' + id).remove();
    });
    //////modal

    $(document).on('click', '#addSel', function () {
        i = i + 1;
        var opt = $('#selOpt');
        var val = $('#selVal');
        var qua = $('#selQua');
        var html = '<div class="form-group" id="sel-' + i + '">\n' +
            '                                <div class="form-group col-md-4 float-lg-left">\n' +
            '                                    <input type="text" class="form-control field col-md-11" id="selOpt" value="' + opt.val() + '" disabled>\n' +
            '                                </div>\n' +
            '                            <div class="form-group col-md-4 float-lg-left">\n' +
            '                                <div class="">\n' +
            '                                    <input type="text" class="form-control field col-md-11" id="selVal" value="' + val.val() + '" disabled>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="form-group col-md-2 float-lg-left">\n' +
            '                                <div class="">\n' +
            '                                    <input type="number" class="form-control field col-md-12" id="selQua" value="' + qua.val() + '" disabled>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="form-group col-md-2 float-lg-left">\n' +
            '                                <div class="">\n' +
            '                                    <button type="button" class="btn btn-danger delSel" id="' + i + '">\n' +
            '                                        <i class="fas fa-times"></i>\n' +
            '                                    </button>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            </div>';

        if (validate($('#addS :input')) === true) {
            $('#createSel').append('<option id="opt-' + i + '" value="' + val.val() + '" qua="' + qua.val() + '">' + opt.val() + '</option>');
            $('#ovq').append(html);
            opt.val('');
            val.val('');
            qua.val('1');
        }
    });

    $(document).on('click', '.delSel', function () {
        id = $(this).attr("id");
        $('#sel-' + id).remove();
        $('#opt-' + id).remove();
    });

    $(document).on('click', '.delDinEl', function () {
        id = $(this).attr("id");
        delete add[id];
        $('#rea-' + id).remove();
        $(this).click();
    });

    $(document).on('click', '#addElement', function () {
        var id = +new Date()
        var el = $('#elClone').clone().html();
        var html = ' <div class="form-inline getEl" id="rea-' + id + '">\n' +
            '                                    <div class="form-group col-md-9 float-lg-left">\n' +
            el +
            '                                    </div>\n' +
            '                                    <div class="form-group col-md-3 float-lg-left">\n' +
            '                                        <span  class="control-label"></span >\n' +
            '                                        <button type="button" class="btn btn-danger delDinEl" id="' + id + '">\n' +
            '                                            <i class="fas fa-times"></i>\n' +
            '                                        </button>\n' +
            '                                    </div>';
        $('.dynamic_field').append(html);
        $(".dynamic_field [id*='opt-']").attr('id', id);
        var t = $('#rea-' + id + ' label').first().text();
        var idA = t.split(new RegExp('[,:;\n]', 'g'));
        idA = idA[0].split(' ').join('_');

        $('#rea-' + id + ' label').html(t);
        $('#rea-' + id + ' select').attr({'id': idA, 'name': idA});


        $('#addElemModal').modal('toggle');
    });

    $('#addElemModal').on('hidden.bs.modal', function () {
        $('#addS').trigger("reset");
        $('#ovq, #view .createLab').html('');
        $("#view [id*='opt-']").remove();
    });

    $(document).on('click', '#save', function () {
        var html = '';
        var elm = $('.getEl:visible');
        var label;
        var select;
        $.each(elm, function (key, el) {
            var ids = el.id;
            label = $('#' + ids + ':visible label').text();
            select = $('#' + ids + ':visible select').parent().html();
            html += '<div class="form-group col-md-6 float-lg-left">' +
                select +
                '</div>';
        });

        $('#dynamic').append(html);
        $('#dynamic_el').html($('#dynamic').html());
        $('#element-popover').popover('hide');
        $('.dynamic_field').html('');

    });

    $(document).on('click', '.close-popover', function () {
        $('#cart-popover').popover('hide');
    });

    $('.summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
        popover: {
            image: [],
            link: [],
            air: []
        },
        height: 150,
        disableDragAndDrop: true,
        disableResizeEditor: true
    });

    $('.clickimg').click(function () {
        var id = $(this).attr('id');
        $('.' + id).click()
    });

    $('.product_img').sortable(
        {
            handle: "img",
            cursor: "move"
        }
    );

    $('#ovq, .getEl:visible').sortable(
        {
            handle: ".form-group",
            cursor: "move"
        }
    );

    $(document).on('click', '.save', function () {
        var $context = $(this).data('context');
        var fromval = $('.popover #fromvalue').val();
        var toval = $('.popover #tovalue').val();
        $context.siblings('.text-container').text('From: ' + fromval + ' To: ' + toval);
    });

    $(document).on('click', '#submitClick', function () {
        if ((validate($('#formProduct :input')) === true) && (validateImg($('#formProduct a.clickimg')) === true)) {

            $.each($('.product_img li.s'), function (k, images) {
                imagesObj.push({'image': $(images).attr('name')})
            });

            $.each($('#dynamic:visible select'), function (key, e) {
                var label = $(e).prev().text();
                $.each($(e).find('option'), function (key, el) {
                    if (el.id) {
                        var val = el.value;
                        var qua = $(el).attr('qua');
                        var opt = $(el).text();
                        elementObj.push({'name': opt, 'value': val, 'qua': qua});
                    }
                });
                add[label] = elementObj;
                elementObj = [];
            });

            $('#dynamic_obj').html(JSON.stringify(add));
            $('#images_obj').html(JSON.stringify(imagesObj));
            imagesObj = [];
            $('#formProduct').submit();

        }
    });
    //////
    $(document).on('click', '.deleteElement', function () {
        var ok = confirm("Do you want to delete this element?");
        var id = this.id;
        if (ok) {
            $.ajax({
                    method: 'DELETE',
                    url: APP_URL + '/ci-admin/element/' + id,
                    dataType: 'json',
                    success: function (d) {
                        $('#element-'+id).remove()
                    }

                }
            );
        }

    });
});
