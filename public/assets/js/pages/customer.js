$(document).ready(function() {
    $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: customerUrl,
            type: 'GET',
            beforeSend: function (xhr) {
                const token = localStorage.getItem('auth_token');
                if (token) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                }
            },
            dataSrc: function(json) {
                $('#loading-row').hide();
                return json.data;
            }
        },  
        columns: [
            { 
                data: null,
                name: 'row_number',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            { 
                data: 'email', 
                name: 'email'
            },
            { data: 'phone', name: 'phone' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}" onclick="editCustomer(${row.id})" data-bs-toggle="modal" data-bs-target="#customer-update">
                            <i class="ti ti-pencil"></i>
                            Edit
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']]
    });
});

function formSubmit() {
    const form = $("#customer-create-form");
    const formData = form.serialize();
    const token = localStorage.getItem('auth_token');

    $.ajax({
        url: customerCreateUrl,
        type: 'POST',
        data: formData,
        beforeSend: function(xhr) {
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#customer-table').DataTable().ajax.reload();
            $('#customer-create').modal('hide');
            Swal.fire({
                title: 'Success!',
                text: 'Customer saved successfully!',
                icon: 'success'
            });
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to save customer: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function formUpdateSubmit() {
    const form = $("#customer-update-form");
    const formData = form.serialize();
    const token = localStorage.getItem('auth_token');
    const id = form.find('input[name="id"]').val();

    $.ajax({
        url: customerUpdateUrl.replace(':id', id),
        type: 'PUT',
        data: formData,
        beforeSend: function(xhr) {
            $('#customer-update-loading').removeClass('d-none');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#customer-table').DataTable().ajax.reload();
            $('#customer-update').modal('hide');
            $('#customer-update-loading').addClass('d-none');
            Swal.fire({
                title: 'Success!',
                text: 'Customer updated successfully!',
                icon: 'success'
            });
        },
        error: function(xhr) {
            $('#customer-update-loading').addClass('d-none');
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update customer: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function editCustomer(id) {
    const token = localStorage.getItem('auth_token');
    $.ajax({
        url: customerReadUrl.replace(':id', id),
        type: 'GET',
        beforeSend: function(xhr) {
            $('#customer-update-loading').removeClass('d-none');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#customer-update-loading').addClass('d-none');
            const data = response.data;
            $('#customer-update').modal('show');
            $('#customer-update-form').find('input[name="id"]').val(data.id);
            $('#customer-update-form').find('input[name="name"]').val(data.name);
            $('#customer-update-form').find('input[name="email"]').val(data.email);
            $('#customer-update-form').find('input[name="phone"]').val(data.phone);
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load customer data: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function deleteCustomer(id, name) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Customer ' + name + ' will be deleted permanently.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const token = localStorage.getItem('auth_token');
            $.ajax({
                url: customerDeleteUrl.replace(':id', id),
                type: 'DELETE',
                beforeSend: function(xhr) {
                    if (token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    }
                },
                success: function(response) {
                    $('#customer-table').DataTable().ajax.reload();
                    Swal.fire(
                        'Deleted!',
                        'Your customer has been deleted.',
                        'success'
                    );
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete customer: ' + xhr.responseText,
                        icon: 'error'
                    });
                }
            });
        }
    });
}
