//Javascript codes

(function(jQuery){

	$.fn.breakingNews = function(params){
			var defaults={
					width			:'100%',
					modul			:'breakingnews',
					color			:'default',
					border			:false,
					effect			:'fade',
					fontstyle		:'normal',
					autoplay		:false,
					timer			:4000,
					feed			:false,
					feedlabels		:false,
					feedcount		:5
				};
			var feeds=[];
			var labels=[];
			var params=$.extend(defaults,params);
			
			return this.each(function(){
				//Variables------------------------------------
				params.modul=$("#"+$(this).attr("id"));
				var timername=params.modul;
				var active=0;
				var previous=0;
				var count=params.modul.find("ul li").length;
				var changestate=true;
				
				if (params.feed!=false)
				{
					getRSS();
				}
				else
				{
					params.modul.find("ul li").eq(active).fadeIn();
				}
				resizeEvent();
				
				if (params.autoplay)
				{
					timername=setInterval(function(){autoPlay()},params.timer);					
					$(params.modul).on("mouseenter",function (){
						clearInterval(timername);
					});
					
					$(params.modul).on("mouseleave",function (){
						timername=setInterval(function(){autoPlay()},params.timer);
					});
				}
				else
				{
					clearInterval(timername);
				}
				
				if (!params.border)
				{
					params.modul.addClass("bn-bordernone");
				}

				if (params.fontstyle=="italic")
					params.modul.addClass("bn-italic");
					
				if (params.fontstyle=="bold")
					params.modul.addClass("bn-bold");
					
				if (params.fontstyle=="bold-italic")
					params.modul.addClass("bn-bold bn-italic");
					
				params.modul.addClass("bn-"+params.color);
				
				//Events---------------------------------------
				$(window).on("resize",function (){
					resizeEvent();
				});
				
				params.modul.find(".bn-navi span").on("click",function(){
					if (changestate)
					{
						changestate=false;
						if ($(this).index()==0)
						{
							active--;
							if (active<0)
								active=count-1;
								
							changeNews();
						}
						else
						{
							active++;
							if (active==count)
								active=0;
							
							changeNews();
						}
					}
				});
				
				//functions------------------------------------
				function resizeEvent()
				{
					if (params.modul.width()<480)
					{
						params.modul.find(".bn-title h2").css({"display":"none"});
						params.modul.find(".bn-title").css({"width":10});
						params.modul.find("ul").css({"left":30});
					}
					else
					{
						params.modul.find(".bn-title h2").css({"display":"inline-block"});
						params.modul.find(".bn-title").css({"width":"auto"});
						params.modul.find("ul").css({"left":$(params.modul).find(".bn-title").width()+30});
					}
				}
				
				function autoPlay()
				{
					active++;
					if (active==count)
						active=0;
					
					changeNews();
				}
				
				function changeNews()
				{
					if (params.effect=="fade")
					{
						params.modul.find("ul li").css({"display":"none"});
						params.modul.find("ul li").eq(active).fadeIn("normal",function (){ 
							changestate=true;
						});
					}
					else if (params.effect=="slide-h")
					{
						params.modul.find("ul li").eq(previous).animate({width:0},function(){
							$(this).css({"display":"none","width":"100%"});
							params.modul.find("ul li").eq(active).css({"width":0,"display":"block"});
							params.modul.find("ul li").eq(active).animate({width:"100%"},function(){
								changestate=true;
								previous=active;
							});
						});
					}
					else if (params.effect=="slide-v")
					{
						if (previous<=active)
						{
							params.modul.find("ul li").eq(previous).animate({top:-60});
							params.modul.find("ul li").eq(active).css({top:60,"display":"block"});
							params.modul.find("ul li").eq(active).animate({top:0},function(){
								previous=active;
								changestate=true;
							});
						}
						else
						{
							params.modul.find("ul li").eq(previous).animate({top:60});
							params.modul.find("ul li").eq(active).css({top:-60,"display":"block"});
							params.modul.find("ul li").eq(active).animate({top:0},function(){
								previous=active;
								changestate=true;
							});
						}
					}
				}
				
				
				function getRSSx(a,b,c)
				{
					c=new XMLHttpRequest;
					c.open('GET',a);
					c.onload=b;
					c.send()
				}
				
				function yql(a,b)
				{
					return 'http://query.yahooapis.com/v1/public/yql?q='+encodeURIComponent('select * from '+b+' where url=\"'+a+'\" limit '+params.feedcount)+'&format=json';
				};
				
				function getRSS()
				{
					feeds=params.feed.split(",");
					labels=params.feedlabels.split(",");
					count=0;
					params.modul.find("ul").html("");
					xx=0;
					for (k=0; k<feeds.length; k++)
					{
						getRSSx(yql(feeds[k].trim(),'rss'),function()
						{ 
							var resultx=JSON.parse(this.response); 
							resultx=resultx.query.results.item;			
							$(resultx).each(function(index, element) {
								count++;
								dataLink= $('<a>').prop('href', resultx[index].link).prop('hostname');
								params.modul.find("ul").append('<li><a target="_blank" href="'+resultx[index].link+'"><span>'+dataLink+'</span> - '+resultx[index].title+'</a></li>');
								if (xx==0)
									params.modul.find("ul li").eq(0).fadeIn();
								xx++;
								
							});
							
						})
					}
					
				}

			});
			
				
		};
		
})(jQuery);

