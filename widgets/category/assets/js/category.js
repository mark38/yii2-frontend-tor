window.onload = init;

var links;
var categories_id = 3;
var current_level;
function init() {
    getAllLinks(initLinks);
    $('#categories-modal').on('shown.bs.modal', function(){
        appendParentLinks();
    });
}

function initLinks(data) {
    links = data;
}

function getAllLinks(initLinks) {
    $.ajax({
        type: 'POST',
        url: '/categories',
        data: {'categories_id': categories_id},
        dataType: 'json',
        success: function(jsonData) {
            initLinks(jsonData.links);
        },
        error: function() {
            alert('Server error. Please try again later.');
        }
    });
}

function appendParentLinks() {
    var html = '<ul id="list-0" class="list-unstyled">';
    links.forEach(function (item, index, array) {
        if (!item.parent) {
            if (item.child_exist) {
                action = ' onclick="appendChildLinks('+item.id+', '+item.level+')"';
            } else {
                action = ' onclick="selectCategoryLink('+item.id+', \''+item.anchor+'\')"';
            }
            html += '<li>' +
                '<a'+action+' id="category-link-'+item.id+'">'+item.anchor+'</a>' +
                '</li>';
        }
    });
    html += '</ul>';
    current_level = links[0].level;
    $('#category-list').html(html);
}

function appendChildLinks(parent_id, parent_level) {
    if (current_level-parent_level > 0) {
        do {
            $('#list-' + current_level).remove();
            current_level--;
        } while (current_level >= parent_level)
    } else {
        $('#list-' + parent_level).remove();
    }

    current_level++;

    var html = '<ul id="list-' + parent_level + '" class="list-unstyled">';
    links.forEach(function (item, index, array) {
        if (item.parent == parent_id) {
            if (item.child_exist) {
                action = ' onclick="appendChildLinks('+item.id+', '+item.level+')"';
            } else {
                action = ' onclick="selectCategoryLink('+item.id+', \''+item.anchor+'\')"';
            }
            html += '<li>' +
                '<a'+action+' id="category-link-'+item.id+'">'+item.anchor+'</a>' +
                '</li>';
        }
    });
    html += '</ul>';
    $('#category-list').append(html);
}

function selectCategoryLink (links_is, anchor) {
    $('#'+$('#categories-modal').attr('data-input-id')).val(links_is);
    $('#btn-categories-modal').html(anchor);
    $('#categories-modal').modal('hide');
}
