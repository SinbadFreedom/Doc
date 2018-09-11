#将百分制成绩转换为五分制成绩
score = eval(input("请输入一个百分制成绩："))
if score >= 60:
    grade = "D"
elif score >= 70:
    grade = "C"
elif score >= 80:
    grade = "B"
elif score >= 90:
    grade = "A"
else:
    grade = "E"

print("对应的5分制成绩是{}".format(grade))
