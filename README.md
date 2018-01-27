#Wall Timer 

![](https://img.shields.io/aur/license/yaourt.svg) 

#### Script run time measurement library
- support three languages for output text czech, english, german, russian
- include unit tests
- the option to set the output display
- include *autoload* class for non-use composer

###Default
-  language -> *english*
-  echo output -> *true*
-  time output -> *seconds*

###Usage

	  /* Init wall timer */
      $wallTimer = new WallTimer();
	  
	  /* Begin measuring */
	  $wallTimer->start()
	  
	  /* Script to be measured  */
	  sleep(2);
	  
	 /* End measuring */
      $wallTimer->end()

######Output: 
Your script running 2 seconds 

#####Result time of measuring
 	 // Time output in minutes
	 $wall->getTotalTime();

#####Change language
 	 // Set czech language
	 $wall->setOutputLanguage("cs");
- *ru*  - for russian
- *cs*  - for czech
- *en*  - for english

#####Result rounding

	 $wall->setOutputPrecision(10);

######Output: 
Your script running 2.0001149178 seconds 

#####Change time output
 	// Time output in minutes
	 $wall->setTimeOutput("m");
- *s*  - for seconds
- *m*  - for minutes
- *h*  - for hours

#####Turn off echo output
 	// Time output in minutes
	 $wall->setAllowEchoOutput(false);
