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
							des : item.description
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

				var ulHtml = "<ul class='menuUl'>";
				var self = this;
				arr.map(function(item) {
					var lihtml = "<li>";
					if(item.child && item.child.length > 0) {
						lihtml += "<i ischek='true' class='" + self.mouIconOpen + "'></i>" +
							"<span id='" + item.id + "' des=" + item.des + ">" + item.name +
							"</span><button style='margin-left:3%' data-id=" + item.id +" name='add_category' type='button' class='btn btn-success btn-xs'>新增</button>"+
							"<button style='margin-left:1%' data-id=" + item.id +" data-name="+ item.name +" data-des="+ item.des +" name='edit_category' type='button' class='btn btn-warning btn-xs'>编辑</button>"+
							"<button style='margin-left:1%' data-id=" + item.id +" name='del_category' type='button' class='btn btn-danger btn-xs'>删除</button>"
						var _ul = self.proHTML(item.child);
						lihtml += _ul + "</li>";
					} else {
						lihtml += "<i class='" + self.simIcon + "'></i>" +
							"<span id='" + item.id + "' des=" + item.des + ">" + item.name +
							"</span><button style='margin-left:3%' data-id=" + item.id +" name='add_category' type='button' class='btn btn-success btn-xs'>新增</button>"+
							"<button style='margin-left:1%' data-id=" + item.id +" data-name="+ item.name +" data-des="+ item.des +"  name='edit_category' type='button' class='btn btn-warning btn-xs'>编辑</button>"+
							"<button style='margin-left:1%' data-id=" + item.id +" name='del_category' type='button' class='btn btn-danger btn-xs'>删除</button>";
					}
					ulHtml += lihtml;
				})
				ulHtml += "</ul>";
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
