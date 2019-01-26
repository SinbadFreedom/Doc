# MatchAnalyse.py
from random import random

def printIntro():
    print("这个程序模拟两个选手A和B的某种竞技比赛")
    print("程序运行需要A和B的能力值(以0到1之间的小数表示)")
          
def getInputs():
          a = eval(input("请输入选手A的能力值(0-1):"))
          b = eval(input("请输入选手B的能力值(0-1):"))
          n = eval(input("模拟比赛的次数"))
          return a, b, n

def simNGame(n, probA, proB):
    winA, winB = 0, 0
    for i in range(n):
        scoreA, scoreB = simOneGame(probA, proB)
        if scoreA > scoreB:
            winA += 1
        else:
            winB += 1
    return winA, winB

def gameOver(a, b):
          return a == 15 or b == 15


def simOneGame(proA, proB):
    scoreA, scoreB = 0, 0
    serving = "A"
    while not gameOver(scoreA, scoreB):
        if serving == "A":
            if random() < proA:
                scoreA += 1
            else:
                serving = "B"
        else:
            if random() < proB:
                socreB += 1
            else:
                serving = "A"
        return scoreA, scoreB

def printSummary(winsA, winsB):
          n = winsA + winsB
          print("竞技分析开始，共模拟{}场竞技比赛".format(n))
          print("选手A获胜{}场比赛，占比{:0.1%}".format(winsA, winsA/n))
          print("选手B获胜{}场比赛，占比{:0.1%}".format(winsB, winsB/n))

def main():
          printIntro()
          probA, probB, n = getInputs()
          winsA, winsB = simNGame(n, probA, probB)
          printSummary(winsA, winsB)


main()
          
