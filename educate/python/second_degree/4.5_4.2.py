import random
target = random.randint(1,1000)
count = 0
while True:
    try:        
        guess = eval(input("请输入一个猜的整数："))
    except:
        print("输入错误，不计入次数哦！")
        continue

    count = count + 1
    if guess > target:
        print("猜大了")
    elif guess < target:
        print("猜小了")
    else:
        print("猜对了")
        break
    
print("此轮的竞猜次数是：", count)
