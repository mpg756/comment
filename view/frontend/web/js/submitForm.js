define([
    'jquery',
    'Magento_Customer/js/customer-data'
], function ($, customerData) {
    function processSubmit(config)
    {
        const postUrl = config.postUrl;
        const formId = config.formId;
        const productId = config.productId;
        const storeId = config.storeId;

        $(document).ready(function () {
            $(`#${formId}`).on('submit', function (event) {
                // Prevent the default form submission
                event.preventDefault();

                const formData = {
                    comment: {
                        name: $(`#${formId} #name`).val(),
                        email: $(`#${formId} #email`).val(),
                        product_id: productId,
                        message: $(`#${formId} #message`).val(),
                        store_id: storeId
                    }
                };

                $.ajax({
                    url: postUrl,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                }).done(function (data) {
                    $(`#${formId}`)[0].reset();
                    console.log('Request is send: ', data);
                }).fail(function (xhr, status, error) {
                    console.error('Error sending comment:', error);
                });
            });
        });
    }

    return function (config) {
        const customer = customerData.get('customer')();
        const formId = config.formId;
        if (customer.firstname) {
            $(`#${formId} #name`).val(`${customer.firstname} ${customer.lastname}`).prop('readonly', true);
            if (customer.email) {
                $(`#${formId} #email`).val(customer.email).prop('readonly', true);
            }
        }
        processSubmit(config);
    };
});
