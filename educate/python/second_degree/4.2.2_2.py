# 判断用户输入的数字的特定
s = eval(input("请输入一个数字："))
token = "" if s % 3 == 0 and s % 5 == 0 else "不"
print("这个数字{}能被3和5同时整除".format(token))
