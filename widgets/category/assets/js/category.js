(function($) {
    $('#categories-modal').on('shown.bs.modal', function(){
        getParentLinks($(this).attr('data-categories-id'), null, null);
    });

    getParentLinks = function(categories_id, parent, level) {
        if (parent) {
            $('#category-list-'+level).find('a').removeClass('active');
            $('a#category-link-'+parent).addClass('active');
        }

        $.ajax({
            type: 'POST',
            url: '/categories',
            data: {'categories_id': categories_id, 'parent': parent},
            dataType: 'json',
            success: function(jsonData) {
                if(jsonData.links.length == 0) {
                    alert('Server error. Please try again later.');
                    return false;
                }
                var html = '<ul class="list-unstyled">';
                $.each(links = jsonData.links, function(i){
                    var action = '';
                    if (links[i].child_exist == 1) {
                        action = ' onclick="getParentLinks('+categories_id+', '+links[i].id+', '+links[i].level+')"';
                    } else {
                        action = ' onclick="selectCategoryLink('+links[i].id+')"';
                    }
                    html += '<li>' +
                                '<a'+action+' id="category-link-'+links[i].id+'">'+links[i].anchor+'</a>' +
                            '</li>';
                });
                html += '</ul>';

                $('#category-list-'+jsonData.level).html(html);

                next_level = jsonData.level+1;
                while ($('#category-list-'+next_level).length > 0) {
                    $('#category-list-'+next_level).remove();
                    next_level += 1;
                }

                if ($('#category-list-'+(jsonData.level+1)).length == 0) {
                    $('#categories-lists').append('<li id="category-list-'+(jsonData.level+1)+'"></li>');
                }
            },
            error: function() {
                alert('Server error. Please try again later.');
            }
        });
    }

    selectCategoryLink = function (links_is) {
        $.ajax({
            type: 'POST',
            url: '/anchor-path',
            data: {'links_id': links_is},
            dataType: 'json',
            success: function(jsonData) {
                $('#'+$('#categories-modal').attr('data-input-id')).val(links_is);
                $('#btn-categories-modal').html(jsonData.anchor_path);
                $('#categories-modal').modal('hide');
            },
            error: function() {
                alert('Server error. Please try again later.');
            }
        });
    }
})(jQuery);
