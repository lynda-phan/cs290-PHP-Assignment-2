document.addEventListener("DOMContentLoaded", function(event) {
    var categoryFilterElement = document.getElementById('category_selection');

    if (categoryFilterElement) {
        // https://developer.mozilla.org/en-US/docs/Web/API/Window.location
        var filterVideos = function filterVideos() {
            var category = this.value;
            location.replace('index.php?category=' + category);
        }

        categoryFilterElement.addEventListener('change', filterVideos, false);
    }

    // http://stackoverflow.com/questions/10462839/javascript-confirmation-dialog-on-href-link

    function addConfirmationEvents(className) {
        var confirmationElements = document.getElementsByClassName(className);

        for (var i = 0, l = confirmationElements.length; i < l; i++) {
            addConfirmationEvent(confirmationElements[i]);
        }
    }

    function addConfirmationEvent(element) {
        var confirmAlert = function (e) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
            }
        };

        element.addEventListener('click', confirmAlert, false);
    }

    addConfirmationEvents('confirmationAlert');
});