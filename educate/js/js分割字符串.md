js split 的用法和定义 js split分割字符串成数组的实例代码

```javascript
<script language="javascript"> 
str="2,2,3,5,6,6"; //这是一字符串 
var strs= new Array(); //定义一数组 
strs=str.split(","); //字符分割 
for (i=0;i<strs.length ;i++ ) 
{ 
	document.write(strs[i]+"<br/>"); //分割后的字符输出 
} 
</script> 
```

