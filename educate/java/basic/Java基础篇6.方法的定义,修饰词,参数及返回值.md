Java基础篇7.方法的定义,修饰词,参数及返回值
---

##程序入口是什么

##方法修饰词:public
	修饰词来表名访问权限.
	
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

##方法返回词:void

##main方法参数:String[] args

##不要继续纠结
main方法是固定的写法,就像1+1=2,现在需要先记住这些.不要花时间纠结.   
继续行动, 后续会有详细的介绍.   

##本讲完成
