(function($) {

    $('#categories-modal').on('shown.bs.modal', function(){
        getLink($(this).attr('data-categories-id'), null);
    });

    $('#categories-modal').on('hidden.bs.modal', function () {
        $('#categories-lists-null').next().remove();
    });

    function getLink(categories_id, parent) {
        $.ajax({
            type: 'POST',
            url: '/categories',
            data: {'categories_id': categories_id, 'parent': parent},
            dataType: 'json',
            success: function(jsonData) {
                var html = !parent ? '<ul class="list-unstyled list-inline">' : '<ul class="list-unstyled">';
                $.each(links = jsonData.links, function(i){
                        if (links[i].child_exist == 1) {
                            html += '<li>' +
                                '<span id="categories-lists-'+links[i].id+'">' +links[i].anchor+'</span>' +
                                '</li>';
                            getLink(categories_id, links[i].id);
                        } else {
                            html += '<li>' +
                                '<a onclick="selectCategoryLink('+links[i].id+')" id="category-link-'+links[i].id+'">'+links[i].anchor+'</a>' +
                                '</li>';
                        }
                });
                html += '</ul>';
                $('#categories-lists-' + parent).parent().append(html);
            },
            error: function() {
                alert('Server error. Please try again later.');
            }
        });
    }

    function selectCategoryLink(links_is) {
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
