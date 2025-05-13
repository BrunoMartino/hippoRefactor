function toastSuccess(text) {
    Toastify({
        text: text,
        duration: 3000,
        close: true,
        avatar: URL_BASE + "/assets/images/svgs/circle-check.svg",
        style: {
            background: "#17d685",
        },
    }).showToast();
}

function toastDanger(text) {
    Toastify({
        text: text,
        duration: 3000,
        avatar: URL_BASE + "/assets/images/svgs/alert-triangle.svg",
        close: true,
        style: {
            background: "#f54e33",
        },
    }).showToast();
}

function toastWarning(text) {
    Toastify({
        text: text,
        duration: 3000,
        close: true,
        avatar: URL_BASE + "/assets/images/svgs/alert-circle.svg",
        style: {
            background: "#f5c033",
        },
    }).showToast();
}