const nameObjectArticle = "article";
const nameObjectCategory = "category";
const nameActionDelete = "delete";
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
            //TODO : display success
        })
        .fail(function () {
            //TODO : display error
        });
}
