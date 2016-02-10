(function($) {
    openFileDiaolg = function() {
        document.getElementById('js-upload-action').click();
    }

    removeUploadImage = function(url, id, basename_src, groups_id) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {'action' : 'deleteImage', 'id' : id, 'basename_src' : basename_src, 'groups_id' : groups_id},
            dataType: 'json',
            success:function(jsonData) {
                if (!jsonData.success) {
                    alert(jsonData.error);
                } else {
                    if (!jsonData.groups_id) {
                        $('#'+$('#js-upload-action').attr('data-input-id')).val('');
                    }
                    $('#upload-img-'+id).parent().remove();
                    $('.js-upload-gallery').sortable();
                }
            }
        });
    }

    prepareUpload = function(e) {
        var groups_id = $('#'+$(e).attr('data-input-id')).val();
        var data = new FormData();
        data.append('type', $(e).attr('data-type'));

        if (groups_id) {
            uploadGallery(e, groups_id);
        } else {
            $.ajax({
                type: 'POST',
                url: $(e).attr('data-url'),
                data: {'action' : 'addGroup', 'type' : $(e).attr('data-type')},
                dataType: 'json',
                success:function(jsonData) {
                    $('#'+$(e).attr('data-input-id')).val(jsonData.groups_id);
                    $('#'+$(e).attr('data-input-id')).val();
                    uploadGallery(e, jsonData.groups_id);
                }
            });
        }
    }

    uploadGallery = function (e, groups_id) {
        var data = new FormData();
        for (var i=0; i<$(e).prop('files').length; i++) {
            data.append('action', 'uploadImage');
            data.append('input_file_name', $(e).prop('files')[i]);
            data.append('groups_id', groups_id);
            data.append('index', i);

            $('<li role="option" aria-grabbed="false" id="new-image-'+i+'" draggable="true"><div class="upload-img">Загрузка...</div></li>').insertBefore($('.js-upload'));

            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                data: data,
                url: $(e).attr('data-url'),
                dataType: 'json',
                success: function(jsonData) {
                    if (!jsonData.success) {
                        $('#new-image-'+jsonData.index+' div.upload-img').html('<small class="text-mutted">' + jsonData.error + '</small>');
                    } else {
                        $('#new-image-'+jsonData.index+' div.upload-img').html('<a onclick="removeUploadImage(\''+$(e).attr('data-url')+'\', '+jsonData.id+', \''+jsonData.basename_src+'\', '+groups_id+')" class="btn btn-default btn-xs glyphicon glyphicon-remove"></a>');
                        $('#new-image-'+jsonData.index+' div.upload-img').css('background', 'url("'+jsonData.img_small+'") 50% 50% no-repeat');
                        $('#new-image-'+jsonData.index+' div.upload-img').attr('data-imgs-id', jsonData.id);
                        $('#new-image-'+jsonData.index+' div.upload-img').attr('id', 'upload-img-'+jsonData.id);
                        $('.js-upload-gallery').sortable();
                        $('#new-image-'+jsonData.index).removeAttr('id');
                    }
                }
            });
        }
    }

    var move_exec = 0;

    reSortGallery = function(url) {
        var data = new FormData();
        var seq = 0;
        var Images = new Object();
        $('.js-upload-gallery li').each(function(){
            var imgs_id = $(this).children('div').attr('data-imgs-id');
            if (imgs_id) {
                seq += 1;
                Images[imgs_id] = seq;
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: {'action' : 'reSortGallery', 'images' : Images},
            dataType: 'json',
            success:function(jsonData) {
                if (!jsonData.success) {
                    alert(jsonData.error);
                } else {
                    $('.js-upload-gallery').sortable();
                }
            }
        });
    }
})(jQuery);
