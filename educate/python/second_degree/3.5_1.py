n = input("请输入一个数字或字符串：")
inputType = type(n)
print(inputType)

if type(n) == type(1111):
    print("输入的数字是整数")
elif type(n) == type(1.1):
    print("输入的数字是浮点数")
else:
    print("无法判断输入类型")