$(document).ready(function () {
    $(".table tbody").on("click", ".btn", function () {
        var currow = $(this).closest("tr");
        var id = currow.find("th:eq(0)").html().trim();
        $.ajax({
            type: "POST",
            url: "/backoffice",
            data: {
                id: id,
            }
        })
            .done(function () {

            })
            .fail(function () {

            });
    });

});
