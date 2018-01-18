<div class="jumbotron">
<p>overflow-y 网页中经常会有内容不足一屏的情况,这时页脚如果不做特殊处理的话,会跟随内容,移动到屏幕中部位置.这样效果不美观.
对于一个美观强迫症怎么能忍得了.我们需要简单的设置一下就可以让页脚在底部.</p>
</div>

1 页脚在页面底部
===

```html
html {
    height: 100%;
}

body {
    min-height: 100%;
    /* .footer 的高度，为 footer 占位 */
    padding-bottom: 80px;
}

.fullscreen {
    min-height: 100%;
    /** overflow-y属性很重要, 可以撑大内容显示区, 如果不设置这个显示不正常*/
    overflow-y: hidden;
}

footer {
    background-color: #666666;
    opacity: 0.8;
}
```

