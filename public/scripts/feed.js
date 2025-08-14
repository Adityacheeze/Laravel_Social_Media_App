$(document).ready(function () {
    $(".hidePostBtn").click(function () {
        let selectedPosts = [];
        $(".hidePost:checked").each(function () {
            selectedPosts.push($(this).attr("id"));
        });
        $.ajax({
            type: "POST",
            url: routes.hidePost,
            data: {
                _token: tokens.csrfToken,
                post_ids: selectedPosts,
            },
            success: function (response) {
                const toastE1 = document.getElementById("hidePostToast");
                const toast = new bootstrap.Toast(toastE1, {
                    delay: 3000,
                });
                toast.show();
                setTimeout(function () {
                    location.reload();
                }, 1500);
            },
            error: function (xhr) {
                console.error(xhr);
            },
        });
    });
    $(".showhiddenPostBtn").click(function () {
        $(".hiddenPostContainer").toggleClass("d-none");
        $(".unhidePostBtn").toggleClass("d-none");
    });
    $(".unhidePostBtn").click(function () {
        let selectedPosts = [];
        $(".unhidePost:checked").each(function () {
            selectedPosts.push($(this).attr("id"));
        });
        $.ajax({
            type: "POST",
            url: routes.unhidePost,
            data: {
                _token: tokens.csrfToken,
                post_ids: selectedPosts,
            },
            success: function (response) {
                const toastE2 = document.getElementById("unhidePostToast");
                const toast = new bootstrap.Toast(toastE2, {
                    delay: 3000,
                });
                toast.show();
                setTimeout(function () {
                    location.reload();
                }, 1500);
            },
            error: function (xhr) {
                console.error(xhr);
            },
        });
    });
});
