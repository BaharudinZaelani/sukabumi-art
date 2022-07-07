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

// get navbar
const navbar = document.getElementsByClassName("navbar")[0];
navbar.classList.remove("navbar-transparent");

// if navbar clicked show sidebar
const toggle = document.getElementsByClassName("navbar-toggle")[0];
const sidebar = document.getElementsByClassName("sidebar")[0];
toggle.addEventListener("click", () => {
    sidebar.classList.add("shadow-lg");
    sidebar.classList.toggle("show");
});