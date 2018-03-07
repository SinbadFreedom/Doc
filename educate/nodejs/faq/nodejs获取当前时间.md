nodejs时间获取

http://blog.csdn.net/yiyanbuhe/article/details/78632704

标签： nodejs
2017年11月25日 16:37:26 673人阅读 评论(0) 收藏  举报
 分类： Python（11）   nodejs（6）  
nodejs支持多种格式转换为时间戳 然而我并不想要这个

var str1 = "2017-01-19 13:00:00";
var str2 = "Jan 19 2017 13:00:00";
var t1 = new Date(str1).getTime();
var t2 = new Date(str2).getTime();
console.log(t1);
console.log(t2);
1484802000000
1484802000000
1
2
3
4
5
6
7
8
var t1 = Date.now();
var t2 = new Date().getTime();
console.log(t1);
console.log(t2);
var myDate = new Date();
myDate.toLocaleString( ); //获取日期与时间
console.log(myDate);
myDate.toLocaleDateString(); //获取当前日期
console.log(myDate);
var mytime=myDate.toLocaleTimeString(); //获取当前时间
console.log(mytime);
1511598661956
1511598661956
2017-11-25T08:31:01.956Z
2017-11-25T08:31:01.956Z
16:31:01
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
最后用了很麻烦的方法，一个个获取

var date = new Date();
var year = date.getFullYear();
var month = date.getMonth()+1;
var day = date.getDate();
var hour = date.getHours();
var minute = date.getMinutes();
var second = date.getSeconds();
console.log(year+'年'+month+'月'+day+'日 '+hour+':'+minute+':'+second);
console.log(year+''+month+''+day+''+hour+''+minute+''+second);
2017年11月25日 16:31:1
2017112516311