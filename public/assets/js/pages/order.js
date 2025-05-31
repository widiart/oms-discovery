$(document).ready(function() {
    $.ajax({
        url: productUrl,
        type: 'GET',
        beforeSend: function (xhr) {
            const token = localStorage.getItem('auth_token');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            const $select = $('#order-product');
            $select.empty();
            if (response.data && Array.isArray(response.data)) {
                response.data.forEach(function(product) {
                    $select.append(
                        $('<option>', {
                            value: product.id,
                            text: product.name,
                            "data-price": product.price,
                            "data-custom-properties": `{"price": ${product.price}}`,
                        })
                    );
                });
            }
            setTimeout(updateOrderTotal(),300);
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load products: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });

    $.ajax({
        url: customerUrl,
        type: 'GET',
        beforeSend: function (xhr) {
            const token = localStorage.getItem('auth_token');
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            const $select = $('#order-customer');
            $select.empty();
            if (response.data && Array.isArray(response.data)) {
                response.data.forEach(function(customer) {
                    $select.append(
                        $('<option>', {
                            value: customer.id,
                            text: customer.name,
                            "data-price": customer.price,
                        })
                    );
                });
            }
            setTimeout(function() {
                new Choices('#order-customer', {
                    searchEnabled: true,
                    itemSelectText: '',
                    noResultsText: 'No customer found',
                    noChoicesText: 'No customer available',
                });
            }, 300);
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to load customer: ' + xhr.responseText,
                icon: 'error'
            });
        }
    });
    
    $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: orderUrl,
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
            { data: 'order_number', name: 'order_number' },
            { data: 'customer_name', name: 'customer' },
            { data: 'product_name', name: 'product' },
            { data: 'quantity', name: 'quantity' },
            { 
                data: 'total_price', 
                name: 'price',
                render: function(data, type, row) {
                    return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                }
            },
            { 
                data: 'order_date', 
                name: 'order_date',
                render: function(data) {
                    if (!data) return '';
                    const date = new Date(data);
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
            },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (row.status === 'completed') {
                        return `<span class="badge bg-success">Completed</span>`;
                    } else if (row.status === 'cancelled') {
                        return `<span class="badge bg-danger">Cancelled</span>`;
                    } else {
                        return `
                            <button class="btn btn-sm btn-success complete-btn" data-id="${row.id}" onclick="completeOrder(${row.id})">
                                <i class="ti ti-check"></i>
                                Complete
                            </button>
                            <button class="btn btn-sm btn-warning cancel-btn" data-id="${row.id}" onclick="cancelOrder(${row.id})">
                                <i class="ti ti-x"></i>
                                Cancel
                            </button>
                        `;
                    }
                }
            }
        ],
        order: [[6, 'desc']]
    });

    new AutoNumeric('#order-total', {
        currencySymbol: 'Rp ',
        decimalPlaces: 2,
        digitGroupSeparator: '.',
        decimalCharacter: ',',
        currencySymbolPlacement: 'p', // 'p' for prefix, 's' for suffix
        unformatOnHover: false,
        unformatOnSubmit: true,
        modifyValueOnWheel: false,
        showOnlyNumbersOnFocus: false
    });
});

function formSubmit() {
    const form = $("#order-create-form");
    const price = AutoNumeric.getNumber('#order-total');
    form.find('input[name="price"]').val(price);
    const formData = form.serialize();
    const token = localStorage.getItem('auth_token');

    $.ajax({
        url: orderCreateUrl,
        type: 'POST',
        data: formData,
        beforeSend: function(xhr) {
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        },
        success: function(response) {
            $('#order-table').DataTable().ajax.reload();
            $('#order-create').modal('hide');
            Swal.fire({
                title: 'Success!',
                text: 'Order saved successfully!',
                icon: 'success'
            });
        },
        error: function(xhr) {
            let message = 'Failed to save order';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message += ': ' + xhr.responseJSON.message;
            } else if (xhr.responseText) {
                message += ': ' + xhr.responseText;
            }
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error'
            });
        }
    });
}

function updateOrderTotal(prefix = '') {
  let productSelect = document.getElementById(prefix ? `${prefix}-order-product` : 'order-product');
  let quantityInput = document.getElementById(prefix ? `${prefix}-order-quantity` : 'order-quantity');
  let totalInput = document.getElementById(prefix ? `${prefix}-order-total` : 'order-total');

  let selectedOption = productSelect.options[productSelect.selectedIndex];
  let price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
  let quantity = parseInt(quantityInput.value) || 1;
  let total = price * quantity;

  totalInput.value = isNaN(total) ? '' : total;
  
    new AutoNumeric(prefix ? `#${prefix}-order-total` : '#order-total', {
        currencySymbol: 'Rp ',
        decimalPlaces: 2,
        digitGroupSeparator: '.',
        decimalCharacter: ',',
        currencySymbolPlacement: 'p', // 'p' for prefix, 's' for suffix
        readOnly: true, // still allows display formatting
        unformatOnHover: false,
        unformatOnSubmit: true,
        modifyValueOnWheel: false,
        showOnlyNumbersOnFocus: false
    });
}

function completeOrder(id) {
    Swal.fire({
        title: 'Complete Order',
        text: 'Are you sure you want to complete this order?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, complete it!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: orderCompleteUrl.replace(':id', id),
                type: 'PUT',
                beforeSend: function(xhr) {
                    const token = localStorage.getItem('auth_token');
                    if (token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    }
                },
                success: function(response) {
                    $('#order-table').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order completed successfully!',
                        icon: 'success'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to complete order: ' + xhr.responseText,
                        icon: 'error'
                    });
                }
            });
        }
    });
}

function cancelOrder(id) {
    Swal.fire({
        title: 'Cancel Order',
        text: 'Are you sure you want to cancel this order?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, cancel it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: orderCancelUrl.replace(':id', id),
                type: 'PUT',
                beforeSend: function(xhr) {
                    const token = localStorage.getItem('auth_token');
                    if (token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    }
                },
                success: function(response) {
                    $('#order-table').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order cancelled successfully!',
                        icon: 'success'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to cancel order: ' + xhr.responseText,
                        icon: 'error'
                    });
                }
            });
        }
    });
}