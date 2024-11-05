
$(document).ready(function () {
    // Listen for changes in the product select
    $('#productSelect').on('change', function () {
        updateSelectedProductsTable(this);
    });
    // Listen for remove row button click
    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });
    // this is for not displaying select value in multiselect and show in table  
    $(document).on('click', '.removeRow', function () {
        const row = $(this).closest('tr');
        const productID = row.find('td:first-child')
            .text();
        const selectElement = $(
            '#productSelect');
        const selectedProductIDs = selectElement.val() || [];
        const updatedProductIDs = selectedProductIDs.filter(id => id !==
            productID);
        selectElement.val(updatedProductIDs);
        row.remove();
    });
    $('#submitBtn').on('click', function (event) {
        event.preventDefault();
        // Custom validation
        const supplier = $('#supplier_id').val();
        const warehouse = $('#warehouse_id').val();
        const purchase_date = $('#purchase_date').val();
        if (!validateField(supplier, 'supplier_error')) return;
        if (!validateField(warehouse, 'warehouse_error')) return;
        if (!validateField(purchase_date, 'purchase_error')) return;
        // end 
        const formData = new FormData($('#purchase-add-form')[0]);
        const tableData = getTableData();
        formData.append('tableData', JSON.stringify(tableData));
        sendDataToController(formData);

    });
    // Function for validation 
    function validateField(value, errorElementId) {
        if (!value) {
            $('#' + errorElementId).show();
            return false;
        } else {
            $('#' + errorElementId).hide();
            return true;
        }
    }
    function getTableData() {
        const tableData = [];
        $('#selectedProductsTable tbody tr').each(function () {
            const productID = $(this).find('td:first-child').text();
            const productName = $(this).find('td:nth-child(2)').text();
            const productCode = $(this).find('td:nth-child(3)').text();
            const productUnitCost = $(this).find('td:nth-child(4)').text();
            const purchaseUnitName = $(this).find('td:nth-child(5)').text();
            const purchaseUnitId = $(this).find('td:nth-child(6)').text();
            const quantity = $(this).find('td:nth-child(7) input').val();
            const alertQuantity = $(this).find('td:nth-child(8)').val();
            const taxID = $(this).find('td:nth-child(9) select').val();
            const discount = $(this).find('td:nth-child(10) input').val();
            const shippingCost = $(this).find('td:nth-child(11) input').val();
            const rowData = {
                productID: productID,
                unitCost: productUnitCost,
                shippingCost: shippingCost,
                purchaseUnitName: purchaseUnitName,
                purchaseUnitId: purchaseUnitId,
                quantity: quantity,
                taxID: taxID,
                discount: discount,
            };
            tableData.push(rowData);
        });
        return tableData;
    }
    function sendDataToController(formData) {
        $.ajax({
            url: $('#purchase-add-form').attr('action'),
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#purchase-add-form')[0].reset();
                $('#selectedProductsTable tbody').empty();
                location.reload();
                toastr.success('Purchases have been added successfully');
                // $('#productSelect').val(null).trigger('change');
      
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    const errorMessage = xhr.responseJSON.error;
                    toastr.error(errorMessage);
                } else {
                    toastr.error('An error occurred: ' + error);
                }
            }
        });
    }
});
