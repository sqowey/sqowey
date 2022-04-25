function change_theme(theme) {

    // Run the php script to change the settings in the database
    $.ajax({
        url: './scripts/setappearance.php',
        type: 'POST',
        data: {
            theme: theme
        },
        success: function(data) {
            console.log(data);
        }
    });

    switch (theme) {
        case 0:

            localStorage.setItem("theme", "dark");
            break;

        case 1:

            localStorage.setItem("theme", "light");
            break;
    }
}