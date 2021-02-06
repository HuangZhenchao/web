/**
 * @author Roger Wu
 * @version 1.0
 * added extend property oncheck
 */
 (function($){
 	$.extend($.fn, {
		jTree:function(options) {
			//fillSpace:$this.attr("fillSpace"),alwaysOpen:true,active:0
			var op = $.extend({
					checkFn:null, 
					selected:"selected",
					exp:"expandable", //可张开
					coll:"collapsable", //可折叠
					firstExp:"first_expandable", 
					firstColl:"first_collapsable", 
					lastExp:"last_expandable", 
					lastColl:"last_collapsable", 
					folderExp:"folder_expandable", 
					folderColl:"folder_collapsable", 
					endExp:"end_expandable", 
					endColl:"end_collapsable",
					file:"file",ck:"checked", 
					unck:"unchecked"
				}, options);
			return this.each(function(){
				var $this = $(this);
				var cnum = $this.children().length;
				$(">li", $this).each(function(){
					var $li = $(this);
					
					var first = $li.prev()[0]?false:true;//是否在前面存在一个同类元素，即是否第一个
					var last = $li.next()[0]?false:true; //是否在后面存在一个同类元素，即是否最后一个
					$li.genTree({
						icon:$this.hasClass("treeFolder"),//是否有treeFolder属性，是否显示文件夹图标
						ckbox:$this.hasClass("treeCheck"),//是否有treeCheck属性，是否显示复选框
						options: op,
						level: 0,
						exp:(cnum>1?(first?op.firstExp:(last?op.lastExp:op.exp)):op.endExp),
						coll:(cnum>1?(first?op.firstColl:(last?op.lastColl:op.coll)):op.endColl),
						showSub:(!$this.hasClass("collapse") && ($this.hasClass("expand") || (cnum>1?(first?true:false):true))),//默认显示第一个树节点的子树，即collapse（折叠状态）、expand两个class属性都是不存在的，可以通过设置class来改变初始的状态
						isLast:(cnum>1?(last?true:false):true)
					});
				});
				setTimeout(function(){
					if($this.hasClass("treeCheck")){
						var checkFn = eval($this.attr("oncheck"));
						if(checkFn && $.isFunction(checkFn)) {
							$("div.ckbox", $this).each(function(){
								var ckbox = $(this);
								ckbox.click(function(){
									var checked = $(ckbox).hasClass("checked");
									var tnode = ckbox.parent().parent();
									var boxes = $("input", tnode);
									var items = [];

									if(boxes.size() > 1) {
										$(boxes).each(function(){
											items[items.length] = {name:$(this).attr("name"), value:$(this).val(), text:$(this).attr("text")};
										});
									} else {
										items = {name:boxes.attr("name"), value:boxes.val(), text:boxes.attr("text")};
									}

									var parents = [];
									tnode.parents('li').each(function () {
										var $pNode = $(this), $pCkbox = $pNode.find('>div>div.ckbox');

										$pCkbox.find('input').each(function(){
											var pValue = {
												name:$(this).attr("name"),
												value:$(this).val(),
												text:$(this).attr("text"),
												checked:$pCkbox.hasClass('checked'),
												indeterminate:$pCkbox.hasClass('indeterminate')
											};
											parents.push(pValue);
										});
									});

									checkFn({checked:checked, items:items, parents:parents});
								});
							});
						}
					}
					$("a", $this).click(function(event){
						$("div." + op.selected, $this).removeClass(op.selected);
						var parent = $(this).parent().addClass(op.selected);
						//这一块不知道什么作用
						/* var $li = $(this).parents("li:first"), sTarget = $li.attr("target");
						if (sTarget) {
							if ($("#"+sTarget, $this).size() == 0) {
								$this.prepend('<input id="'+sTarget+'" type="hidden" />');
							}
							$("#"+sTarget, $this).val($li.attr("rel"));
						} */
						//触发复选框点击事件
						$(".ckbox",parent).trigger("click");
						event.stopPropagation();
						$(document).trigger("click");
						if (!$(this).attr("target")) return false;
					});
				},1);
			});
		},
		subTree:function(op, level) {
			return this.each(function(){
				$(">li", this).each(function(){
					var $this = $(this);
					
					var isLast = ($this.next()[0]?false:true);
					$this.genTree({
						icon:op.icon,
						ckbox:op.ckbox,
						exp:isLast?op.options.lastExp:op.options.exp,//与level为0时不同，只有两种情况，最后一个与其他
						coll:isLast?op.options.lastColl:op.options.coll,//与level为0时不同，只有两种情况，最后一个与其他
						options:op.options,
						level:level,
						space:isLast?null:op.space,
						showSub:op.showSub,
						isLast:isLast
					});
					
				});
			});
		},
		genTree:function(options) {
			/*
			icon:$this.hasClass("treeFolder"),
			ckbox:$this.hasClass("treeCheck"),
			options: op,
			level: 0,
			exp:(cnum>1?(first?op.firstExp:(last?op.lastExp:op.exp)):op.endExp),
			coll:(cnum>1?(first?op.firstColl:(last?op.lastColl:op.coll)):op.endColl),
			showSub:(!$this.hasClass("collapse") && ($this.hasClass("expand") || (cnum>1?(first?true:false):true))),
			isLast:(cnum>1?(last?true:false):true)*/
			var op = $.extend({icon:options.icon,ckbox:options.ckbox,exp:"", coll:"", showSub:false, level:0, options:null, isLast:false}, options);
			return this.each(function(){
				var node = $(this);
				var tree = $(">ul", node);
				var parent = node.parent().prev();
				var checked = 'unchecked';
				if(op.ckbox) {
					if($(">.checked",parent).size() > 0) checked = 'checked';
				}
				
				if (tree.size()>0) {
					node.children(":first").wrap("<div></div>");
					$(">div", node).prepend("<div class='" + (op.showSub ? op.coll : op.exp) + "'></div>"+(op.ckbox ?"<div class='ckbox " + checked + "'></div>":"")+(op.icon?"<div class='"+ (op.showSub ? op.options.folderColl : op.options.folderExp) +"'></div>":""));
					op.showSub ? tree.show() : tree.hide();
					$(">div>div:first,>div>a", node).click(function(){
						var $fnode = $(">li:first",tree);
						//ul>li>a 代表子树还没有构建。ul>li>div,div,a是已构建
						if($fnode.children(":first").isTag('a')) tree.subTree(op, op.level + 1);
						
						var $this = $(this);
						var isA = $this.isTag('a');
						
						var $this = isA?$(">div>div", node).eq(op.level):$this;
						//三种情况
						//a点击、隐藏 0、1
						//+点击、隐藏 1、1
						//+点击、显示 1、0
						if (!isA || tree.is(":hidden")) {
							$this.toggleClass(op.exp).toggleClass(op.coll);
							if (op.icon) {
								$(">div>div:last", node).toggleClass(op.options.folderExp).toggleClass(op.options.folderColl);
							}
						}
						(tree.is(":hidden"))?tree.slideDown("fast"):(isA?"":tree.slideUp("fast"));
						return false;
					});
					addSpace(op.level, node);
					if(op.showSub) tree.subTree(op, op.level + 1);
				} else {
					node.children().wrap("<div></div>");
					$(">div", node).prepend('<div class="node"></div>'+(op.ckbox?'<div class="ckbox '+checked+'"></div>':'')+(op.icon?'<div class="'+(node.attr('data-icon') || 'file')+'"></div>':''));
					addSpace(op.level, node);
					if(op.isLast)$(node).addClass("last");
				}
				//是否显示复选框，若有则处理复选框事项
				if (op.ckbox) node._check(op);
				$(">div",node).mouseover(function(){
					$(this).addClass("hover");
				}).mouseout(function(){
					$(this).removeClass("hover");
				});
				if(/msie/.test(navigator.userAgent.toLowerCase()))
					$(">div",node).click(function(){
						$("a", this).trigger("click");
						return false;
					});
			});
			//添加空位的 虚线或者空白
			function addSpace(level,node) {
				if (level > 0) {
					//树的层级要大于0，根节点为0
					//node是li
					//parent是上级li
					var parent = node.parent().parent();
					//这里是父节点下子节点前的位置，若父节点不是最后一个则应显示虚线，否则显示空白
					var space = !parent.next()[0]?"indent":"line";					
					//构建一个div
					var plist = "<div class='" + space + "'></div>";
					alert(plist);
					//若节点的层级更大，则从第二个位置开始要用空白占位
					if (level > 1) {
						//将父节点位置前的div属性复制过来
						//从第一个位置开始
						var next = $(">div>div", parent).filter(":first");
						var prev = "";
						while(level > 1){
							//提取属性拼装div
							prev = prev + "<div class='" + next.attr("class") + "'></div>";	
							//向后递相处理
							next = next.next();
							level--;
						}
						//再与节点前的位置连接
						plist = prev + plist;
						
					}
					//附加到节点div里的前部分
					$(">div", node).prepend(plist);
				}
			}
		},
		_check:function(op) {
			//处理复选框事项
			//node是<li>
			var node = $(this);
			//找到class为ckbox的div，从<li><a tname="" tvalue="">text</a></li>中获取text、tname、tvalue三个值
			var ckbox = $(">div>.ckbox", node);
			var $input = node.find("a");
			var tname = $input.attr("tname"), tvalue = $input.attr("tvalue");
			var attrs = "text='"+$input.text()+"' ";
			if (tname) attrs += "name='"+tname+"' ";
			if (tvalue) attrs += "value='"+tvalue+"' ";
			//在div中附加复选框控件，复选框隐藏，div显示为复选框的样式，同时添加点击事件
			ckbox.append("<input type='checkbox' style='display:none;' " + attrs + "/>").click(function(){
				var cked = ckbox.hasClass("checked");
				//若div是选中样式，即处于被选中状态，则aClass为unchecked，处于未被选中或未全选状态，aclass则为check
				var aClass = cked?"unchecked":"checked";
				var rClass = cked?"checked":"unchecked";
				//rClass是点击前的状态，与aClass相反，当div被点击，移除当前状态，移除中间模糊状态，添加aClass
				ckbox.removeClass(rClass).removeClass(!cked?"indeterminate":"").addClass(aClass);
				//给复选框添加checked属性
				$("input", ckbox).attr("checked", !cked);
				//以本li作为父节点，复选框选中，子节点全选，反之一样
				$(">ul", node).find("li").each(function(){
					var box = $("div.ckbox", this);
					box.removeClass(rClass).removeClass(!cked?"indeterminate":"").addClass(aClass)
					   .find("input").attr("checked", !cked);
				});
				//li作为子节点，则检查父节点的状态
				$(node)._checkParent();
				return false;
			});
			var cAttr = $input.attr("checked") || false;
			if (cAttr) {
				ckbox.find("input").attr("checked", true);
				ckbox.removeClass("unchecked").addClass("checked");
				$(node)._checkParent();
			}
		},
		_checkParent:function(){
			//已经是根节点，则返回
			if($(this).parent().hasClass("tree")) return;
			//li 
			//	ul
			//		li 
			var parent = $(this).parent().parent();
			var stree = $(">ul", parent);
			//复选框的个数以及被选中的复选框的个数
			//为什么要加stree.find(">li>a").size()
			var ckbox = stree.find(">li>a").size()+stree.find("div.ckbox").size();
			var ckboxed = stree.find("div.checked").size();
			//根据情况进行判断
			var aClass = (ckboxed==ckbox?"checked":(ckboxed!=0?"indeterminate":"unchecked"));
			var rClass = (ckboxed==ckbox?"indeterminate":(ckboxed!=0?"checked":"indeterminate"));
			//
			$(">div>.ckbox", parent).removeClass("unchecked").removeClass("checked").removeClass(rClass).addClass(aClass);
			//为什么不用$(">div>.ckbox>:checkbox", parent)
			var $checkbox = $(":checkbox", parent);
			if (aClass == "checked") $checkbox.attr("checked","checked");
			else if (aClass == "unchecked") $checkbox.removeAttr("checked");
			//向上遍历
			parent._checkParent();
		}
	});
})(jQuery);