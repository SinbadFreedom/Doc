n = 2    #n 是全局变量
def multiply(x, y=100):
    n = x * y    #此处n不是全局变量
    return  n

s = multiply(99, 1)
print(s)
print(n) # 不改变外部全局变量的值
