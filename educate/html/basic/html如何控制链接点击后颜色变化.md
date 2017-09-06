设置`a`标签的属性,可以控制链接点击后颜色变化,或者不变化.   
设置`link`和`visited`的颜色一样,颜色不变;设置不一样,颜色变化.

```css
a:link {color: blue}			/** 未被访问的链接颜色*/
a:visited {color: blue}			/** 已被访问过的链接颜色*/ 
a:hover {color: blue}			/** 鼠标悬停在链接上的颜色*/
a:active {color: blue}			/** 鼠标点中激活链接的颜色*/
```

也可以直接在`html`文档中设置`css`样式.
```html
<body>
<style>
a:hover,a:visited{color:#f000;}  
</style> 
<a href="">点击过后不变色</a>  
</body>
```