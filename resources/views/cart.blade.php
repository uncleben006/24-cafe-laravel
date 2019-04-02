@extends('layouts/app') 
@section('script')
<script>
	var cart =  {!! $cart !!}
var id,pclass,pid
var cart_data = '';
cart.forEach(e => {
	total = e.product.price*e.qty
	id = e.id
	pclass = e.product.class
	pid = e.product.id
	cart_data += '<tr>\
		<td><a href="{{url('/')}}\/products\/'+pclass+'\/'+pid+'\/detail" target="_blank">'+e.product.name+'</a></td>\
		<td>'+e.product.price+'</td>\
		<td>'+e.qty+'</td>\
		<td>'+total+'</td>\
		<td><button class="btn btn-danger btn-sm rounded-0 btn-delete" data-id="'+id+'" >刪除</button></td>\
	</tr>'
});
$('#cart').html(cart_data)

$('.btn-delete').on('click',function(e){
	var tr = e.currentTarget.parentElement.parentElement
	var id = e.currentTarget.dataset.id
	var url = window.location.href
	$.post( url+'/delete' , {'id':id } , function(resp){
		console.log(resp)
	})
	$(tr).fadeOut( 250, function(){
		$(this).remove();
	});
	
})
</script>
@endsection
 
@section('content')
<div class="px-3 px-lg-5 spacing">
	<div class="container">
		<table class="table table-bordered table-hover table-striped">
			<thead class="thead-dark">
				<tr>
					<th>商品</th>
					<th>單價</th>
					<th>數量</th>
					<th>總計</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody id="cart"></tbody>
		</table>
	</div>
</div>
@endsection