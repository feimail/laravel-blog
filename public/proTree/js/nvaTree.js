(function($) {
			var Tree = function(element, options) {

				this.element = element;
				//json数组
				this.JSONArr = options.arr;
				//单个文件图标
				this.simIcon = options.simIcon || "";
				//多个文件打开图标
				this.mouIconOpen = options.mouIconOpen || "fa fa-folder-open-o";
				//多个文件关闭图标
				this.mouIconClose = options.mouIconClose || "fa fa-folder-o";
				//回调函数
				this.callback = options.callback || function() {};
				//初始化
				this.init();

			}
			//初始化事件
			Tree.prototype.init = function() {
				//事件
				this.JSONTreeArr = this.proJSON(this.JSONArr, 0);
				this.treeHTML = this.proHTML(this.JSONTreeArr);
				this.element.append(this.treeHTML);
				this.bindEvent();
			}
			//生成树形JSON数据
			Tree.prototype.proJSON = function(oldArr, pid) {
				var newArr = [];
				var self = this;
				oldArr.map(function(item) {
					if(item.pid == pid) {
						var obj = {
							id: item.id,
							name: item.name,
							des : item.description,
							pid : item.pid
						}
						var child = self.proJSON(oldArr, item.id);
						if(child.length > 0) {
							obj.child = child
						}
						newArr.push(obj)
					}

				})
				return newArr;

			};

			//生成树形HTML
			Tree.prototype.proHTML = function(arr) {

				var ulHtml = "";
				var self = this;
				arr.map(function(item) {
			
					var lihtml = '';

					if(item.child && item.child.length > 0) {

						lihtml += '<li class="dropdown-submenu" >'+
						    			'<a href="/articleIndex/'+item.id+'" class="dropdown-toggle">' +item.name +'</a>'+
						    			'<ul class="dropdown-menu" top='+item.pid+'>'
						var _ul = self.proHTML(item.child);
						lihtml += _ul + "</ul></li>";
					} else {
						lihtml += '<li><a href="/articleIndex/'+item.id+'">' +item.name +'</a>';
					}
					ulHtml += lihtml;
				})
				ulHtml += "";
				return ulHtml;
			}
			Tree.prototype.bindEvent = function() {
				var self = this;
				this.element.find(".menuUl li i").click(function() {
					var ischek = $(this).attr("ischek");
					if(ischek == 'true') {
						var menuUl = $(this).closest("li").children(".menuUl");
						$(this).removeClass(self.mouIconOpen).addClass(self.mouIconClose)
						menuUl.hide();
						$(this).attr("ischek", 'false');
					} else if(ischek == 'false') {
						var menuUl = $(this).closest("li").children(".menuUl");
						menuUl.show();
						$(this).removeClass(self.mouIconClose).addClass(self.mouIconOpen)
						$(this).attr("ischek", 'true')
					}
				});

				this.element.find(".menuUl li span").click(function() {
					var id = $(this).attr("id");
					var des = $(this).attr("des");
					var name = $(this).text();
					self.callback(id, name ,des)
				})
			}
			//给jquery对象拓展一个树形对象
			$.fn.extend({
				ProTree: function(options) {
					return new Tree($(this), options)
				}
			})
		})(jQuery);
