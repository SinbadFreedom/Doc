#How to update version number of react native app


###You should be changing your versionCode and versionName in android/app/build.gradle:

	android {
	
	    defaultConfig {
	
	        versionCode 1
	        versionName "1.0"
	
	        {...}
	    }
	
	    {...}
	}
	


