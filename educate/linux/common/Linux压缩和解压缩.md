1 tar命令
===

打包:
```
tar zcvf FileName.tar.gz DirName
```
解包:
```
tar zxvf FileName.tar
```

2 gz命令
===

压缩:
```
gzip FileName
```
解压1:
```
gunzip FileName.gz
```
解压2:
```
gzip -d FileName.gz
```

3 .tar.gz 和 .tgz
===

压缩:
```
tar zcvf FileName.tar.gz DirName
```
压缩多个文件:
```
tar zcvf FileName.tar.gz DirName1 DirName2 DirName3 ...
```
解压:
```
tar zxvf FileName.tar.gz
```

4 bz2命令
===

压缩:
```
bzip2 -z FileName
```
解压1:
```
bzip2 -d FileName.bz2
```
解压2:
```
bunzip2 FileName.bz2
```

5 .tar.bz2
===

压缩:
```
tar jcvf FileName.tar.bz2 DirName
```
解压:
```
tar jxvf FileName.tar.bz2
```

6 bz命令
===

解压1:
```
bzip2 -d FileName.bz
```
解压2:
```
bunzip2 FileName.bz
```

7 .tar.bz
===

解压:
```
tar jxvf FileName.tar.bz
```
8 Z命令
===

压缩:
```
compress FileName
```
解压:
```
uncompress FileName.Z
```

9 .tar.Z
===

压缩:
```
tar Zcvf FileName.tar.Z DirName
```
解压:
```
tar Zxvf FileName.tar.Z
```

10 zip命令
===

压缩:
```
zip FileName.zip DirName
```
解压:
```
unzip FileName.zip
```