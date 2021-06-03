$(function () {
    $('#searchForm').submit(function (e) {
        $submitButton = $('#searchSubmitButton');
        if ($submitButton.prop('disabled')) {
            return;
        }

        $submitButton.prop({'disabled': true});
        e.preventDefault();
        const apiPath = '/api.php';
        const searchEngineName = document.getElementById('searchEngine').value;
        const searchTerm = document.getElementById('searchTerm').value;

        if (!searchEngineName || !searchTerm) {
            return;
        }

        $.get(apiPath, {'se': searchEngineName, 's': searchTerm})
            .then(function (data) {
                $searchResults = $('#searchResults');
                $searchResults.text('');
                $.each(data, function (index, item) {
                    $itemHtml = `<li class="list-group-item"><b>${item.domain}:</b> ${item.count}</li>`;
                    $searchResults.append($itemHtml);
                })
                $searchResults.show();
            })
            .always(function() {
                $submitButton.prop({'disabled': false});
            });
    });
});