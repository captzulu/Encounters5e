var listJS = {
    sortingObj: null,
    init: function (id, arrayClasses) {
        var isMobile = $("[data-open='menuMobileReveal']:visible").length !== 0;
        var options = {
            valueNames: arrayClasses,
            page: isMobile ? 10 : 20,
            pagination: [{paginationClass: "pagination", outerWindow: 1, innerWindow: isMobile ? 0 : 1}, ]
        };

        var list = new List(id, options);
        return list;
    },
    listeners: function (slider, list) {
        $(slider).on("changed.zf.slider", function () {
            var lowCR = $("#lowCR").val();
            var highCR = $("#highCR").removeClass("small").val();
            if (highCR === "18") {
                $("#highCR").val("18+").addClass("small");
            }
            list.filter(function (item) {
                if (item.values().challenge_rating_sort >= parseInt(lowCR) && (item.values().challenge_rating_sort <= parseInt(highCR) || highCR === "18")) {
                    return true;
                } else {
                    return false;
                }
            });

        });
        list.on("filterStart", function () {
            $("[data-sort]").each(function (i, el) {
                if ($(el).hasClass("asc") || $(el).hasClass("desc")) {
                    listJS.sortingObj = {name: $(el).attr("data-sort"), order: ($(el).hasClass("asc") ? "asc" : "desc")};
                }
            });
        });
        list.on("filterComplete", function () {
            if (listJS.sortingObj !== null) {
                list.sort(listJS.sortingObj.name, {order: listJS.sortingObj.order});
            }
        });
    }
};

