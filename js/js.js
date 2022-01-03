// JavaScript Document
function lo(th,url)
{ 
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}// 用不到

function logout(){
	$.post("api/logout.php",()=>{
		location.href="index.php";
		// location.reload();這個是把頁面重整一次
	});
}

function good(id,type,user) 
{//重點
	$.post("back.php?do=good&type="+type,{"id":id,"user":user},function()
	{
		if(type=="1")
		{
			$("#vie"+id).text($("#vie"+id).text()*1+1)
			$("#good"+id).text("收回讚").attr("onclick","good('"+id+"','2','"+user+"')")
		}
		else
		{
			$("#vie"+id).text($("#vie"+id).text()*1-1)
			$("#good"+id).text("讚").attr("onclick","good('"+id+"','1','"+user+"')")
		}
	})
}