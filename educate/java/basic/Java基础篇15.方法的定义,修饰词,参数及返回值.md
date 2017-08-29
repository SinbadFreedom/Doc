Java基础篇15.方法的定义,修饰词,参数及返回值
---

##程序入口是什么

##方法修饰词:public
	修饰词来表名访问权限.学习初期都采用`public`,跳过其他修饰词.学完继承之后再来学习protected,private等.
	
	public 任何类均可以访问.
	protected 同目录的任何类,及有继承关系的类可以访问.可以省略.
	private 只有当前类可以访问.
	
	修饰词和作用域的关系表:

		作用域       当前类    同一package   子孙类     其他package 
        public        √          √             √           √ 
        protected     √          √             √           × 
        friendly      √          √             ×           × 
        private       √          ×             ×           ×	

##方法修饰词:static
静态方法,属于类本身.

##方法返回词:void
表示没有返回值.

##main方法参数:String[] args

##本讲完成

