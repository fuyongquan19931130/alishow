function Person(name, age) {
	this.name = name;
	this.age = age;
	this.sayHi = function () {
		console.log('我叫'+this.name+',今年'+this.age+'岁了!');
	}
}
p = new Person();
console.log($('#d').html());