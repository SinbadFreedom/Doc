<div class="jumbotron">
<p>overflow-y 网页中经常会有内容不足一屏的情况,这时页脚如果不做特殊处理的话,会跟随内容,移动到屏幕中部位置.这样效果不美观.
对于一个美观强迫症怎么能忍得了.我们需要简单的设置一下就可以让页脚在底部.</p>
</div>

1 页脚在页面底部根据页面内容长度自适应
===

内容不超过一屏, 页面自动填充,并且页脚在屏幕最下方. 内容超过一屏. 页脚在内容底部,跟随内容自适应高度.

```html
<html>
<title>大屎蛋教程网-页脚底部自适应</title>
<body style="min-height: 100%; background-color: antiquewhite">
 <div style="min-height: 100%">
 <div style="background-color: aqua">
 <scan></scan>
</div>
</div>
</body>
</html>
```