/**
 * 
 * Doctor Directory Layout 
 */
function resizeGridItem(item) {
    var grid = $("#js-doctorDirectory");
    var rowHeight = parseInt(grid.css('grid-auto-rows'));
    var rowGap = parseInt(grid.css('grid-row-gap'));
    var rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
    item.style.gridRowEnd = "span " + rowSpan;
    item.querySelector('.content').style.height = "auto";
}

function resizeAllGridItems() {
    var allItems = document.getElementsByClassName("js-expertCard");
    for (var x = 0; x < allItems.length; x++) {
        resizeGridItem(allItems[x]);
    }
}

function resizeInstance(instance) {
    var item = instance.elements[0];
    resizeGridItem(item);
}

window.onload = resizeAllGridItems();
window.addEventListener("resize", resizeAllGridItems);

/**
 * Doctor Directory Search
 */
function searchDoctorDirectory(current_page=null) {
    var sortBy = $('#sortBy').val();
    var specialty = $('#searchSpecialty').val();
    var expertise = $('#searchExpertise').val();
    var current_page = (current_page) ? current_page : $('#current_page').val();
    var formData = new FormData();
        formData.append('action', 'searchDoctorDirectory');
        formData.append('specialty', specialty);
        formData.append('expertise', expertise);
        formData.append('sortBy', sortBy);
        formData.append('current_page', current_page);

    jQuery.ajax({
        cache: false,
        url: bms_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#js-doctorDirectoryPaginator').addClass('d-none');
            $('#js-doctorDirectory').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader">');
        },
        success: function (response) {
            $('#js-doctorDirectoryPaginator').removeClass('d-none');
            $('#js-doctorDirectory').html(response.data.html);
            $('#js-doctorDirectoryPaginator').html(response.data.paginator);
        },
        complete: function () {
            resizeAllGridItems();
        }
    });
}

$('#searchSpecialty').on('change', function () {
    searchDoctorDirectory();
})

$('#searchExpertise').on('change', function () {
    searchDoctorDirectory();
})

$('#sortBy').on('change', function () {
    searchDoctorDirectory();
})

/**
 * Filter by name DD 
 */
function filterToProfile(obj) {

    if (obj.value == '') {
        searchDoctorDirectory();
        return;
    }

    var formData = new FormData();
        formData.append('action', 'filterDoctorDirectory');
        formData.append('expert_id', obj.value);

    jQuery.ajax({
        cache: false,
        url: bms_vars.ajaxurl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#js-doctorDirectoryPaginator').addClass('d-none');
            $('#js-doctorDirectory').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader">');
        },
        success: function (response) {
            $('#js-doctorDirectoryPaginator').removeClass('d-none');
            $('#js-doctorDirectory').html(response.data.html);
            $('#js-doctorDirectoryPaginator').html(response.data.paginator);
        },
        complete: function () {
            resizeAllGridItems();
        }
    });
}

/**
 * Module Hero DD
 */
$(document).ready(function() {
    /**
     * selectpicker options https://developer.snapappointments.com/bootstrap-select/options/#bootstrap-version
     */
    $('#searchSpecialty').selectpicker({virtualScroll: false});
    $('#searchExpertise').selectpicker({virtualScroll: false});
    $('#sortBy').selectpicker({virtualScroll: false});
    $('#filterByExpert').selectpicker({virtualScroll: false});
});