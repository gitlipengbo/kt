
//组合个数
function Combination(n,m)
{
	var n1=1, n2=1;
	for (var i=n,j=1; j<=m; n1*=i--,n2*=j++);
	return n1/n2;
}
function FormatNum(obj)
{
	$(obj).val($(obj).val().replace(/[^\d]/g,''));
}
//生成一个min到max的随机整数
function GetRndNum(min,max)
{
	return Math.round((max-min)*Math.random()+min);
}

//获取后缀
function GetSuffix(file,suffixlist){
    var extend = file.substring(file.lastIndexOf(".")+1);
    return extend;
}
//获取文件名
function GetFileName(file){
    var extend = file.substring(file.lastIndexOf("\\")+1);
    return extend;
}
//验证文件后缀
function IsValiDateFile(file,suffixlist){
    var extend = file.substring(file.lastIndexOf(".")+1);
    if(extend==""){return false;}
	else
	{
		var extend = extend.toLowerCase();
		var arr = suffixlist.split("|")
		var rt = false;
		for(var i=0; i< arr.length;i++)
		{
			arr[i] = arr[i].toLowerCase();
			if(arr[i] ==extend)
			{
				rt = true;
				break;
			}
		}
		return rt;
    }
}



//JS 货币格式化
function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	{
		num = "0";
	}
	var sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	var cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	{
		cents = "0" + cents;
	}
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	{
		num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
	}
	return (((sign)?'':'-') + '￥' + num + '.' + cents);
}

function formatCurrency2(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	{
		num = "0";
	}
	var sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	var cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	{
		cents = "0" + cents;
	}
	return (((sign)?'':'-') + num + '.' + cents);
}

