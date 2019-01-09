const nameObjectArticle = "article";
const nameObjectCategory = "category";
const nameActionDelete = "delete";
const nameActionUpdate = "update";
var updateFieldOpen = false;

$(document).ready(function () {
    $(".table tbody").on("click", "#deleteCategory", function () {
        var currow = $(this).closest("tr");
        var id = currow.find("th:eq(0)").html().trim();
        callActionServices(id, nameActionDelete, nameObjectCategory);
    });

    $(".table tbody").on("click", "#deleteArticle", function () {
        var currow = $(this).closest("tr");
        var id = currow.find("th:eq(0)").html().trim();
        callActionServices(id, nameActionDelete, nameObjectArticle);
    });

    $(".table tbody").on("click", "#updateCategory", function () {
        var currow = $(this).closest("tr");
        var id = currow.find("th:eq(0)").html().trim();
        callActionServices(id, nameActionUpdate, nameObjectCategory);
    });

    $(".table tbody").on("click", "#updateArticle", function () {
        var currow = $(this).closest("tr");
        var id = currow.find("th:eq(0)").html().trim();
        callActionServices(id, nameActionUpdate, nameObjectArticle);
    });

});

function callActionServices(id, typeRequest, typeObject) {
    $.ajax({
        type: "POST",
        url: "/backoffice",
        data: {
            id: id,
            typeRequest: typeRequest,
            typeObject: typeObject,
        } 
    })
        .done(function () {

        })
        .fail(function () {

        });
}
