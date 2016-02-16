window.onload = init;

var links = '123';
var categories_id = 3;
function init() {
    links = count(5,9);
    $('#categories-modal').on('shown.bs.modal', function(){
        alert(links);
    });
}

function count(a,b) {
    return a+b;
}

function getAllLinks() {
    $.ajax({
        type: 'POST',
        url: '/categories',
        data: {'categories_id': categories_id},
        dataType: 'json',
        success: function(jsonData) {
            return jsonData.links;
        },
        error: function() {
            alert('Server error. Please try again later.');
        }
    });

}

//(function($) {
//    $('#categories-modal').on('shown.bs.modal', function(){
//        //getParentLinks($(this).attr('data-categories-id'), null, null);
//        appendLinks();
//    });
//
//    var links = '';
//    getAllLinks();
//
//    function getAllLinks() {
//        $.ajax({
//            type: 'POST',
//            url: '/categories',
//            data: {'categories_id': 3, 'parent': 0},
//            dataType: 'json',
//            success: function(jsonData) {
//                alert(jsonData);
//            },
//            error: function() {
//                alert('Server error. Please try again later.');
//            }
//        });
//    }
//
//    function appendLinks() {
//        alert(links);
//    }
//
//    appendLink = function(categories_id, parent, level) {
//        level++;
//        var html = '<ul class="list-unstyled">';
//        json.links.forEach(function (element, index, array) {
//            if (element.parent == parent) {
//                if (array[index].child_exist == 1) {
//                    action = ' onclick="appendLink('+categories_id+', '+array[index].id+', '+array[index].level+')"';
//                } else {
//                    action = ' onclick="selectCategoryLink('+array[index].id+')"';
//                }
//                html += '<li>' +
//                    '<a'+action+' id="category-link-'+array[index].id+'">'+array[index].anchor+'</a>' +
//                    '</li>';
//            }
//        });
//        html += '</ul>';
//        $('#category-list-'+level).html(html);
//        next_level = level+1;
//        while ($('#category-list-'+next_level).length > 0) {
//            $('#category-list-'+next_level).remove();
//            next_level += 1;
//        }
//
//        if ($('#category-list-'+(level+1)).length == 0) {
//            $('#categories-lists').append('<li id="category-list-'+(level+1)+'"></li>');
//        }
//    }
//
//    getParentLinks = function(categories_id, parent, level) {
//        alert(json);
//        $.ajax({
//            type: 'POST',
//            url: '/categories',
//            data: {'categories_id': categories_id, 'parent': parent},
//            dataType: 'json',
//            success: function(jsonData) {
//                json = jsonData;
//                if(json.links.length == 0) {
//                    alert('Server error. Please try again later.');
//                    return false;
//                }
//                var html = '<ul class="list-unstyled">';
//                $.each(links = json.links, function(i){
//                    if (!links[i].parent) {
//                        var action = '';
//                        if (links[i].child_exist == 1) {
//                            action = ' onclick="appendLink('+categories_id+', '+links[i].id+', '+links[i].level+')"';
//                        } else {
//                            action = ' onclick="selectCategoryLink('+links[i].id+')"';
//                        }
//                        html += '<li>' +
//                            '<a'+action+' id="category-link-'+links[i].id+'">'+links[i].anchor+'</a>' +
//                            '</li>';
//                    }
//                });
//                html += '</ul>';
//
//                $('#category-list-'+json.level).html(html);
//
//                next_level = json.level+1;
//                while ($('#category-list-'+next_level).length > 0) {
//                    $('#category-list-'+next_level).remove();
//                    next_level += 1;
//                }
//
//                if ($('#category-list-'+(json.level+1)).length == 0) {
//                    $('#categories-lists').append('<li id="category-list-'+(json.level+1)+'"></li>');
//                }
//            },
//            error: function() {
//                alert('Server error. Please try again later.');
//            }
//        });
//    }
//
//    selectCategoryLink = function (links_is) {
//        $.ajax({
//            type: 'POST',
//            url: '/anchor-path',
//            data: {'links_id': links_is},
//            dataType: 'json',
//            success: function(jsonData) {
//                $('#'+$('#categories-modal').attr('data-input-id')).val(links_is);
//                $('#btn-categories-modal').html(jsonData.anchor_path);
//                $('#categories-modal').modal('hide');
//            },
//            error: function() {
//                alert('Server error. Please try again later.');
//            }
//        });
//    }
//})(jQuery);
