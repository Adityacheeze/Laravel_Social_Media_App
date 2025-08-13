$(document).ready(function () {
    $(".show-user-info").click(function () {
        $.ajax({
            type: "GET",
            url: routes.showUserDetailsAPI,
            success: function (response) {
                let user_data = response.data;
                console.log(response.data);
                $(".response_div").empty();
                $(".close_user_info").removeClass("d-none");
                for (let key in user_data) {
                    $(".response_div").removeClass("d-none");
                    $(".response_div").append(
                        "<p><strong>" +
                            key +
                            ":</strong> " +
                            user_data[key] +
                            "</p>"
                    );
                }
            },
            error: function (xhr) {
                console.error("Error:", xhr);
            },
        });
    });
    $(".close_user_info").click(function () {
        $(".response_div").addClass("d-none");
        $(this).addClass("d-none");
    });
});

$(document).ready(function () {
    $(".edit-profile-btn").click(function () {
        $(".edit-profile").toggleClass("d-none");
    });
});

$(document).ready(function () {
    $(".delete_button").click(function () {
        const toastEl = document.getElementById("deleteToast");
        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000,
        });
        toast.show();
    });
});

$(document).ready(function () {
    $(".hide_btn").click(function () {
        $(this).closest(".card").hide("slow");
    });
    $(".show_post_btn").click(function () {
        $(".card").show("slow");
    });
    $(".hide_post_btn").click(function () {
        $(".card").hide("slow");
    });
});
