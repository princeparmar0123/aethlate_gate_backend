
    $('#alert_quantity').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#purchase_discount').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
     $('#discount').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#sell_price').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#cost_price').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#product_code').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

     $('#sell_discount').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#purchase_quantity').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#shipping_cost').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
  

    $('#parent-cat-add').validate({
        rules: {

            sale_unit_id: {
                required: true,
            },
            purchase_unit_id: {
                required: true,
            },
            sell_price: {
                required: true,
            },
            cost_price: {
                required: true,
            },
            sub_cat_id: {
                required: true,
            },
            parent_cat_id: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            code: {
                required: true,
            },
            barcode_symbology: {
                required: true,
            },
            name: {
                required: true,
            },

            alert_quantity: {
                required: true,
            },

            purchase_quantity: {
                required: true,
            },

            purchase_date: {
                required: true,
            },
            supplier_id: {
                required: true,
            },
            warehouse_id: {
                required: true,
            },
            main_unit_id: {
                required: true,
            },

        },
        messages: {
            main_unit_id: {
                required: "This  field is required",
            },
            sale_unit_id: {
                required: "This  field is required",
            },
            purchase_unit_id: {
                required: "This  field is required",
            },
            sell_price: {
                required: "This  field is required",
            },
            cost_price: {
                required: "This  field is required",
            },
            sub_cat_id: {
                required: "This  field is required",
            },
            parent_cat_id: {
                required: "This  field is required",
            },
            brand_id: {
                required: "This  field is required",
            },
            code: {
                required: "This  field is required",
            },
            barcode_symbology: {
                required: "This  field is required",
            },
            name: {
                required: "This  field is required",
            },
            alert_quantity: {
                required: "This  field is required",
            },

            purchase_quantity: {
                required: "This  field is required",
            },
            purchase_date: {
                required: "This  field is required",
            },
            supplier_id: {
                required: "This  field is required",
            },
            warehouse_id: {
                required: "This  field is required",
            },
        },
    });



    