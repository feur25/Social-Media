
$.ajax(
    {
        url: '/src/util/connection-status.php',
        type: 'GET',
        async: false,
        success: function(userId) {
            if (userId == 'offline') {
                // Do something
            } else {
                // Do something else
            }
        }
    }
);