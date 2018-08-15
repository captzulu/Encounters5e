var listJS = {
    init: function (id,arrayClasses) {
        var isMobile = $("[data-open='menuMobileReveal']:visible").length !== 0;
        var options = {
            valueNames: arrayClasses,
            page: isMobile ? 10 : 20,
            pagination: [{paginationClass: "pagination", outerWindow: 1, innerWindow: isMobile ? 0 : 1}, ]
        };

        var list = new List(id, options);
        return list;
    }
};

