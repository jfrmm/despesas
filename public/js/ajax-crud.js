//  AJAX CRUD operations
$(document).ready(function(){
    // add a new instance
    $(document).on('click', '.call-create-modal', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                $('div.modals').empty();
                $('div.modals').append(data);
                $('#create-modal').modal('show');
            }
        });
    });
    $('div.modals').on('click', '#create-modal .confirm', function(e) {
        e.preventDefault();
        $button = $(this);
        $button.prop('disabled', true);

        $modal = $button.closest('.modal');
        formData = $modal.find('form').serialize();

        $.ajax({
            type: 'POST',
            url: $button.data('url'),
            data: formData,
            success: function(data) {
                $modal.find('.modal-body .alert').remove();
                $modal.find('.form-group').removeClass('has-error');
                $modal.modal('hide');
                toastr.options.onHidden = function() { location.reload() }
                toastr.success(data.message, 'Sucesso');
            },
            error: function(data) {
                $modal.find('.modal-body .alert').remove();
                $modal.find('.modal-body').prepend('<div class="alert alert-danger">Erros nos dados:<ul></ul></div>');
                $modal.find('.form-group').removeClass('has-error');
                $.each(data.responseJSON, function(k, v) {
                    $modal.find('.modal-body .alert').append('<li>' + v + '</li>');
                    $modal.find('form input[name="' + k + '"]').closest('.form-group').addClass('has-error');
                });
                $button.prop('disabled', false);
            },
        });
    });



    // Show a post
    $(document).on('click', '.show-modal', function() {
        $('.modal-title').text('Show');
        $('#id_show').val($(this).data('id'));
        $('#title_show').val($(this).data('title'));
        $('#content_show').val($(this).data('content'));
        $('#showModal').modal('show');
    });



    // edit an instance
    $(document).on('click', '.call-edit-modal', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                $('div.modals').empty();
                $('div.modals').append(data);
                $('#edit-modal').modal('show');
            }
        });
    });
    $('div.modals').on('click', '#edit-modal .confirm', function(e) {
        e.preventDefault();
        $button = $(this);
        $button.prop('disabled', true);

        $modal = $button.closest('.modal');
        formData = $modal.find('form').serialize();

        $.ajax({
            type: 'PATCH',
            url: $button.data('url'),
            data: formData,
            success: function(data) {
                $modal.find('.modal-body .alert').remove();
                $modal.find('.form-group').removeClass('has-error');
                $modal.modal('hide');
                toastr.options.onHidden = function() { location.reload() }
                toastr.success(data.message, 'Sucesso');
            },
            error: function(data) {
                $modal.find('.modal-body .alert').remove();
                $modal.find('.modal-body').prepend('<div class="alert alert-danger">Erros nos dados:<ul></ul></div>');
                $modal.find('.form-group').removeClass('has-error');
                $.each(data.responseJSON, function(k, v) {
                    $modal.find('.modal-body .alert').append('<li>' + v + '</li>');
                    $modal.find('form input[name="' + k + '"]').closest('.form-group').addClass('has-error');
                });
                $button.prop('disabled', false);
            },
        });
    });

    // delete an instance
    $(document).on('click', '.call-delete-modal', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                $('div.modals').empty();
                $('div.modals').append(data);
                $('#delete-modal').modal('show');
            }
        });
    });
    $('div.modals').on('click', '#delete-modal .confirm', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'DELETE',
            url: $(this).data('url'),
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                $('.modal').modal('hide');
                toastr.options.onHidden = function() { location.reload() }
                if(data.result == 'success') {
                    toastr.success(data.message, 'Sucesso');
                } else if (data.result == 'error') {
                    toastr.error(data.message, 'Erro');
                } else if (data.result == 'warning') {
                    toastr.warning(data.message, 'Atenção');
                } else {
                    toastr.info(data.message, 'Informação');
                }
            }
        });
    });

});