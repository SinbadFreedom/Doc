�ڹ��������о��������������̨��������������������ʱ��������Ҫ��һ��linux�������е��ļ����䵽��һ̨�������ϡ�����ļ�̫����߱������ٽ���ʱ���˷Ѻܶ�ʱ�䡣�������������ͨ��scp�����linux����䴫���ļ���

1 ͨ��ssh�����ļ�Դ������
===

�Ƽ�����Xshell��һ���ܷ����SSH���ߡ����ܺ�ǿ�󣬽���Ҳ�Ƚ����ۡ�

2 ͨ��pwd�鿴��Ҫ�����ļ���·��
==

����ͨ��cd���������Ҫ������ļ�Ŀ¼��Ȼ��ͨ��pwd����鿴��ǰĿ¼������·����

3 ͨ��scp������ļ������ļ���
===

3.1 scp�����ʽ�����ļ���(�����ļ��б���)
---

scp�����ʽ:

```
scp -r LOCAL_FOLDER NAME@IP:TARGET_FOLDER
```

����˵��:

- LOCAL_FOLDER �����ļ�Ŀ¼
- NAME ��½Ŀ����������û���
- TARGET_FOLDER Ŀ���������Ŀ¼��
- `-r` ��ʾ����Ŀ¼

ʾ��:

```
scp -r /home/dashidan.com/1.png root@1.2.3.4:/home/test
```

3.2 �����ļ����������ļ�(�������ļ��б���)
---

�����ʽ:

```
scp LOCAL_FOLDER NAME@IP:TARGET_FOLDER
```

�ȴ���Ŀ¼����-r. 

ʾ��:

```
scp /home/dashidan.com/* root@1.2.3.4:/home/test
```

3.3 �����ļ���������
---

�����ʽ:

```
scp LOCAL_FOLDER NAME@IP/FILE_NAME:TARGET_FOLDER/NEW_FILE_NAME
```

- LOCAL_FOLDER �����ļ�Ŀ¼
- NAME ��½Ŀ����������û���
- FILE_NAME �����ļ���
- TARGET_FOLDER Ŀ���������Ŀ¼��
- NEW_FILE_NAME �޸ĺ���ļ���

ʾ��:

```
scp /home/dashidan.com/1.txt root@1.2.3.4:/home/test/2.txt
```

4 ȷ�Ͽ�ʼ����
===

����scp������س��󣬻���ʾ"Are you sure you want to continue connecting (yes/no)? ".

����yes��ʼ���䡣

5 ����Ŀ�����������
===

����һ��������ʾ����Ŀ����������롣

6 �������
===

����̨���������״̬��������ɻ᷵�������С