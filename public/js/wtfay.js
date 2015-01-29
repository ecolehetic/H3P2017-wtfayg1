
var filters=document.querySelectorAll('.index a');
for (var i=0;i<filters.length;i++){
	filters[i].addEventListener('click',function(e){
		e.preventDefault();
		var url=this.getAttribute('href');
		async('GET',url,'',function(xhr){
		 	document.querySelector('.users').innerHTML=xhr.response;
		});
	});
}

var user=document.getElementById('user');
user.addEventListener('dragover',function(e){
	e.preventDefault();
});
user.addEventListener('drop',function(e){
	e.preventDefault();
	var data=new FormData();
	var files=e.dataTransfer.files;
	for(var i in files){
		data.append('file'+i,files[i]);
	}
	async('POST','upload',data,function(xhr){
		console.log(xhr); 
	});
	
});

var input=document.querySelector('input');
input.addEventListener('keyup',function(){
	var str=this.value;
	if(str.length>1){
		var data=new FormData();
		data.append('name',str);
		var url=this.parentNode.getAttribute('action');
		async('POST',url,data,function(xhr){
			 document.querySelector('.users').innerHTML=xhr.response;
		});
	}
	
});











function async(verb,url,datas,callback){
	var self=this;
	var xhr = new XMLHttpRequest();
	  xhr.open(verb, url);
		xhr.onload = function() {
		  if(xhr.status === 200){
		   callback.call(self,xhr);
		  }else{
		    console.log('error');
		  }
		}
		xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.send(datas);
}

















