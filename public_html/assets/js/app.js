notif = {
    showNotification: () => {
        color = 'primary';

        $.notify({
            icon: "nc-icon nc-bell-55",
            message: "Welcome to <b>Paper Dashboard</b> - a beautiful bootstrap dashboard for every web developer."

        }, {
            type: color,
            timer: 8000,
            placement: {
            from: "bottom",
            align: "right"
            }
        });
    }
}