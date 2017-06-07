百行代码魔法实战(2)Python多文件整合
---

###前言   

遇到一大批文件需要按照目录整合为一个整体的文件, 手动整合了3个文件后，计算了一下时间，大概需要1个星期.所以需要一个小程序来解决这个问题，解放我的时间.   
That’s cool man!   


###分析可行性：   
Python小巧灵活，适合做这种简单的工具.       

###佐料：   
Python   


###步骤：  


##1. 下载Python2.7版本

[python 2.7版本官方下载链接](https://www.python.org/ftp/python/2.7.13/python-2.7.13.msi)
   
windows对3.0以上的版本部分功能不兼容，推荐2.7版


##2. 安装Python

点击下一步，一路向西去大理.

##3. 配置环境变量

我的电脑-右键-属性-高级系统设置-环境变量-系统变量-选中变量"Path"-编辑-将python的安装目录前面加个分号例`;D:\Python27\`加在最后。
确定.

测试：
运行命令提示符输入
	
	python

显示python版本号和`>>>`为成功.
##4. 准备需要整合的文件

	//TODO 写测试数据
##5. 编码
**ConnectFile.py**

	import os
	
	rootFolder = "D:\\workplace\\git\\node-api-cn\\"
	outFolder = "D:\\workplace\\git\\Doc\\NodejsDoc\\md\\"
	
	fileList = {}
	
	
	# get all files from the directory
	def getFiles(directory):
	    if os.path.isdir(directory):
	        for fileName in os.listdir(directory):
	            newDir = os.path.join(directory, fileName)
	            if os.path.isfile(newDir):
	                if fileName.find(".gitattributes") == -1 and fileName.find("README.md") == -1:
	                    fileList[directory].append(newDir)
	            elif os.path.isdir(newDir):
	                if newDir.find(".git") == -1:
	                    fileList[newDir] = []
	                    getFiles(newDir)
	
	
	getFiles(rootFolder)
	
	for folder, files in fileList.items():
	    print("Folder: ", folder)
	
	    folderNameArr = folder.split("\\")
	
	    newFileName = folderNameArr[len(folderNameArr) - 1]
	
	    newFile = open(outFolder + newFileName + ".md", 'w')
	
	    for fileName in files:
	        fileNameArr = fileName.split("\\")
	        newTitleName = fileNameArr[len(fileNameArr) - 1]
	
	        newFile.write('\n')
	        newFile.write("##" + newTitleName)
	        newFile.write('\n')
	        # read file
	        f = open(fileName, 'r')
	        allLines = []
	        useTab = False
	
	        for line in f:
	            # for code area start and end
	            if line.startswith("```"):
	                useTab = not useTab
	                allLines.append("\t\n")
	            else:
	                # for code content
	                if useTab:
	                    line = "    " + line
	                allLines.append(line)
	
	        newFile.writelines(allLines)
	        newFile.write('\n')


##5. 运行
将以上脚本保存为`ConnectFile.py`
打开命令行，输入
	
	python ConnectFile.py


# Well Done!    
That's cool!   
看到了最终的文件达到了我期望的效果，节省了大量的重复劳动的时间, 这一刻我被自己感动了.   

QA：
---

***为什么采用Python来实现？***   
答：

	Python语法简单，配置容易，写小工具代码量少

	
***Python还可以做什么？***   
答:

	Python是一个脚本型的语言.   
	在网络爬虫领域Python一直是独领风骚.有很多成熟的开源框架可以借鉴.   
	Python的网络特性也比较强，有公司采用Python做后端开发.   
   




