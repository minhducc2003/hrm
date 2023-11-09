// JavaScript Document
		  var mydate=new Date()   
		  var year=mydate.getYear()   
		  if (year < 1000)   
		  year+=1900   
		  var day=mydate.getDay()   
		  var month=mydate.getMonth()   
		  var daym=mydate.getDate()   
		  if (daym<10)   
		  daym="0"+daym   
		  var dayarray=new Array("Chủ nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy")   
		  var montharray=new Array("-1","-2","-3","-4","-5","-6","-7","-8","-9","-10","-11","-12")   
	  	  document.write(""+dayarray[day]+", Ngày "+daym+" "+montharray[month]+"-"+year+"")   
