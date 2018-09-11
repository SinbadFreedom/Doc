n = 2    #n 是全局变量
def multiply(x, y=100):
    global n    #n 使用全局变量
    return  x * y * n

s = multiply(99, 2)
print(s)
