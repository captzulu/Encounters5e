var revealAnchors = {
    init: function () {
        $(".condition").on("click", function () {
            $(this).addClass("openAnchor");
        });
        $(".reveal").on("closed.zf.reveal", function () {
            var id = $(this).attr("id");
            var anchor = $(".condition[data-open='" + id + "']");
            anchor.focus().removeClass("openAnchor");
        })
    }
};
$(function () {
    revealAnchors.init();
});


