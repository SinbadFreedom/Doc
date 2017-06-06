百行代码魔法实战React-native(1)手机版网站实现
---

###前言   

开始冒出这个想法，感觉这是个很酷。   
That’s cool man!   


###分析可行性：   
采用React-native框架，结合WebView显示,这个菜可以搞定。   


###佐料：   
React-native   


###步骤：   

##1. 搭建开发环境   

	参考文章:	
	`http://reactnative.cn/docs/0.44/getting-started.html#content`	
	
##2. 初始化React-native项目

	react-native init PythonDocApp   


##3. 编码

替换index.android.js

	import React, {Component} from 'react';
	import {
	    AppRegistry,
	    WebView,
	    StatusBar,
	    StyleSheet,
	    View,
	    BackHandler
	} from 'react-native';
	
	const styles = StyleSheet.create({
	                                     container: {
	                                         flex: 1,
	                                         backgroundColor: '#1FB9FF',
	                                         borderWidth: 0
	                                     },
	                                 });
	
	const WEB_VIEW_REF = "webView";
	
	class PythonDocApp extends Component {
	
	    componentDidMount() {
	        BackHandler.addEventListener('hardwareBackPress', this.backHandler);
	    }
	
	    componentWillUnmount() {
	        BackHandler.removeEventListener('hardwareBackPress', this.backHandler);
	    }
	
	    backHandler = () => {
	        this.refs[WEB_VIEW_REF].goBack();
	        return true;
	    };
	
	    render() {
	        return (
	            <View style={styles.container}>
	                <StatusBar hidden={true}></StatusBar>
	                <WebView
	                    ref={WEB_VIEW_REF}
	                    source={ {uri : 'http://139.59.45.254/html/'}}
	                />
	            </View>
	        );
	    }
	}
	
	AppRegistry.registerComponent('PythonDocApp', () => PythonDocApp);
	
   
##4. 手机调试   

手机开启USB调试模式.连接到电脑上，进入项目根目录执行命令:

	cd PythonDocApp   
	react-native run-android   


# Well Done!    
That's cool!   



QA：
---

***React-native是什么?***   
答：

	React-natived是从facebook的另一个网页前段框架React基础上开发的手机端框架。自定了类似xml的标记语言JXL，封装了IOS和Android的系统组件.


***为什么采用React-native?***      
答:

	React-native 由facebook开发的一个开源框架，师出名门，技术热度高(github上评价5万星左右)，文档全，跨平台，更新快, 前景好.

***React-native好上手吗?***   
答:

	整体说来，上手难度中等. 了解JavaScript和html, 上手容易些. 如果没有接触过这些，可以花些时间了解下.

