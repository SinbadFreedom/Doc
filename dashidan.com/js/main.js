/** 新窗口打开*/
function openInNewWindow(url) {
    window.open(url);
}
/** 当前窗口打开*/
function openInCurrentWindow(url) {
    window.location.href = url;
}

/** 小屏幕显示目录*/
function showIndex() {
    $("#xs_index").removeClass("hidden-xs");
    $("#xs_content").addClass("hidden-xs");
    $("#sx_index_button").removeClass("visible-xs-block");
    $("#sx_index_button").addClass("hidden-xs");
}

function hideIndex() {
    $("#xs_index").addClass("hidden-xs");
    $("#xs_content").removeClass("hidden-xs");
    $("#sx_index_button").removeClass("hidden-xs");
    $("#sx_index_button").addClass("visible-xs-block");
}
