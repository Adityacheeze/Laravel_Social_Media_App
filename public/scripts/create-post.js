$(document).ready(function () {
    $(".create-post").click(function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        $.ajax({
            type: "POST",
            url: routes.createPost,
            data: form.serialize(),
            success: function (response) {
                const toastE2 = document.getElementById("createPostToast");
                const toast = new bootstrap.Toast(toastE2, {
                    delay: 3000,
                });
                toast.show();
                setTimeout(function () {
                    window.location.href = routes.feedPage;
                }, 1500);
            },
            error: function (xhr) {
                $(".create-post")
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
