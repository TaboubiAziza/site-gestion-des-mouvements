$(document).ready(function () {
    //Edit holiday
    $(document).on("click", ".btnEdit", function () {
        var id_holiday = $(this).attr('data-id');
        var user_row = $(this).closest('tr');
        var date = user_row.attr('data-date');
        var name = user_row.attr('data-name');

        $('#editForm input[name="id_holiday"]').val(id_holiday);
        $('#editForm input[name="date"]').val(date);
        $('#editForm input[name="name"]').val(name);

        //Show modal
        $('#edit').modal('show');
    })

});