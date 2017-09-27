    HashMap的功能是通过“键(key)”能够快速的找到“值”。下面我们分析下HashMap存数据的基本流程： 
    1、	当调用put(key,value)时，首先获取key的hashcode，int hash = key.hashCode(); 
    2、	再把hash通过一下运算得到一个int h. 
hash ^= (hash >>> 20) ^ (hash >>> 12); 
int h = hash ^ (hash >>> 7) ^ (hash >>> 4); 
为什么要经过这样的运算呢？这就是HashMap的高明之处。先看个例子，一个十进制数32768(二进制1000 0000 0000 0000)，经过上述公式运算之后的结果是35080(二进制1000 1001 0000 1000)。看出来了吗？或许这样还看不出什么，再举个数字61440(二进制1111 0000 0000 0000)，运算结果是65263(二进制1111 1110 1110 1111)，现在应该很明显了，它的目的是让“1”变的均匀一点，散列的本意就是要尽量均匀分布。

  3、	得到h之后，把h与HashMap的承载量（HashMap的默认承载量length是16，可以自动变长。在构造HashMap的时候也可以指定一个长 度。这个承载量就是上图所描述的数组的长度。）进行逻辑与运算，即 h & (length-1)，这样得到的结果就是一个比length小的正数，我们把这个值叫做index。其实这个index就是索引将要插入的值在数组中的 位置。第2步那个算法的意义就是希望能够得出均匀的index，这是HashTable的改进，HashTable中的算法只是把key的 hashcode与length相除取余，即hash % length，这样有可能会造成index分布不均匀。还有一点需要说明，HashMap的键可以为null，它的值是放在数组的第一个位置。

4、	我们用table[index]表示已经找到的元素需要存储的位置。先判断该位置上有没有元素（这个元素是HashMap内部定义的一个类Entity， 基本结构它包含三个类，key，value和指向下一个Entity的next）,没有的话就创建一个Entity<K,V>对象，在 table[index]位置上插入，这样插入结束；如果有的话，通过链表的遍历方式去逐个遍历，看看有没有已经存在的key，有的话用新的value替 换老的value；如果没有，则在table[index]插入该Entity，把原来在table[index]位置上的Entity赋值给新的 Entity的next，这样插入结束。