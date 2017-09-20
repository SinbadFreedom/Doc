linux��ʱ����crontab
===

<div class="jumbotron">
<p>linux��crontab�����Ƕ�ʱ����, ������ʹ�����ڹ̶�ʱ���̶����ִ�г���.</p>  
</div>

1 ������ʽ
---

	�֡� ʱ	  ��   �¡� �ܡ� ���� 
	*����*����*����*����*����command 
	
��1�б�ʾ����1��59 ÿ������*���� */1��ʾ 
��2�б�ʾСʱ1��23(0��ʾ0��) 
��3�б�ʾ����1��31 
��4�б�ʾ�·�1��12 
��5�б�ʶ������0��6(0��ʾ������) 
��6��Ҫ���е����� 

* ����Ϊ`*`ʱ��ʾÿ��Ӧ��λ�õĵ�λ��Ҫִ�ж�Ӧ����
* ����Ϊ`a-b`ʱ��ʾ�ӵ�`a`���ӵ���`b`��ʱ�������ʱ����Ҫִ��
* ����Ϊ`*/n`ʱ��ʾÿ`n`��ʱ����ִ��һ��
* ����Ϊ`a, b, c,...`ʱ, ��ʾ�� a, b, c,... ��ʱ����Ҫִ��

2 ʹ�÷�ʽ
---
 
crontab file [-u user]-��ָ�����ļ����Ŀǰ��crontab. 
crontab-[-u user]-�ñ�׼�������Ŀǰ��crontab. 
crontab-1[user]-�г��û�Ŀǰ��crontab. 
crontab-e[user]-�༭�û�Ŀǰ��crontab. 
crontab-d[user]-ɾ���û�Ŀǰ��crontab. 
crontab-c dir- ָ��crontab��Ŀ¼. 
crontab�ļ��ĸ�ʽ��M H D m d cmd. 
M: ����(0-59). 
H��Сʱ(0-23). 
D����(1-31). 
m: ��(1-12). 
d: һ�����ڵ���(0~6,0Ϊ������). 
cmdҪ���еĳ���,��������shִ��,���shellֻ��USER,HOME,SHELL�������������� 

<div class="bs-callout bs-callout-info">
    <h4>crontab -u user</h4>
	<p>crontab -u user��ָ�趨ָ��user �Ķ�ʱ����,���ǰ���������Ҫ����Ȩ��(����˵��root)���ܹ�ָ�����˵Ķ�ʱ����. �����ʹ��`-u user` �Ļ�, ��ʾ�趨�Լ��Ķ�ʱ����.</p>
</div>

3 ��ʱ����ĸ�ʽ
---

	f1 f2 f3 f4 f5 program
	


4 crontab����ʾ�� 
---

###ÿ���21:30����nginx

	30 21 * * * service nginx restart 

###ÿ��1��10��22�յ�4 : 45����nginx

	45 4 1,10,22 * * service nginx restart 
	
###���������յ�1 : 10����nginx

	10 1 * * 6,0 service nginx restart 
	
###ÿ��18 : 00��23 : 00֮��ÿ��30��������nginx

	0,30 18-23 * * * service nginx restart 
	
###ÿ��������11 : 00 pm����nginx. 

	0 23 * * 6 service nginx restart 
	
###ÿһСʱ����nginx

	0 */1 * * * service nginx restart 


###����11�㵽����7��֮��,ÿ��һСʱ����nginx 

	0 11 4 * mon-wed service nginx restart 
	
###ÿ�µ�4����ÿ��һ��������11������nginx 

	0 4 1 jan * service nginx restart 
