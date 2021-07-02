$(document).ready(function () {
    $(document).on("click", ".btnEdit", function () {
        var user_row = $(this).closest('tr');
        var matricule = $(this).attr('data-id');
        var authorizationbalance = user_row.attr('data-authorizationbalance');
        var leavebalance = user_row.attr('data-leavebalance');

        $('#editForm input[name="matricule"]').val(matricule);
        $('#editForm input[name="leavebalance"]').val(leavebalance);
        $('#editForm input[name="authorizationbalance"]').val(authorizationbalance);


        //Show modal
        $('#edit').modal('show');
    })

});