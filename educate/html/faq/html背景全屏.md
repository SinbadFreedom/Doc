网页内容不足一屏的时候, 文章背景全屏. 这样能使背景色占满整个屏幕看起来效果比较好.

解决方案:
将body设置高度设置为100%, 内部放置一个容器设置min-height:100%这样能充满整个页面.

示例代码:

```
<html>
<head>
<style>
html,body {
   margin:0;
   padding:0;
   height:100%;
   background-color: green;
}
.fullscreen {
   min-height: 100%;
   height: auto !important; 
   background-color: red;
}

</style>
</head>
<body>
    <div class="fullscreen"></div>
</body>
</html>
```