//转换大写 
Number.prototype.toMoney = function() 
{ 
	var MAXIMUM_NUMBER = 99999999999.99; 
		
 	var CN_ZERO= "零"; 
 	var CN_ONE= "壹"; 
 	var CN_TWO= "贰"; 
 	var CN_THREE= "叁"; 
 	var CN_FOUR= "肆"; 
	var CN_FIVE= "伍"; 
 	var CN_SIX= "陆"; 
 	var CN_SEVEN= "柒"; 
 	var CN_EIGHT= "捌"; 
 	var CN_NINE= "玖"; 
 	var CN_TEN= "拾"; 
 	var CN_HUNDRED= "佰"; 
 	var CN_THOUSAND = "仟"; 
 	var CN_TEN_THOUSAND= "万"; 
	var CN_HUNDRED_MILLION= "亿"; 
 	var CN_SYMBOL= ""; 
 	var CN_DOLLAR= "元"; 
 	var CN_TEN_CENT = "角"; 
 	var CN_CENT= "分"; 
 	var CN_INTEGER= "整"; 
 
	// Variables: 
	var integral; // Represent integral part of digit number. 
	var decimal; // Represent decimal part of digit number. 
	 var outputCharacters; // The output result. 
	var parts; 
	var digits, radices, bigRadices, decimals; 
	var zeroCount; 
	var i, p, d; 
	var quotient, modulus; 
 
	if (this > MAXIMUM_NUMBER) 
	{ 
		return ""; 
	} 
 
	// Process the coversion from currency digits to characters: 
	// Separate integral and decimal parts before processing coversion: 

	parts = (this + "").split("."); 
	if (parts.length > 1) 
	{ 
		integral = parts[0]; 
		decimal = parts[1]; 
		// Cut down redundant decimal digits that are after the second. 
		decimal = decimal.substr(0, 2); 
	} 
	else 
	{ 
		integral = parts[0]; 
		decimal = ""; 
	} 
	// Prepare the characters corresponding to the digits: 
	digits= new Array(CN_ZERO, CN_ONE, CN_TWO, CN_THREE, CN_FOUR, CN_FIVE, CN_SIX, CN_SEVEN, CN_EIGHT, CN_NINE); 
	radices= new Array("", CN_TEN, CN_HUNDRED, CN_THOUSAND); 
	bigRadices= new Array("", CN_TEN_THOUSAND, CN_HUNDRED_MILLION); 
	decimals= new Array(CN_TEN_CENT, CN_CENT); 
	 
	 
	 // Start processing: 
	outputCharacters = ""; 
	// Process integral part if it is larger than 0: 
	if (Number(integral) > 0) 
	{ 
		zeroCount = 0; 
		for (i = 0; i < integral.length; i++) 
		{ 
			p = integral.length - i - 1; 
			d = integral.substr(i, 1); 
			quotient = p / 4; 
			modulus = p % 4; 
			if (d == "0") 
			{ 
				zeroCount++; 
			} 
			else 
			{ 
				if (zeroCount > 0) 
				{ 
					outputCharacters += digits[0]; 
				} 
				zeroCount = 0; 
				outputCharacters += digits[Number(d)] + radices[modulus]; 
			} 
			if (modulus == 0 && zeroCount < 4) 
			{ 
				outputCharacters += bigRadices[quotient]; 
			} 
		} 
		outputCharacters += CN_DOLLAR; 
	} 
	// Process decimal part if there is: 
	if (decimal != "") 
	{ 
		for (i = 0; i < decimal.length; i++) 
		{ 
			d = decimal.substr(i, 1); 
 			if (d != "0") 
			{ 
				outputCharacters += digits[Number(d)] + decimals; 
			} 
		} 
	} 

	// Confirm and return the final output string: 
	if (outputCharacters == "") 
	{ 
		outputCharacters = CN_ZERO + CN_DOLLAR; 
	} 
	if (decimal == "") 
	{ 
		outputCharacters += CN_INTEGER; 
	} 
	outputCharacters = CN_SYMBOL + outputCharacters; 
	return outputCharacters; 
} 
//手机号码验证信息
function isMobil(s) {
	var patrn = /(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
	if (!patrn.exec(s)) {
		return false;
	}
	return true;
} 

function compare(str1, str2){
    if(str1 < str2){
        return -1;
    }else if(str1 > str2){
        return 1;
    }else{
        return 0;
    }
}

function compareNum(int1, int2){
    var iNum1 = Number(int1);
    var iNum2 = Number(int2);
    if(iNum1 < iNum2){
        return -1;
    }else if(iNum1 > iNum2){
        return 1;
    }else{
        return 0;
    }
}

//时间转化为字符串格式： yyyy-MM-dd hh:mm:ss
function TimeToStr(dt){
	var str="";
	if(dt.getFullYear){
  		var y,m,d;
  		y=dt.getFullYear();
  		m=dt.getMonth()+1;  //1-12
  		if(m<10)
		{
			m = "0"+m.toString();
		}
	 
		d=dt.getDate();
		if(d<10)
		{
			d = "0"+d.toString();
		}
		h = dt.getHours();
		if(h<10)
		{
			h = "0"+h.toString();
		}
		n = dt.getMinutes();
		if(n<10)
		{
			n = "0"+n.toString();
		}
		str=""+y+"-"+m+"-"+d+" "+h+":"+n;
	}
	return str;
}

/** 
* 删除数组指定下标或指定对象 
* arr.remove(2);//删除下标为2的对象（从0开始计算） 
* arr.remove(str);//删除指定对象 
*/  
Array.prototype.remove=function(obj){  
    for(var i =0;i <this.length;i++){  
        var temp = this[i];  
        if(!isNaN(obj)){  
            temp=i;  
        }  
        if(temp == obj){  
            for(var j = i;j <this.length;j++){  
                this[j]=this[j+1];  
            }  
            this.length = this.length-1;  
        }     
    }  
}  



var funarr=[]
funarr.push("");
//关闭倒计时窗口
function ColseCountdownWin(divid,sytime,sysecond,funindex,fun)
{
	if(funindex){}
	else
	{
		funarr.push(fun);
		funindex = funarr.length-1;
	}
	var ColseCountdown = Number($('#'+sysecond).val())
	if(ColseCountdown <=1)
	{
		$('#'+sysecond).val(10)
		$('#'+divid).dialog('close');
		$('#'+divid).find('#'+sytime).text('10秒后自动关闭');
		
		if(funarr[funindex])
		{
			fun = funarr[funindex];
			fun();
		}
	}
	else
	{
		ColseCountdown = ColseCountdown - 1
		$('#'+sysecond).val(ColseCountdown)
		$('#'+sytime).text(ColseCountdown+'秒后自动关闭');
		window.setTimeout("ColseCountdownWin('"+divid+"','"+sytime+"','"+sysecond+"',"+funindex+")",1000)
	}
}

var page ={
	pagesize:20,
	pageindex:1,
	countpage:0,
	countrs:0,
	closesize:false
}

function createpage(){
	$("#page_wrapper").empty()
	if(page.countrs >0)
	{
		var str = "";
		if(page.closesize)
		{
			str += "每页: <a href='javascript:;' onclick='setpagesize(20)' style='"+(page.pagesize==20?"color:red;":"")+"'>20</a>";
			str += " <a href='javascript:;' onclick='setpagesize(30)' style='"+(page.pagesize==30?"color:red;":"")+"'>30</a> ";
			str += " <a href='javascript:;' onclick='setpagesize(50)' style='"+(page.pagesize==50?"color:red;":"")+"'>50</a> ";
		}
		if(page.pageindex>1)
		{
			str +="<a class='h_l' href='javascript:;' onclick='setpageindex(1)'>首页</a>"
			str +="<a class='pre'  href='javascript:;' onclick='setpageindex("+(page.pageindex-1)+")'>上一页</a>"
		}
		else
		{
			str +="<a class='h_l' href='javascript:;'>首页</a>"
			str +="<a class='pre' href='javascript:;'>上一页</a>"
		}
		if(page.pageindex<page.countpage)
		{
			str +="<a class='next'  href='javascript:;' onclick='setpageindex("+(page.pageindex+1)+")'>下一页</a>"
			str +="<a class='h_l'  href='javascript:;' onclick='setpageindex("+(page.countpage)+")'>尾页</a>"
		}
		else
		{
			str +="<a class='next'  href='javascript:;'>下一页</a>"
			str +="<a class='h_l'  href='javascript:;'>尾页</a>"
		}
		str += "页次：";
		str += "<span style='color:red'>"+page.pageindex+"</span>"
		str += "/"
		str += page.countpage
		str += "记录："+page.countrs+"条 "
		$("#page_wrapper").html(str)
	}
}

function setpagesize(pagesize)
{
	page.pagesize=pagesize;
	do_search()
}
function setpageindex(index)
{
	page.pageindex=index;
	do_search()
}
