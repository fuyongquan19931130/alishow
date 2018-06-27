(function () {
	function Person(name, age) {
		this.name = name;
		this.age = age;
		this.sayHi = function () {
			console.log('我叫'+this.name+',今年'+this.age+'岁');
		}
	}
	p = new Person();
	// 判断define是否是一个函数
	if (typeof define == 'function') {
		// 如果define是一个函数，则使用模块化将p对象返回
		define(function () {
			return p;
		})
	}
})();