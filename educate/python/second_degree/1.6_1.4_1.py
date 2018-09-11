# CalRunTime.py 2
import time
limit = 10000000
start = time.perf_counter()
while limit > 0:
    limit -= 1

delta = time.perf_counter() - start
print("程序运行时间是:{}秒".format(delta))
