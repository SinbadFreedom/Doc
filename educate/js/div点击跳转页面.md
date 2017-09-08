在对应的`div`标签中加上`onclick`事件侦听,通过javascript跳转页面.

跳转页面有2种打开方式:
1. 在新窗口弹出页面.
```javascript
    window.open(url);
```	
2. 在当前窗口打开页面.
```javascript
    window.location.href = url;
```
示例代码:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>div点击跳转页面</title>
    <script type="application/javascript">
        /** 新窗口打开*/
        function openInNewWindow(url) {
            window.open(url);
        }
        /** 当前窗口打开*/
        function openInCurrentWindow(url) {
            window.location.href = url;
        }
    </script>
</head>
<body>

<div onclick="openInNewWindow('http://dashidan.com')">
    大屎蛋教程网<br>
    dashidan.com<br>
    div点击跳转示例
</div>

</body>
</html>
```


