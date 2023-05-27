// Initialising DataTable
$(document).ready( function () {
    $('#attendance-table').DataTable();
} );

/**
 * fetch attendance with date filter
 * and without filter
 **/
const fetchAttendance = (date = '') => {
    $.ajaxSetup({
        headers: {
            'Accepts': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: 'attendances/list' + (date != '' ? '/' + date : ''),
        success: function (response) {
            if (response.success == true) {
                var html = '';
                if (response.data.length > 0) {
                    response.data.forEach(function (item, index) {
                        html += '<tr>';
                        html += '<th scope="row">' + (index + 1) + '</th>';
                        html += '<td>' + item?.user?.name + '</td>';
                        html += '<td>' + item?.date + '</td>';
                        html += '<td>' + item?.status + '</td>';
                        html += '</tr>';
                    });
                    $('#attendance').html(html);
                } else {
                    $('#attendance').html(
                        '<tr><td colspan="4" class="text-center">No data available</td></tr>'
                    );
                }
            } else {
                console.log(response);
            }
        }
    });
}

fetchAttendance();

/**
 * call fetchAttendance function to get
 * date wise data
 **/
$('#filter-by-date').submit(function (e) {
    e.preventDefault();
    var date = $('input[type="date"]').val();
    fetchAttendance(date);
});

/**
 * save and update attendance
 **/
$('#mark-attendance').on('submit', function (e) {
    e.preventDefault();
    var user_id, status;
    user_id = $('.name').val();
    status = $('.status').val();
    console.log(user_id, status);

    $.ajaxSetup({
        headers: {
            'Accepts': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: 'attendances/store',
        data: {
            user_id,
            status
        },
        success: function (response) {
            if (response.success === true) {
                user_id = $('.name').val('');
                status = $('.status').val('');
                fetchAttendance();
            } else {
                alert(response);
            }
        },
        error: function (error) {
            console.log(error.status);
        }
    });
});
