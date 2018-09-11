while True:
    s = input("请输入一个名字(按Q退出)：")
    if s == "Q":
        break       # 退出while循环

    for c in s:
        if c == "E":
            break       #退出for循环

        if c == "F":
            continue
        
        print(c, end= "")
        
print("程序退出")
   
