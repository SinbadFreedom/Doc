import turtle

turtle.pensize(1)

#三角形
turtle.penup()
turtle.goto(-200, -50)
turtle.pendown()
turtle.begin_fill()
turtle.color("red")
turtle.circle(40, steps=3) 
turtle.end_fill()


#四边形
turtle.penup()
turtle.goto(-100, -50)
turtle.pendown()
turtle.begin_fill()
turtle.color("blue")
turtle.circle(40, steps=4)
turtle.end_fill()

#五边形
turtle.penup()
turtle.goto(0, -50)
turtle.pendown()
turtle.begin_fill()
turtle.color("green")
turtle.circle(40, steps=5)
turtle.end_fill()

#五边形
turtle.penup()
turtle.goto(100, -50)
turtle.pendown()
turtle.begin_fill()
turtle.color("yellow")
turtle.circle(40, steps=6)
turtle.end_fill()

#圆形
turtle.penup()
turtle.goto(200, -50)
turtle.pendown()
turtle.begin_fill()
turtle.color("black")
turtle.circle(40)
turtle.end_fill()

#文字
turtle.penup()
turtle.goto(-100, 50)
turtle.pendown()
turtle.begin_fill()
turtle.color("purple")
turtle.write(("Colorful Shapes"), font=("Times", 18, "bold"))
turtle.end_fill()


turtle.hideturtle()

turtle.done()

