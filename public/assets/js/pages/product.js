$(document).ready(function() {
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: productUrl,
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
                data: 'price', 
                name: 'price',
                render: function(data, type, row) {
                    return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                }
            },
            { data: 'stock', name: 'stock' },
            { 
                data: 'is_active', 
                name: 'status',
                render: function(data, type, row) {
                    if (data == 1) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }
                }
            }
            ,
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}" onclick="editProduct(${row.id})" data-bs-toggle="modal" data-bs-target="#product-update">
                            <i class="ti ti-pencil"></i>
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}" onclick="deleteProduct(${row.id},'${row.name}')">
                            <i class="ti ti-trash"></i>
                            Delete
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']]
    });

    new AutoNumeric('#price', {
        currencySymbol: 'Rp ',
        decimalPlaces: 2,
        digitGroupSeparator: '.',
        decimalCharacter: ',',
        currencySymbolPlacement: 'p', // 'p' for prefix, 's' for suffix
    });
});

function formSubmit() {
    const form = $("#product-create-form");
    const price = AutoNumeric.getNumber('#price');
    form.find('input[name="price"]').val(price);
    const formData = form.serialize();
    const token = localStorage.getItem('auth_token');

    $.ajax({
        url: productCreateUrl,
        type: 'POST',
        data: formData,
        beforeSend: function(xhr) {
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#product-table').DataTable().ajax.reload();
            $('#product-create').modal('hide');
            Swal.fire({
                title: 'Success!',
                text: 'Product saved successfully!',
                icon: 'success'
            });
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to save product: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function formUpdateSubmit() {
    const form = $("#product-update-form");
    const price = AutoNumeric.getNumber('#update-price');
    form.find('input[name="price"]').val(price);
    const formData = form.serialize();
    const token = localStorage.getItem('auth_token');
    const id = form.find('input[name="id"]').val();

    $.ajax({
        url: productUpdateUrl.replace(':id', id),
        type: 'PUT',
        data: formData,
        beforeSend: function(xhr) {
            $('#product-update-loading').removeClass('d-none');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#product-table').DataTable().ajax.reload();
            $('#product-update').modal('hide');
            $('#product-update-loading').addClass('d-none');
            Swal.fire({
                title: 'Success!',
                text: 'Product updated successfully!',
                icon: 'success'
            });
        },
        error: function(xhr) {
            $('#product-update-loading').addClass('d-none');
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update product: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function editProduct(id) {
    const token = localStorage.getItem('auth_token');
    $.ajax({
        url: productReadUrl.replace(':id', id),
        type: 'GET',
        beforeSend: function(xhr) {
            $('#product-update-loading').removeClass('d-none');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#product-update-loading').addClass('d-none');
            const data = response.data;
            $('#product-update').modal('show');
            $('#product-update-form').find('input[name="id"]').val(data.id);
            $('#product-update-form').find('input[name="name"]').val(data.name);
            $('#product-update-form').find('input[name="price"]').val(data.price);
            $('#product-update-form').find('input[name="stock"]').val(data.stock);
            $('#product-update-form').find('input[name="is_active"]').prop('checked', data.is_active == 1);
            $('#update-isActiveLabel').text(data.is_active ? 'Active' : 'Inactive');
            new AutoNumeric('#update-price', {
                currencySymbol: 'Rp ',
                decimalPlaces: 2,
                digitGroupSeparator: '.',
                decimalCharacter: ',',
                currencySymbolPlacement: 'p', // 'p' for prefix, 's' for suffix
            });
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load product data: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
}

function deleteProduct(id,name) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Product ' + name + ' will be deleted permanently.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const token = localStorage.getItem('auth_token');
            $.ajax({
                url: productDeleteUrl.replace(':id', id),
                type: 'DELETE',
                beforeSend: function(xhr) {
                    if (token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    }
                },
                success: function(response) {
                    $('#product-table').DataTable().ajax.reload();
                    Swal.fire(
                        'Deleted!',
                        'Your product has been deleted.',
                        'success'
                    );
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete product: ' + xhr.responseText,
                        icon: 'error'
                    });
                }
            });
        }
    });
}