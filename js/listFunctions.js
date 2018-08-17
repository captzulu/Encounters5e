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
    listeners: function (slider, list, type) {
        $(slider).on("changed.zf.slider", function () {
            var low = $("#lowVal").val();
            var high = $("#highVal").removeClass("small").val();
            if (type === "monster") {
                if (high === "18") {
                    $("#highVal").val("18+").addClass("small");
                }
                list.filter(function (item) {
                    if (item.values().challenge_rating_sort >= parseInt(low) && (item.values().challenge_rating_sort <= parseInt(high) || high === "18")) {
                        return true;
                    } else {
                        return false;
                    }
                });
            } else {
                list.filter(function (item) {
                    if (item.values().level >= parseInt(low) && item.values().level <= parseInt(high)) {
                        return true;
                    } else {
                        return false;
                    }
                });
            }
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

