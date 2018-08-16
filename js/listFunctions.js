var listJS = {
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
            var highCR = $("#highCR").val();
            list.filter(function (item) {
                if (item.values().challenge_rating_sort >= parseInt(lowCR) && item.values().challenge_rating_sort <= parseInt(highCR)) {
                    return true;
                } else {
                    return false;
                }
            });
        });

    },
    onMoveLowHandle: function () {

    },
    onMoveHighHandle: function () {

    }
};

