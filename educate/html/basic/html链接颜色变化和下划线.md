设置`a`标签的属性,可以控制链接点击后颜色变化,或者不变化.     
设置`link`和`visited`的颜色一样,颜色不变;设置不一样,颜色变化.     

网页中的连接样式css:
```css
/*默认链接样式*/
a {
    color: #000000;
    /*链接去掉下划线*/
    text-decoration: none;
}
/*鼠标悬停链接样式*/
a:hover {
    color: red;
    text-decoration: none;
}

/*点击过的链接样式*/
a:visited {
    color: #3c763d;
    text-decoration: none;
}
```

连接点击后不变色, 也可以`a`,`a:hover`, `a:visited`采用同样的样式:
```css
a {
    color: red;
    /*链接去掉下划线*/
    text-decoration: none;
}

a:hover,
a:visited {
    color: red;
    text-decoration: none;
}
```

测试代码:
```html
<body>
<style>
a {
    color: red;
    /*链接去掉下划线*/
    text-decoration: none;
}

a:hover,
a:visited {
    color: red;
    text-decoration: none;
}
</style> 
<a href="">点击链接后颜色不变</a>  
</body>
```