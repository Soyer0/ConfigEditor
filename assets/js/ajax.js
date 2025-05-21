function ajax(action, data, onSuccess, onError) {
    $.ajax({
        url: `index.php?action=${action}`,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error(`${action} AJAX error:`, error);
            if (typeof onError === 'function') {
                onError(error);
            }
        }
    });
}
