Android手机adb调试设置

说明:   
以华为手机G9为例,手机操作系统Android7.0


android环境变量设置    
---

1. 系统变量中添加    

	ANDROID_HOME	D:\down\SDK_android
	path中添加	%ANDROID_HOME%/platform-tools, %ANDROID_HOME%/tools目录
	
2. 输入adb测试    
    
	adb

	
手机设置    
---

1. 手机连接usb连接线，下滑屏幕，弹出列表中点击usb设置    
2. 选择设备文件管理（MTP）   
3. 设置功能中，选择开发者选项    
    
    开发者选项-开启    
    usb调试-开启    

测试
---
1. 手机从新连接usb    
2. 输入adb devices，如果有设备信息说明成功    

