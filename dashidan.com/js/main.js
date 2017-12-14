"use strict";

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

/** 点击左边导航标题*/
function clickTitle(name) {
    let titleId = "#" + name + "_title";
    let titleName = $(titleId).text();

    if ($("#" + name).hasClass("dsd_catalog_left_hide")) {
        /** 隐藏状态切换到显示*/
        $("#" + name).removeClass("dsd_catalog_left_hide");
        $("#" + name).addClass("dsd_catalog_left_show");
        if (titleName.startsWith("➕")) {
            titleName = titleName.substring(1);
        }
        titleName = "➖" + titleName;
    } else {
        /** 显示状态切换到隐藏*/
        $("#" + name).removeClass("dsd_catalog_left_show");
        $("#" + name).addClass("dsd_catalog_left_hide");
        if (titleName.startsWith("➖")) {
            titleName = titleName.substring(1);
        }
        titleName = "➕" + titleName;
    }

    /** 修改标题内容 ➕ 改为 ➖ */
    $(titleId).text(titleName);
}

/** 文章对应左侧索引高亮*/
function showLeftHighlight() {
    /**
     * main.js:59 第0个为空
     * main.js:59 article
     * main.js:59 java
     * main.js:59 basic
     * main.js:59 %E6%90%AD%E5%BB%BAJava%E5%BC%80%E5%8F%91%E7%8E%AF%E5%A2%83.html
     */
    let idName = window.location.pathname.split("/")[3];
    /** 取？ 前边的完整链接*/
    let url = window.location.href.split("?")[0];

    /** 打开对应的左侧索引*/
    clickTitle(idName);
    /** 对应条目高亮*/
    $("#" + idName).children().each(function (index, element) {
        let html = $(element).html();
        let html1 = $(html).attr('href');
        if (url == encodeURI(html1)) {
            /** 高亮*/
            $(this).addClass("dsd_callout");
        }
    });

    /** 去掉 id=""显示*/
    $("#" + idName).removeClass("dsd_catalog_left_hide")
}

/** 加载后立即执行, 通过文章URL显示打开左侧边栏*/
showLeftHighlight();

