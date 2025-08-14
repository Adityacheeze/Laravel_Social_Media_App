$(document).ready(function () {
    $(".edit-post").click(function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        $.ajax({
            type: "POST",
            url: routes.editPost,
            data: form.serialize(),
            success: function () {
                const toastE3 = document.getElementById("editPostToast");
                const toast = new bootstrap.Toast(toastE3, {
                    delay: 3000,
                });
                toast.show();
                setTimeout(function () {
                    window.location.href = routes.homePage;
                }, 1500);
            },
            error: function (xhr) {
                $(".edit-post")
                    .closest("div")
                    .after(
                        `<p class="text-danger mt-2 err-msg">Error Occured : ${xhr?.responseJSON?.message}</p>`
                    );
                setTimeout(function () {
                    $(".err-msg").remove();
                }, 2000);
                console.log("Error:", xhr);
            },
        });
    });
});
